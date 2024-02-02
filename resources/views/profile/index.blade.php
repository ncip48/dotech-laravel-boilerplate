@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @foreach ($breadcrumbs as $breadcrumb)
                                {{-- check active by comparing the URL from $breadcrumb['url'] with the current URL --}}
                                @php
                                    $isActive = url()->current() == $breadcrumb['url'];
                                @endphp

                                <li class="breadcrumb-item {{ $isActive ? 'active' : '' }}">
                                    @if ($isActive)
                                        {{ $breadcrumb['title'] }}
                                    @else
                                        <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ol>

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Profile</h3>
                            </div>
                            <form id="main-form" action="{{ route('profile.update') }}" method="POST" autocomplete="off"
                                data-reload=true>
                                @csrf
                                {!! method_field('PUT') !!}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="group">Group</label>
                                        <input type="text" class="form-control" id="group" readonly disabled
                                            value="{{ $user->group->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username"
                                            value="{{ $user->username }}" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name"
                                            value="{{ $user->name }}" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email"
                                            value="{{ $user->email }}" name="email">
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Avatar</h3>
                            </div>
                            <form id="main-form-input" action="{{ route('avatar.update') }}" method="POST"
                                autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                {!! method_field('PUT') !!}
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <img class="profile-user-img img-fluid img-circle m-0 mr-5"
                                            src="{{ $user->avatar ? asset('assets/img/avatar/' . $user->avatar) : asset('assets/img/default.png') }}"
                                            alt="User profile picture" style="height: 90px;width:90px">
                                        <div class="form-group w-100">
                                            <label for="avatar">New Avatar</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="avatar"
                                                        name="avatar">
                                                    <label class="custom-file-label" for="avatar">Choose
                                                        avatar</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Password</h3>
                            </div>
                            <form id="main-form" action="{{ route('password.update') }}" method="POST" autocomplete="off">
                                @csrf
                                {!! method_field('PUT') !!}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="old_password">Old Password</label>
                                        <input type="password" class="form-control" id="old_password" name="old_password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm New Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation">
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
