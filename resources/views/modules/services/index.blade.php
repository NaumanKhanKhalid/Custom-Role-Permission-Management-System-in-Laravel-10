@extends('dashboard.layouts.app')
@section('content')
    <div class="app-content main-content">
        <div class="side-app">
            @include('dashboard.layouts.header')
            <!--Page header-->
            <div class="page-header d-xl-flex d-block">
                <div class="page-leftheader">
                    <h4 class="page-title">
                        @if (request('trashed'))
                            Deleted
                        @endif Services List
                    </h4>
                </div>
                <div class="page-rightheader ms-md-auto">
                    <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                        <div class="btn-list">
                            @can('service_management', 'create_service')
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#newServiceModal"><i
                                        class="feather feather-plus fs-15 my-auto me-2"></i>Create New Service</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <!--End Page header-->

            <!-- Row -->
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-12">
                    <div class="card">
                        <a href="#">
                            <div class="card-body text-center">
                                <span
                                    class="avatar avatar-lg bradius fs-20 bg-primary-transparent">{{ $totalServicesCount }}</span>
                                <h5 class="mb-0 mt-3">Total Services</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                    <div class="card">
                        <a href="#">
                            <div class="card-body text-center">
                                <span
                                    class="avatar avatar-lg bradius fs-20 bg-success-transparent">{{ $activeServicesCount }}</span>
                                <h5 class="mb-0 mt-3">Active Services</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                    <div class="card">
                        <a href="#">
                            <div class="card-body text-center">
                                <span
                                    class="avatar avatar-lg bradius fs-20 bg-danger-transparent">{{ $inactiveServicesCount }}</span>
                                <h5 class="mb-0 mt-3">Inactive Services</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                    <div class="card">
                        <a href="#">
                            <div class="card-body text-center">
                                <span
                                    class="avatar avatar-lg bradius fs-20 bg-secondary-transparent">{{ $trashedServicesCount }}</span>
                                <h5 class="mb-0 mt-3">Trashed Services</h5>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
            <!-- End Row-->

            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header  border-0">
                            <h4 class="card-title">Services Summary</h4>
                            <div class="ms-auto">
                                <div class="input-group">
                                    <input class="form-control" placeholder="Search....." type="text">
                                    <span class="input-group-btn">
                                        <button class="btn btn-light br-ts-0 br-bs-0">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('services.index') }}" method="GET">
                                <div class="row">


                                    <div class="col-md-12 col-xl-5">
                                        <div class="form-group">
                                            <label class="form-label">Select Status:</label>
                                            <select name="status" class="form-control custom-select select2"
                                                data-placeholder="Select Status">
                                                <option label="Select Status"></option>
                                                <option value="Acive">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xl-2">
                                        <div class="form-group mt-5">
                                            <button type="submit" class="btn btn-primary btn-block">Search</button>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-vcenter text-nowrap table-bordered border-bottom" id="service-list">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">#ID</th>
                                            <th class="border-bottom-0">Name</th>
                                            <th class="border-bottom-0">Icon</th>
                                            <th class="border-bottom-0">Description</th>
                                            <th class="border-bottom-0">Created At</th>
                                            <th class="border-bottom-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $service)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $service->name }}</td>
                                            <td><i class="{{ $service->icon }}" style="font-size: 24px"></i></td>
                                            <td>{{ $service->description }}</td>
                                            <td>{{ $service->created_at->format('F d, Y') }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @if (request('trashed'))
                                                    <form action="{{ route('service.permanent.delete', ['id' => $service->id]) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type='submit' class="action-btns1 bg-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanent Delete Service">
                                                            <i class="feather feather-trash-2 text-danger"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('service.restore', ['id' => $service->id]) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="action-btns1 bg-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Restore Service">
                                                            <i class="feather feather-rotate-ccw text-success"></i>
                                                        </button>
                                                    </form>
                                                    @else
                                                    <a href="{{ route('service.show', ['service'=> $service]) }}" class="action-btns1 bg-white" data-bs-toggle="tooltip" data-bs-placement="top" title="View Service">
                                                        <i class="feather feather-eye text-primary"></i>
                                                    </a>
                                                    <a href="{{ route('service.edit', ['service'=> $service]) }}" class="action-btns1 bg-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Service">
                                                        <i class="feather feather-edit-2 text-success"></i>
                                                    </a>
                                                    <form action="{{ route('service.destroy', ['service' => $service]) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type='submit' class="action-btns1 bg-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Service">
                                                            <i class="feather feather-trash-2 text-danger"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('service.updateStatus', ['service' => $service]) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="status"
                                                            value="{{ $service->status == 'Active' ? 'Inactive' : 'Active' }}">
                                                        <button type="submit" class="action-btns1 bg-white"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="{{ $service->status == 'Active' ? 'Inative service' : 'Activate service' }}">
                                                            <i
                                                                class="feather {{ $service->status == 'Active' ? 'feather-x-circle text-danger' : 'feather-check-circle text-success' }}"></i>
                                                        </button>
                                                    </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- New Service Modal -->
            <div class="modal fade" id="newServiceModal">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Service</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Service Name:</label>
                                        <input class="form-control" type="text" name="name"
                                            placeholder="Service Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Service Icon:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="serviceIcon"
                                                placeholder="Select an icon" name="icon">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                                    id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
                                                    <i id="selected-icon" class="fas fa-icons"></i>
                                                </button>
                                                <div class="dropdown-menu IconPickerDropdown">
                                                    <div class="icon-picker">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Description:</label>
                                    <textarea class="form-control" name="description" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary"
                                    data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- New Service Modal End -->
        </div>
    </div><!-- end app-content-->

    @push('scripts')
    <!-- Your existing scripts -->
    <script>
        $(document).ready(function() {
            $('#editServiceIcon').iconpicker({
                placement: 'bottom',
                animation: false
            });

            $('#editServiceIcon').on('iconpickerSelected', function(event) {
                $('#selected-edit-icon').attr('class', event.iconpickerValue);
            });
        });
    </script>
@endpush
@endsection
