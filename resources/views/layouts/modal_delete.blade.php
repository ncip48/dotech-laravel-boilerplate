<form method="post" action="{{ $url }}" role="form" class="form-horizontal" id="main-form">
    @csrf
    {!! method_field($action) !!}

    <div id="modal-confirm" class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="mb-0 form-message text-center"></div>
                <div class="alert alert-dark mb-0 rounded-0">
                    {{ __('Are you sure you want to delete this data?') }}
                    <section class="landing mt-1">
                        <div class="container p-0">
                            <dl class="row mb-0">
                                @foreach ($info as $k => $v)
                                    <dt class="col-sm-3 text-left"><strong>{{ $k }}:</strong></dt>
                                    <dd class="col-sm-9 mb-0">{{ $v }}</dd>
                                @endforeach
                            </dl>
                        </div>
                    </section>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">No</button>
                <button type="submit" class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</form>
