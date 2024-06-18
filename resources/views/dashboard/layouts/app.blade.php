<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <!-- Title -->
    <title>@yield('title')</title>
    <!--Favicon -->
    <link rel="icon" href="{{ asset('dashboard-assets/assets/images/brand/favicon.ico') }}" type="image/x-icon" />
    <!-- Bootstrap css -->
    <link href="{{ asset('dashboard-assets/assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet"
        id="style" />
    <!-- Style css -->
    <link href="{{ asset('dashboard-assets/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashboard-assets/assets/css/boxed.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashboard-assets/assets/css/dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashboard-assets/assets/css/skin-modes.css') }}" rel="stylesheet" />

    <!-- Animate css -->
    <link href="{{ asset('dashboard-assets/assets/css/animated.css') }}" rel="stylesheet" />

    <!-- P-scroll bar css-->
    <link href="{{ asset('dashboard-assets/assets/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

    <!---Icons css-->
    <link href="{{ asset('dashboard-assets/assets/css/icons.css') }}" rel="stylesheet" />

    <!---Sidebar css-->
    <link href="{{ asset('dashboard-assets/assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet" />

    <!-- Select2 css -->
    <link href="{{ asset('dashboard-assets/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

    <!--- INTERNAL jvectormap css-->
    <link href="{{ asset('dashboard-assets/assets/plugins/jvectormap/jqvmap.css') }}" rel="stylesheet" />
    <!-- Notifications  Css -->

    <link href="{{ asset('vendor/flasher/flasher.min.css') }}" rel="stylesheet" />

    <!-- INTERNAL Time picker css -->
    <link href="{{ asset('dashboard-assets/assets/plugins/time-picker/jquery.timepicker.css') }}" rel="stylesheet" />
    <!-- INTERNAL jQuery-countdowntimer css -->
    <link href="{{ asset('dashboard-assets/assets/plugins/jQuery-countdowntimer/jQuery.countdownTimer.css') }}"
        rel="stylesheet" />
    <!-- INTERNAL Data table css -->
    <link href="{{ asset('dashboard-assets/assets/plugins/datatable/css/dataTables.bootstrap5.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('dashboard-assets/assets/plugins/datatable/css/buttons.bootstrap5.min.css') }}"
        rel="stylesheet">
    <!-- INTERNAL Datepicker css-->
    <link href="{{ asset('dashboard-assets/assets/plugins/modal-datepicker/datepicker.css') }}" rel="stylesheet" />
    <!-- INTERNAL summernote css -->
    <link href="{{ asset('dashboard-assets/assets/plugins/summer-note/summernote1.css') }}" rel="stylesheet" />
    <!-- INTERNAL Ratings css -->
    <link rel="stylesheet" href="{{ asset('dashboard-assets/assets/plugins/rating/css/ratings.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard-assets/assets/plugins/rating/css/rating-themes.css') }}">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Icon Picker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css">

</head>

