@extends('dashboard.layouts.app')
@section('content')
<div class="app-content main-content">
    <div class="side-app">
        @include('dashboard.layouts.header')
        <!--Page header-->
        <div class="page-header d-xl-flex d-block">
            <div class="page-leftheader">
                <h4 class="page-title">Edit Service</h4>
            </div>
        </div>
        <!--End Page header-->
        <!-- Row -->
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12">
                <div class="panel-body tabs-menu-body hremp-tabs1 p-0">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab5">
                            <form action="{{ route('service.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="card-body">
                                    <h4 class="mb-4 font-weight-bold">Basic</h4>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label mb-0 mt-2">Service Name</label>
                                            <input type="text" class="form-control" placeholder="Service Name"
                                                name="name" value="{{ $service->name }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-0 mt-2">Service Icon</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="serviceIcon" name="icon" value="{{ $service->icon }}" placeholder="Select an icon">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i id="selected-icon" class="{{ $service->icon }}"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <div class="icon-picker">
                                                            <i class="fas fa-home"></i>
                                                            <i class="fas fa-user"></i>
                                                            <i class="fas fa-cog"></i>
                                                            <!-- Add more icons as needed -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label mb-0 mt-2">Description</label>
                                        <textarea rows="3" name="description" class="form-control"
                                            placeholder="Description">{{ $service->description }}</textarea>
                                    </div>
                                </div>

                                <div class="card-footer text-end">
                                    <button class="btn btn-outline-primary">Back</button>
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row-->
        </div><!-- end app-content-->
    </div>
</div>
@endsection
