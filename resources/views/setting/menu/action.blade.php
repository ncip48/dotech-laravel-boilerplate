@php
    // jika $data ada ISI-nya maka actionnya adalah edit, jika KOSONG : insert
    $is_edit = isset($data);
@endphp

<form method="post" action="{{ $url }}" role="form" class="form-horizontal" id="main-form" autocomplete="off">
    @csrf
    {!! $is_edit ? method_field('PUT') : '' !!}
    <div id="modal-user" class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ $title }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row mb-1">
                    <label for="code" class="col-sm-2 col-form-label">Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="code" placeholder="Code"
                            name="code" value="{{ isset($data->code) ? $data->code : '' }}" />
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="name" placeholder="Name"
                            name="name" value="{{ isset($data->name) ? $data->name : '' }}" />
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="menu_url" class="col-sm-2 col-form-label">URL</label>
                    <div class="col-sm-10">
                        <select id="url" name="url" class="form-control form-control-sm parent"
                            style="width: 100%;">
                            <option value="" selected>- Select one -</option>
                            @foreach ($routes as $route)
                                <option value="{{ $route->uri }}" @if (isset($data->url) && $data->url == $route->uri) selected @endif>
                                    {{ $route->uri }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="order" class="col-sm-2 col-form-label">Order</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm" id="order" placeholder="Order"
                            name="order" value="{{ isset($data->order) ? $data->order : '' }}" />
                    </div>
                    <label for="tag" class="col-sm-2 col-form-label">Tag</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm" id="tag" placeholder="Tag"
                            name="tag" value="{{ isset($data->tag) ? $data->tag : '' }}" />
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                    <div class="col-sm-10">
                        {{-- <button type="button" id="GetIconPicker" data-iconpicker-input="input#icon"
                            data-iconpicker-preview="i#IconPreview">Select Icon</button>
                        <i id="IconPreview" class="fa fa-fw fa-{{ isset($data->icon) ? $data->icon : '' }}"></i> --}}
                        <input type="text" class="form-control form-control-sm" id="icon" placeholder="Icon"
                            name="icon" value="{{ isset($data->icon) ? $data->icon : '' }}" />
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="parent_id" class="col-sm-2 col-form-label">Parent</label>
                    <div class="col-sm-10">
                        <select id="parent_id" name="parent_id" class="form-control form-control-sm parent"
                            style="width: 100%;">
                            <option value="">- Select one -</option>
                            @foreach ($menu as $p)
                                <option value="{{ $p->menu_id }}" @if (isset($data->parent_id) && $data->parent_id == $p->menu_id) selected @endif>
                                    {{ $p->name }}
                                    ({{ $p->code }})
                                </option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="Status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10 mt-1">
                        <div class="icheck-primary d-inline mr-2">
                            <input type="radio" id="radioPrimary1" name="is_active" value="1"
                                {{ isset($data->is_active) ? ($data->is_active == 1 ? 'checked' : '') : 'checked' }}>
                            <label for="radioPrimary1">Active</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input type="radio" id="radioPrimary2" name="is_active" value="0"
                                {{ isset($data->is_active) ? ($data->is_active == 0 ? 'checked' : '') : '' }}>
                            <label for="radioPrimary2">Inactive</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</form>
