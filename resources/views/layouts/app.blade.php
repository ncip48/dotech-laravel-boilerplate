<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Themestyle -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icheck.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/iconpicker-1.5.0.css') }}" />
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="https://imsservice.co.id/assets/inka-border.png" alt="AdminLTELogo"
                height="60">
        </div> --}}

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link d-flex">
                {{-- <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3"> --}}
                <span class="brand-text font-weight-normal text-center w-100">{{ env('APP_NAME') }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                    <div class="image">
                        <img src="{{ Auth::user()->avatar ? asset('assets/img/avatar/' . Auth::user()->avatar) : asset('assets/img/default.png') }}"
                            class="img-circle" alt="User Image" style="height: 2.1rem">
                    </div>
                    <div class="info align-text-center" style="text-wrap:wrap">
                        <a class="d-block">{{ Auth::user()->name }}
                    </div>
                    <a href="{{ route('profile') }}" class="ml-2">
                        <i class="fas fa-cog"></i>
                    </a>
                </div>

                {{-- <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> --}}

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        {!! MenuHelper::generateMenu() !!}

                        <form action="{{ route('logout') }}" id="logout" method="POST">
                            @csrf
                        </form>
                        <li class="nav-item">
                            <a onclick="document.getElementById('logout').submit();" class="nav-link"
                                style="cursor: pointer">
                                <i class="nav-icon fa fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; {{ now()->year }} <a href="https://dotech.cfd/">PT Dotech Digital
                    Solution</a></strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                Template by AdminLTE <b>Version</b> 3.2.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>

    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script lang="javascript" src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>

    <script src="{{ asset('dist/iconpicker-1.5.0.js') }}"></script>

    <script>
        // Default options
        // IconPicker.Init({
        //     // Required: You have to set the path of IconPicker JSON file to "jsonUrl" option. e.g. '/content/plugins/IconPicker/dist/iconpicker-1.5.0.json'
        //     jsonUrl: null,
        //     // Optional: Change the buttons or search placeholder text according to the language.
        //     searchPlaceholder: 'Search Icon',
        //     showAllButton: 'Show All',
        //     cancelButton: 'Cancel',
        //     noResultsFound: 'No results found.', // v1.5.0 and the next versions
        //     borderRadius: '20px', // v1.5.0 and the next versions
        // });

        // $('.icon').iconpicker();
    </script>

    @stack('scripts')

    <div id="ajax-modal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true" data-close-on-escape="true"></div>

    <script>
        $(function() {
            $("#example1").DataTable({
                "lengthChange": false,
                "autoWidth": true,
            })
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>

    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script>
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.registerPlugin(FilePondPluginFileValidateSize);
        FilePond.registerPlugin(FilePondPluginImagePreview);
    </script>
    <script>
        this.addEventListener('pondReset', e => {
            // console.log(FilePond.destroy(document.querySelector('input[name="filepond"]')))
            FilePond.destroy(document.querySelector('input[name="filepond"]'))
        });
    </script>

    <script>
        var $modal = $('#ajax-modal');

        function isJSON(str) {
            if (typeof str == 'string') {
                return false;
            } else {
                return true;
            }
        }

        function resetForm(el, exc) {
            exc = (typeof exc != 'undefined') ? exc : '';
            $('.select2, .selectbox', el).not(exc).val("").trigger("change");
            $(':input', el).not(':button, :submit, :reset, :radio' + ((exc.length > 0) ? ',' + exc : '')).val('').prop(
                'selected', false);
            $('label.custom-file-label').text('');
        }

        function closeModal(mdl, dt = {}) {
            if (dt.hasOwnProperty('success')) {
                if (dt.success) {
                    setTimeout(function() {
                        $modal.modal('hide');
                    }, 1000);
                }
            } else {
                if (mdl) {
                    setTimeout(function() {
                        $(mdl).modal('toggle');
                    }, 1000);
                }
            }
        }

        $('body').on('click', '.ajax_modal', function(ev) {
            ev.preventDefault();
            let u = $(this).data('url');

            //fetch with ajax
            $.ajax({
                url: u,
                type: 'GET',
                success: function(response) {
                    if (!isJSON(response)) {
                        $modal.html(response);
                        $modal.modal('show');
                    } else {
                        toastr.error(response?.message);
                    }
                }
            });
        });
    </script>

    <script>
        function getError(data) {
            if (data.hasOwnProperty('success')) {
                if (!data.success) {
                    if (data?.message?.toLowerCase().includes('validation')) {
                        const datas = data?.data;
                        for (const key in datas) {
                            if (datas.hasOwnProperty(key)) {
                                const element = datas[key];
                                toastr.error(element);
                            }
                        }
                    } else {
                        toastr.error(data.message);
                    }
                }
            } else {
                toastr.error(data.message);
            }
        }

        function showLoadingButton(btn) {
            btn.attr('disabled', true);
            btn.html('<i class="fa fa-spinner fa-spin"></i>');
        }

        function hideLoadingButton(btn) {
            btn.attr('disabled', false);
            btn.html('Save');
        }

        //#GetIconPicker on click
        // $(document).on('click', '#GetIconPicker', function(e) {
        //     // alert('ok')
        // })

        //#main-form on submit
        $(document).on('submit', '#main-form', function(e) {
            e.preventDefault();
            var form = $(this);
            //get the data-reload="true" attribute
            var reload = form.data('reload');
            var btn_save = $(this).find('#btn-save');
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    showLoadingButton(btn_save);
                },
                success: function(data) {
                    // unblockUI(form);
                    // setFormMessage('.form-message', data);
                    hideLoadingButton(btn_save);
                    if (data.success) {
                        resetForm('#form-master');
                        toastr.success(data.message);
                        if (reload) {
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            dataMaster.draw(false);
                        }
                    } else {
                        getError(data)
                    }
                    closeModal($modal, data);
                }
            });
        });

        $(document).on('submit', '#main-form-input', function(e) {
            e.preventDefault();
            var form = $(this);
            var btn_save = $(this).find('#btn-save');
            var url = form.attr('action');
            var method = form.attr('method');
            let formData = new FormData($('#main-form-input')[0]);

            $.ajax({
                url: url,
                method: method,
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function() {
                    showLoadingButton(btn_save);
                },
                success: function(data) {
                    // unblockUI(form);
                    // setFormMessage('.form-message', data);
                    hideLoadingButton(btn_save);
                    if (data.success) {
                        resetForm('#form-master');
                        toastr.success(data.message);
                        // dataMaster.draw(false);
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        getError(data)
                    }
                    closeModal($modal, data);
                }
            });
        });
    </script>

</body>

</html>
