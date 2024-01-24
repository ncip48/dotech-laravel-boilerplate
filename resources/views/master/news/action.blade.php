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
                    <label class="col-sm-3 control-label col-form-label">Creator</label>
                    <div class="col-sm-9">
                        <select class="custom-select form-control-sm" id="user_id" name="user_id">
                            <option value="" selected disabled>Select User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->user_id }}"
                                    {{ isset($data->user_id) && $data->user_id == $user->user_id ? 'selected' : '' }}>
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Title</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="title" name="title"
                            value="{{ isset($data->title) ? $data->title : '' }}" />
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Content</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="content" name="content">{{ isset($data->content) ? $data->content : '' }}</textarea>
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
