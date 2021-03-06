<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('custom/admin/assets/images/favicon.png')}}">
    <title>Điện thoại Chiến Hương</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{url('custom/admin/assets/libs/select2/dist/css/select2.min.css')}}">
    <!-- Custom CSS -->
    <link href="{{url('custom/admin/dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{url('custom/css/util.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{url('custom/admin/dist/css/admin.css')}}" rel="stylesheet">
    <link href="{{url('custom/admin/assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet">
    <link href="{{url('custom/admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">

    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{url('custom/admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="{{url('admin/wellcome')}}">
                        <!-- Logo icon -->
                        <b class="logo-icon p-l-10">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{url('custom/admin/assets/images/logo-icon.png')}}" alt="homepage" class="light-logo" />

                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                             {{Auth::user()->name}}
                             {{-- <img src="{{url('custom/admin/assets/images/logo-text.png')}}" alt="homepage" class="light-logo" /> --}}

                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <!-- <img src="{{url('custom/admin/assets/images/logo-text.png')}}" alt="homepage" class="light-logo" /> -->

                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        {{--
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li> --}}
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-md-block">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                    Thiết lập hệ thống <i class="fa fa-angle-down"></i>
                            </span>
                                <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{url('admin/sale/create')}}">Thêm khuyến mãi</a>
                                <a class="dropdown-item" href="{{url('admin/sale')}}">Danh sách khuyến mãi</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-md-block">
                                    <i class="mdi mdi-cube-outline"></i>
                                    Quản lý sản phẩm <i class="fa fa-angle-down"></i>
                            </span>
                                <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{url('admin/category')}}">Danh mục</a>
                                <a class="dropdown-item" href="{{url('admin/classify')}}">Phân loại sản phẩm</a>
                                <a class="dropdown-item" href="{{url('admin/product/create')}}">Thêm sản phẩm</a>
                                <a class="dropdown-item" href="{{url('admin/product')}}">Danh sách sản phẩm</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-md-block">
                                    <i class="mdi mdi-cube-outline"></i>
                                    Quản lý đối tác <i class="fa fa-angle-down"></i>
                            </span>
                                <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{url('admin/producer')}}">Nhà sản xuất</a>
                                <a class="dropdown-item" href="{{url('admin/provider')}}">Nhà cung cấp</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-md-block">
                                    <i class="far fa-file-alt"></i>
                                 Quản lý bán hàng <i class="fa fa-angle-down"></i>
                            </span>
                                <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{url('admin/adminprofile')}}">Thông tin khách hàng</a>
                                <a class="dropdown-item" href="{{url('admin/billOrder')}}">Cập nhật đơn đặt hàng</a>
                               
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-md-block">
                                    <i class="mdi mdi-cube-outline"></i>
                                    Quản lý kho <i class="fa fa-angle-down"></i>
                            </span>
                                <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{url('admin/billImport/create')}}">Thêm đơn nhập hàng</a>
                                <a class="dropdown-item" href="{{url('admin/billImport')}}">Danh sách đơn nhập hàng</a>
                                <a class="dropdown-item" href="{{url('admin/billExport/create')}}">Thêm đơn xuất hàng</a>
                                <a class="dropdown-item" href="{{url('admin/billExport')}}">Danh sách đơn xuất hàng</a>
                                <a class="dropdown-item" href="{{url('admin/warehouse')}}">Trích xuất số lượng tồn kho</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-md-block">
                                    <i class="fa fa-line-chart" aria-hidden="true"></i>
                                    Báo cáo thống kê <i class="fa fa-angle-down"></i>
                            </span>
                                <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{url('admin/report')}}">Báo cáo bán hàng</a>
                                <a class="dropdown-item" href="{{url('admin/reportImport')}}">Báo cáo nhập hàng</a>
                                <a class="dropdown-item" href="{{url('admin/reportMoney')}}">Báo cáo tài chính</a>
                            </div>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-md-block">
                                    <i class="mdi mdi-percent"></i>
                                    Khuyến mãi <i class="fa fa-angle-down"></i>
                            </span>
                                <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{url('admin/sale/create')}}">Thêm khuyến mãi</a>
                                <a class="dropdown-item" href="{{url('admin/sale')}}">Danh sách khuyến mãi</a>
                            </div>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        {{--
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li> --}}
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{url('custom/admin/assets/images/users/1.jpg')}}" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                <div class="dropdown-divider"></div>
                                <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
                            </div>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>

        @section('content') @show
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{url('custom/admin/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{url('custom/admin/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{url('custom/admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{url('custom/admin/assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{url('custom/admin/dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{url('custom/admin/dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{url('custom/admin/dist/js/custom.min.js')}}"></script>
    <!--This page JavaScript -->
    <script src="{{url('custom/admin/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script src="{{url('custom/admin/assets/libs/toastr/build/toastr.min.js')}}"></script>
    <script src="{{url('custom/admin/assets/libs/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{ url('custom/admin/ckeditor/ckeditor.js') }}"></script>
    @if(session('success'))
    <script>
        toastr.success("{{session('success')}}", 'Thông báo!');
    </script>
    @endif @if(session('info'))
    <script>
        toastr.info("{{session('info')}}", 'Thông báo!');
    </script>
    @endif @if(session('warning'))
    <script>
        toastr.warning("{{session('warning')}}", 'Thông báo!');
    </script>
    @endif @if(session('error'))
    <script>
        toastr.error("{{session('error')}}", 'Thông báo!');
    </script>
    @endif
    <script>
        $('.datatable').DataTable();
        $(".select2").select2();
        if ($('#editor1').length > 0) {
            CKEDITOR.replace('editor1', {
                filebrowserBrowseUrl: `{{ url('
                custom / admin / ckfinder / ckfinder.html ') }}`,
                filebrowserImageBrowseUrl: `{{ url('
                custom / admin / ckfinder / ckfinder.html ? type = Images ') }}`,
                filebrowserFlashBrowseUrl: `{{ url('
                custom / admin / ckfinder / ckfinder.html ? type = Flash ') }}`,
                filebrowserUploadUrl: `{{ url('
                custom / admin / ckfinder / core / connector / php / connector.php ? command = QuickUpload & type = Files ') }}`,
                filebrowserImageUploadUrl: ` {
                            {
                                url('
                                    custom / admin / ckfinder / core / connector / php / connector.php ? command = QuickUpload & type = Images ') }}`,
                filebrowserFlashUploadUrl: `{{url('
                custom / admin / ckfinder / core / connector / php / connector.php ? command = QuickUpload & type = Flash ') }}`
            });
        }
    </script>
</body>

</html>