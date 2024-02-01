<form method="post" action="{{ $url }}" role="form" class="form-horizontal" id="main-form" autocomplete="off">
    @csrf
    {!! method_field('PUT') !!}
    <div id="modal-group" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! $title . ' - ' . $data->name !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-message text-center"></div>
                <table class="table table-striped table-hover table-full-width table-sm" id="table_group_menu">
                    <thead>
                        <tr>
                            <th class="col-md-5" colspan="1"></th>
                            <th class="col-md-1 text-center">Retrive</th>
                            <th class="col-md-1 text-center">Create</th>
                            <th class="col-md-1 text-center">Update</th>
                            <th class="col-md-1 text-center">Delete</th>
                            {{-- <th class="col-md-1 text-center">All</th> --}}
                        </tr>

                    </thead>
                    <tbody>
                        {!! $menu !!}
                    </tbody>
                </table>
                <div class="form-message text-center"></div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</form>

<script>
    function updateCheck(th, act) {
        $(act).prop('checked', $(th).is(':checked'));
    }

    $(document).ready(function() {

        $('.all_line').change(function() {
            $('#r_' + $(this).val() + ',#c_' + $(this).val() + ',#u_' + $(this).val() + ',#d_' + $(this)
                .val()).prop('checked', $(this).is(':checked'));
        });

        $("#group-form").validate({
            rules: {
                kode: {
                    required: true,
                    minlength: 3,
                    maxlength: 10
                },
                nama: {
                    required: true,
                    minlength: 5,
                    maxlength: 50
                },
                is_aktif: {
                    required: true
                }
            },
            submitHandler: function(form) {
                $('.form-message').html('');
                blockUI(form);
                $(form).ajaxSubmit({
                    dataType: 'json',
                    success: function(data) {
                        unblockUI(form);
                        setFormMessage('.form-message', data);
                        if (data.stat) {
                            resetForm('#group-form');
                        }
                        closeModal($modal, data);
                    }
                });
            },
            validClass: "valid-feedback",
            errorElement: "div", // contain the error msg in a small tag
            errorClass: 'invalid-feedback',
            errorPlacement: erp,
            highlight: hl,
            unhighlight: uhl,
            success: sc
        });
    });
</script>
