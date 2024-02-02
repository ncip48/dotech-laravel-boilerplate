<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->url = url('/profile');
        $this->title = "Profile";
        $this->view = "profile.";
    }

    public function index()
    {
        $breadcrumbs = [
            ["url" => "#", 'title' => "Home"],
            ['url' => $this->url, 'title' => $this->title],
        ];

        $user = User::with('group')->find(auth()->user()->user_id);

        return view($this->view . 'index')->with('title', $this->title)
            ->with('url', $this->url)
            ->with('breadcrumbs', $breadcrumbs)
            ->with('user', $user);
    }

    public function update(Request $request)
    {
        $user = User::find(auth()->user()->user_id);

        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username,' . $user->user_id . ',user_id', // ignore this id
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->user_id . ',user_id',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;

        $user->save();

        return $this->setResponse(true, "Profile Updated");
    }

    public function password(Request $request)
    {
        $user = User::find(auth()->user()->user_id);

        $validator = Validator::make($request->all(), [
            'old_password' => 'required_with:password',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        //check old password
        if (!password_verify($request->old_password, $user->password)) {
            return $this->setResponse(false, "Old Password is Wrong");
        }

        $user->password = bcrypt($request->password);

        $user->save();

        return $this->setResponse(true, "Password Updated");
    }

    public function avatar(Request $request)
    {
        $user = User::find(auth()->user()->user_id);

        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        //remove old avatar
        $oldAvatar = public_path('assets/img/avatar/') . $user->avatar;
        if (file_exists($oldAvatar)) {
            unlink($oldAvatar);
        }

        $avatar = $request->file('avatar');
        $random = rand(1, 100000);
        $avatarName = $random . '.' . $avatar->getClientOriginalExtension();
        $avatar->move(public_path('assets/img/avatar'), $avatarName);

        $user->avatar = $avatarName;


        $user->save();

        return $this->setResponse(true, "Avatar Updated");
    }
}
