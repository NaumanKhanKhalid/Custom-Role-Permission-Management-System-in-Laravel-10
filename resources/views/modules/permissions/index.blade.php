@extends('dashboard.layouts.app')
@section('content')
<div class="app-content main-content">
    <div class="side-app">
        @include('dashboard.layouts.header')
        <!--Page header-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <h4 class="page-title">Role Access</h4>
            </div>
        </div>
        <!--End Page header-->
        <!--Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive role-table">
                            <table class="table  table-vcenter text-nowrap table-bordered border-bottom"
                                id="superrole-list">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0 w-5 text-center">Sr No</th>
                                        <th class="border-bottom-0">Module Name</th>
                                        <th class="border-bottom-0 text-center">Create</th>
                                        <th class="border-bottom-0 text-center">Read</th>
                                        <th class="border-bottom-0 text-center">Update</th>
                                        <th class="border-bottom-0 text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $yesClass = "feather feather-check text-success icon-style-circle
                                    bg-success-transparent";
                                    $noClass = "feather feather-x text-danger icon-style-circle bg-danger-transparent";
                                    @endphp
                                    <tr>
                                        <td>1</td>
                                        <td class="font-weight-semibold">User Managment</td>

                                        <td class="text-center">
                                            <span
                                                class="{{ $roles->permissions->contains('id','1') ? $yesClass : $noClass }}"></span>
                                        </td>

                                        <td class="text-center">
                                            <span
                                                class="{{ $roles->permissions->contains('id','2') ? $yesClass : $noClass }}"></span>
                                        </td>

                                        <td class="text-center">
                                            <span
                                                class="{{ $roles->permissions->contains('id','3') ? $yesClass : $noClass }}"></span>
                                        </td>

                                        <td class="text-center">
                                            <span
                                                class="{{ $roles->permissions->contains('id','4') ? $yesClass : $noClass }}"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row-->
    </div>
</div><!-- end app-content-->
@endsection