<?php
// jika $data ada ISI-nya maka actionnya adalah edit, jika KOSONG : insert
$is_edit = isset($data);
?>

<form method="post" action="{{ $url }}" role="form" class="form-horizontal" id="main-form" autocomplete="off">
    @csrf
    {!! $is_edit ? method_field('PUT') : '' !!}
    <div id="modal-master" class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! $title !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="username" name="username"
                            value="{{ isset($data->username) ? $data->username : '' }}" />
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="name" name="name"
                            value="{{ isset($data->name) ? $data->name : '' }}" />
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="email" name="email"
                            value="{{ isset($data->email) ? $data->email : '' }}" />
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control form-control-sm" id="password" name="password" />
                        @if ($is_edit)
                            <small class="text-muted">Leave blank if you don't want to change the password</small>
                        @endif
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Group</label>
                    <div class="col-sm-9">
                        <select class="custom-select form-control-sm" id="group_id" name="group_id">
                            <option value="" selected disabled>Select Group</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->group_id }}"
                                    {{ isset($data->group_id) && $data->group_id == $group->group_id ? 'selected' : '' }}>
                                    {{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Status</label>
                    <div class="col-sm-9 mt-2">
                        <div class="icheck-success d-inline mr-3">
                            <input type="radio" id="radioActive" name="is_active" value="1" <?php echo isset($data->is_active) ? ($data->is_active == 1 ? 'checked' : '') : 'checked'; ?>>
                            <label for="radioActive">Active </label>
                        </div>
                        <div class="icheck-danger d-inline mr-3">
                            <input type="radio" id="radioFailed" name="is_active" value="0" <?php echo isset($data->is_active) ? ($data->is_active == 0 ? 'checked' : '') : ''; ?>>
                            <label for="radioFailed">Inactive </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Cancel</button>
                <button type="submit" id="btn-save" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</form>