<body class="app sidebar-mini">

    <!---Global-loader-->
    <div id="global-loader">
        <img src="{{ asset('dashboard-assets/assets/images/svgs/loader.svg') }}" alt="loader">
    </div>

    <div class="page">
        <div class="page-main">

            @include('dashboard.layouts.sidebar');

            @yield('content')
        </div>

        <!--Footer-->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                        Copyright © 2021 <a href="#">Dayone</a>. Designed with <span
                            class="fa fa-heart text-danger"></span> by <a href="#">Spruko Technologies Pvt.Ltd</a>
                        All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer-->

        <!--sidebar-right-->
        <div class="sidebar sidebar-right sidebar-animate">
            <div class="card-header border-bottom pb-5">
                <h4 class="card-title">Notifications </h4>
                <div class="card-options">
                    <a href="#" class="btn btn-sm btn-icon btn-light text-primary" data-bs-toggle="sidebar-right"
                        data-bs-target=".sidebar-right"><i class="feather feather-x"></i> </a>
                </div>
            </div>
            <div class="">
                <div class="list-group-item  align-items-center border-0">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3"
                            style="background-image: url({{ asset('dashboard-assets/assets/images/users/4.jpg') }}"></span>
                        <div class="mt-1">
                            <a href="#" class="font-weight-semibold fs-16">Liam <span
                                    class="text-muted font-weight-normal">Sent Message</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>30 mins
                                ago</span>
                        </div>
                        <div class="ms-auto">
                            <a href="" class="me-0 option-dots" data-bs-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a href="#"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a href="#"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a href="#"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a href="#"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3"
                            style="background-image: url({{ asset('dashboard-assets/assets/images/users/10.jpg') }}"></span>
                        <div class="mt-1">
                            <a href="#" class="font-weight-semibold fs-16">Paul<span
                                    class="text-muted font-weight-normal"> commented on you post</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>1 hour
                                ago</span>
                        </div>
                        <div class="ms-auto">
                            <a href="" class="me-0 option-dots" data-bs-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a href="#"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a href="#"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a href="#"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a href="#"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3 bg-pink-transparent"><span
                                class="feather feather-shopping-cart"></span></span>
                        <div class="mt-1">
                            <a href="#" class="font-weight-semibold fs-16">James<span
                                    class="text-muted font-weight-normal"> Order Placed</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>1 day
                                ago</span>
                        </div>
                        <div class="ms-auto">
                            <a href="" class="me-0 option-dots" data-bs-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a href="#"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a href="#"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a href="#"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a href="#"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3"
                            style="background-image: url({{ asset('dashboard-assets/assets/images/users/9.jpg') }}">
                            <span class="avatar-status bg-green"></span>
                        </span>
                        <div class="mt-1">
                            <a href="#" class="font-weight-semibold fs-16">Diane<span
                                    class="text-muted font-weight-normal"> New Message Received</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>1 day
                                ago</span>
                        </div>
                        <div class="ms-auto">
                            <a href="" class="me-0 option-dots" data-bs-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a href="#"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a href="#"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a href="#"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a href="#"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3"
                            style="background-image: url({{ asset('dashboard-assets/assets/images/users/5.jpg') }}">
                            <span class="avatar-status bg-muted"></span>
                        </span>
                        <div class="mt-1">
                            <a href="#" class="font-weight-semibold fs-16">Vinny<span
                                    class="text-muted font-weight-normal"> shared your post</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>2 days
                                ago</span>
                        </div>
                        <div class="ms-auto">
                            <a href="" class="me-0 option-dots" data-bs-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a href="#"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a href="#"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a href="#"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a href="#"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3 bg-primary-transparent">M</span>
                        <div class="mt-1">
                            <a href="#" class="font-weight-semibold fs-16">Mack<span
                                    class="text-muted font-weight-normal"> your admin lanuched</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>1 week
                                ago</span>
                        </div>
                        <div class="ms-auto">
                            <a href="" class="me-0 option-dots" data-bs-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a href="#"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a href="#"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a href="#"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a href="#"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3"
                            style="background-image: url({{ asset('dashboard-assets/assets/images/users/12.jpg') }}">
                            <span class="avatar-status bg-green"></span>
                        </span>
                        <div class="mt-1">
                            <a href="#" class="font-weight-semibold fs-16">Vinny<span
                                    class="text-muted font-weight-normal"> shared your post</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>04 Jan
                                2021 1:56 Am</span>
                        </div>
                        <div class="ms-auto">
                            <a href="" class="me-0 option-dots" data-bs-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a href="#"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a href="#"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a href="#"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a href="#"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3"
                            style="background-image: url({{ asset('dashboard-assets/assets/images/users/8.jpg') }}">
                        </span>
                        <div class="mt-1">
                            <a href="#" class="font-weight-semibold fs-16">Anna<span
                                    class="text-muted font-weight-normal"> likes your post</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>25 Dec
                                2020 11:25 Am</span>
                        </div>
                        <div class="ms-auto">
                            <a href="" class="me-0 option-dots" data-bs-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a href="#"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a href="#"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a href="#"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a href="#"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3"
                            style="background-image: url({{ asset('dashboard-assets/assets/images/users/14.jpg') }}">
                        </span>
                        <div class="mt-1">
                            <a href="#" class="font-weight-semibold fs-16">Kimberly<span
                                    class="text-muted font-weight-normal"> Completed one task</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>24 Dec
                                2020 9:30 Pm</span>
                        </div>
                        <div class="ms-auto">
                            <a href="" class="me-0 option-dots" data-bs-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a href="#"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a href="#"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a href="#"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a href="#"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3"
                            style="background-image: url({{ asset('dashboard-assets/assets/images/users/3.jpg') }}">
                        </span>
                        <div class="mt-1">
                            <a href="#" class="font-weight-semibold fs-16">Rina<span
                                    class="text-muted font-weight-normal"> your account has Updated</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>28 Nov
                                2020 7:16 Am</span>
                        </div>
                        <div class="ms-auto">
                            <a href="" class="me-0 option-dots" data-bs-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a href="#"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a href="#"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a href="#"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a href="#"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="list-group-item  align-items-center  border-bottom">
                    <div class="d-flex">
                        <span class="avatar avatar-lg brround me-3 bg-success-transparent">J</span>
                        <div class="mt-1">
                            <a href="#" class="font-weight-semibold fs-16">Julia<span
                                    class="text-muted font-weight-normal"> Prepare for Presentation</span></a>
                            <span class="clearfix"></span>
                            <span class="text-muted fs-13 ms-auto"><i class="mdi mdi-clock text-muted me-1"></i>18 Nov
                                2020 11:55 Am</span>
                        </div>
                        <div class="ms-auto">
                            <a href="" class="me-0 option-dots" data-bs-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="feather feather-more-horizontal"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                <li><a href="#"><i class="feather feather-eye me-2"></i>View</a></li>
                                <li><a href="#"><i class="feather feather-plus-circle me-2"></i>Add</a></li>
                                <li><a href="#"><i class="feather feather-trash-2 me-2"></i>Remove</a></li>
                                <li><a href="#"><i class="feather feather-settings me-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/sidebar-right-->

        <!--Clock-IN Modal -->
        <div class="modal fade" id="clockinmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><span class="feather feather-clock  me-1"></span>Clock In</h5>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="countdowntimer"><span id="clocktimer" class="border-0"></span></div>
                        <div class="form-group">
                            <label class="form-label">Note:</label>
                            <textarea class="form-control" rows="3">Some text here...</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Clock In</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Clock-IN Modal  -->

        <!--Change password Modal -->
        <div class="modal fade" id="changepasswordnmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" placeholder="password" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" placeholder="password" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</a>
                        <a href="#" class="btn btn-primary">Confirm</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Change password Modal  -->

    </div>

    <!-- Back to top -->
    <a href="#top" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>

    <!-- Jquery js-->
    <script src="{{ asset('dashboard-assets/assets/plugins/jquery/jquery.min.js') }}"></script>

    <!--Moment js-->
    <script src="{{ asset('dashboard-assets/assets/plugins/moment/moment.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('dashboard-assets/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!--Othercharts js-->
    <script src="{{ asset('dashboard-assets/assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>

    <!--Sidemenu js-->
    <script src="{{ asset('dashboard-assets/assets/plugins/sidemenu/sidemenu.js') }}"></script>

    <!-- P-scroll js-->
    <script src="{{ asset('dashboard-assets/assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
    <script src="{{ asset('dashboard-assets/assets/plugins/p-scrollbar/p-scroll1.js') }}"></script>

    <!--Sidebar js-->
    <script src="{{ asset('dashboard-assets/assets/plugins/sidebar/sidebar.js') }}"></script>

    <!-- Select2 js -->
    <script src="{{ asset('dashboard-assets/assets/plugins/select2/select2.full.min.js') }}"></script>

    <!-- INTERNAL Peitychart js-->
    <script src="{{ asset('dashboard-assets/assets/plugins/peitychart/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/assets/plugins/peitychart/peitychart.init.js') }}"></script>

    <!-- INTERNAL Apexchart js-->
    <script src="{{ asset('dashboard-assets/assets/plugins/apexchart/apexcharts.js') }}"></script>

    <!-- INTERNAL Vertical-scroll js-->
    <script src="{{ asset('dashboard-assets/assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js') }}"></script>
    <script src="{{ asset('dashboard-assets/assets/plugins/vertical-scroll/vertical-scroll.js') }}"></script>

    <!-- INTERNAL  Datepicker js -->
    <script src="{{ asset('dashboard-assets/assets/plugins/date-picker/jquery-ui.js') }}"></script>

    <!-- INTERNAL Chart js -->
    <script src="{{ asset('dashboard-assets/assets/plugins/chart/chart.bundle.js') }}"></script>
    <script src="{{ asset('dashboard-assets/assets/plugins/chart/utils.js') }}"></script>

    <!-- INTERNAL Timepicker js -->
    <script src="{{ asset('dashboard-assets/assets/plugins/time-picker/jquery.timepicker.js') }}"></script>
    <script src="{{ asset('dashboard-assets/assets/plugins/time-picker/toggles.min.js') }}"></script>

    <!-- INTERNAL Chartjs rounded-barchart -->
    <script src="{{ asset('dashboard-assets/assets/plugins/chart.min/chart.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/assets/plugins/chart.min/rounded-barchart.js') }}"></script>

    <!-- INTERNAL jQuery-countdowntimer js -->
    <script src="{{ asset('dashboard-assets/assets/plugins/jQuery-countdowntimer/jQuery.countdownTimer.js') }}"></script>


    <!-- INTERNAL Datepicker js -->
    <script src="{{ asset('dashboard-assets/assets/plugins/modal-datepicker/datepicker.js') }}"></script>

    <!-- INTERNAL Data tables -->
    <script src="{{ asset('dashboard-assets/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('dashboard-assets/assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard-assets/assets/js/hr/hr-empview.js') }}"></script>
    <script src="{{ asset('dashboard-assets/assets/plugins/summer-note/summernote1.js') }}"></script>

    <!-- INTERNAL summernote js -->

    <!-- INTERNAL summernote js -->
    <script src="{{ asset('dashboard-assets/assets/js/summernote.js') }}"></script>
    <!-- INTERNAL Index js-->
    <script src="{{ asset('dashboard-assets/assets/js/project/project-list.js') }}"></script>


    <!-- Notifications js -->
    <script src="{{ asset('vendor/flasher/flasher.min.js') }}"></script>
    <!-- Custom js-->
    <script src="{{ asset('dashboard-assets/assets/js/custom.js') }}"></script>

    <script src="{{ asset('dashboard-assets/assets/plugins/rating/js/jquery.barrating.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js"></script>


    @if ($errors->any())
        @foreach ($errors->all() as $index => $error)
            <script>
                flasher.error('{{ $error }}').priority({{ $loop->index + 1 }});
            </script>
        @endforeach
    @endif

    @stack('scripts')

</body>

</html>
