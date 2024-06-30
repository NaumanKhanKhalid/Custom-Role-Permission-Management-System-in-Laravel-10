@extends('dashboard.layouts.app')
@section('content')
    <div class="app-content main-content">
        <div class="side-app">
            @include('dashboard.layouts.header')
            <!--Page header-->
            <div class="page-header d-xl-flex d-block">
                <div class="page-leftheader">
                    <h4 class="page-title">{{ $authUser->role->name }}<span
                            class="font-weight-normal text-muted ms-2">Dashboard</span></h4>
                </div>
                
            </div>
            <!--End Page header-->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="mt-0 text-start"> <span class="fs-14 font-weight-semibold">Total
                                                    Employees</span>
                                                <h3 class="mb-0 mt-1 mb-2">6,578</h3>
                                                <span class="text-muted">
                                                    <span class="text-success fs-12 mt-2 me-1"><i
                                                            class="feather feather-arrow-up-right me-1 bg-success-transparent p-1 brround"></i>124</span>
                                                    for last month
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="icon1 bg-success my-auto  float-end"> <i
                                                    class="feather feather-users"></i> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="mt-0 text-start"> <span
                                                    class="fs-14 font-weight-semibold">Department</span>
                                                <h3 class="mb-0 mt-1 mb-2">124</h3>
                                                <span class="text-muted">
                                                    <span class="text-danger fs-12 mt-2 me-1"><i
                                                            class="feather feather-arrow-down-left me-1 bg-danger-transparent p-1 brround"></i>13</span>
                                                    for last month
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="icon1 bg-primary my-auto  float-end"> <i
                                                    class="feather feather-box"></i> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="mt-0 text-start"> <span
                                                    class="fs-14 font-weight-semibold">Expenses</span>
                                                <h3 class="mb-0 mt-1  mb-2">$2,7853</h3>
                                            </div>
                                            <span class="text-muted">
                                                <span class="text-danger fs-12 mt-2 me-1"><i
                                                        class="feather feather-arrow-up-right me-1 bg-danger-transparent p-1 brround"></i>21.1%
                                                </span>
                                                for last month
                                            </span>
                                        </div>
                                        <div class="col-4">
                                            <div class="icon1 bg-secondary brround my-auto  float-end"> <i
                                                    class="feather feather-dollar-sign"></i> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- end app-content-->
@endsection
