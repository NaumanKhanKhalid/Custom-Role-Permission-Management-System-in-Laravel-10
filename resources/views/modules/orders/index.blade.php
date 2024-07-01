@extends('dashboard.layouts.app')

@section('content')
    <div class="app-content main-content">
        <div class="side-app">
            @include('dashboard.layouts.header')
            <!--Page header-->
            <div class="page-header d-xl-flex d-block">
                <div class="page-leftheader">
                    <h4 class="page-title">
                        Orders List
                    </h4>
                </div>
                <div class="page-rightheader ms-md-auto">
                    <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
                        <!-- Add any additional buttons or controls here -->
                    </div>
                </div>
            </div>
            <!--End Page header-->
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <h4 class="card-title">Orders Summary</h4>
                            <!-- Add search or filter options if needed -->
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-vcenter text-nowrap table-bordered border-bottom" id="order-list">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">#ID</th>
                                            <th class="border-bottom-0">Client</th>
                                            <th class="border-bottom-0">Total Price</th>
                                            <th class="border-bottom-0">Status</th>
                                            <th class="border-bottom-0">Progress</th>

                                            <th class="border-bottom-0">Vendor Name</th>
                                            <th class="border-bottom-0">Created At</th>
                                            <th class="border-bottom-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            @php
                                                $statusColors = [
                                                    'Pending' => 'badge-warning',
                                                    'Approved' => 'badge-success',
                                                    'Assigned' => 'badge-primary',
                                                    'In Progress' => 'badge-info',
                                                    'Rejected' => 'badge-danger',
                                                    'Cancelled' => 'badge-secondary',
                                                ];

                                                $statusActions = [
                                                    'Pending' => ['Approved', 'Rejected'],
                                                    'Approved' => ['Assigned', 'Rejected'],
                                                    'Assigned' => ['In Progress', 'Cancelled'],
                                                    'In Progress' => ['Completed', 'Cancelled'],
                                                    'Rejected' => [],
                                                    'Cancelled' => [],
                                                ];
                                            @endphp
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->client->first_name . ' ' . $order->client->last_name }}</td>
                                                <td>{{ $order->total_price }}</td>



                                                <td>

                                                    <span
                                                        class="badge {{ $statusColors[$order->status] ?? 'badge-light' }}">
                                                        {{ $order->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $order->progress_percentage }}
                                                </td>
                                                <td>{{ $order->assignedUser ? $order->assignedUser->first_name . ' ' . $order->assignedUser->last_name : 'Not Assigned' }}
                                                </td>

                                                <td>{{ $order->created_at->format('F d, Y') }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="#" data-order-id="{{ $order->id }}"
                                                            class="action-btns1 bg-white view-order-btn"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="View Order">
                                                            <i class="feather feather-eye text-primary"></i>
                                                        </a>


                                                        @if (in_array(Auth::user()->role->name, ['Admin', 'Vendor']))
                                                        <a href="#" data-order-id="{{ $order->id }}"
                                                            class="action-btns1 bg-white update-item-progress-btn"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Update Progress">
                                                            <i class="feather feather-edit-2 text-primary"></i>
                                                        </a>

                                                            <div class="dropdown ms-2">
                                                                <button
                                                                    class="btn btn-sm btn-outline-primary dropdown-toggle"
                                                                    type="button"
                                                                    id="dropdownMenuButton{{ $order->id }}"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Change Status
                                                                </button>
                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton{{ $order->id }}">
                                                                    @foreach ($statusActions[$order->status] as $action)
                                                                        @if ($action === 'Assigned')
                                                                            <li>
                                                                                <a href="#"
                                                                                    class="dropdown-item assign-vendor-btn"
                                                                                    data-order-id="{{ $order->id }}"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#assignVendorModal">
                                                                                    {{ $action }}
                                                                                </a>
                                                                            </li>
                                                                        @else
                                                                            <li>
                                                                                <form
                                                                                    action="{{ route('orders.updateStatus', $order->id) }}"
                                                                                    method="POST" style="display:inline;">
                                                                                    @csrf
                                                                                    @method('PATCH')
                                                                                    <input type="hidden" name="status"
                                                                                        value="{{ $action }}">
                                                                                    <button type="submit"
                                                                                        class="dropdown-item">{{ $action }}</button>
                                                                                </form>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Assign Vendor Modal -->
                                <div class="modal fade" id="assignVendorModal" tabindex="-1"
                                    aria-labelledby="assignVendorModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <form action="{{ route('orders.assign') }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="assignVendorModalLabel">Assign Vendor</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Select a vendor to assign to this order.</p>
                                                    <select name="vendor_id" class="form-control">
                                                        @foreach ($vendors as $vendor)
                                                            <option value="{{ $vendor->id }}">
                                                                {{ $vendor->first_name . ' ' . $vendor->last_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input type="text" name="order_id" class="assign_order_id">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Assign To Vendor</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewOrderModal" tabindex="-1" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewOrderModalLabel">Order Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Service Name:</label>
                                <input class="form-control" type="text" id="serviceName" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Package Name:</label>
                                <input class="form-control" type="text" id="packageName" readonly>
                            </div>
                        </div>
                        <!-- Items Section -->
                        <hr>
                        <h5>Ordered Items</h5>
                        <div id="orderedItemsContainer">
                            <!-- Items will be dynamically added here -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updateItemProgressModal" tabindex="-1"
            aria-labelledby="updateItemProgressModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <form id="updateItemProgressForm" action="{{ route('orders.updateProgress') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateItemProgressModalLabel">Update Item Progress</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="orderItemsContainer">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="order_id" class="progress_order_id">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Progress</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('.view-order-btn').click(function() {
                        var orderId = $(this).data('order-id');
                        $.ajax({
                            url: "{{ route('orders.show', '') }}" + "/" + orderId,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                // Populate order details in the modal
                                $('#serviceName').val(response.order.service_name);
                                $('#packageName').val(response.order.package_name);

                                // Clear previous items and populate new items
                                $('#orderedItemsContainer').empty();
                                response.items.forEach(function(item) {
                                    var itemHtml =
                                        '<div class="row mb-3">' +
                                        '<div class="col-md-4">' +
                                        '<label class="form-label">Item Name:</label>' +
                                        '<input class="form-control" type="text" readonly value="' +
                                        item.name + '">' +
                                        '</div>' +
                                        '<div class="col-md-4">' +
                                        '<label class="form-label">Item Price:</label>' +
                                        '<input class="form-control" type="text" readonly value="' +
                                        item.price + '">' +
                                        '</div>' +
                                        '<div class="col-md-4">' +
                                        '<label class="form-label">Progress:</label>' +
                                        '<input class="form-control" type="number" readonly value="' +
                                        item.progress_percentage + '">' +
                                        '</div>' +
                                        '</div>';
                                    $('#orderedItemsContainer').append(itemHtml);
                                });

                                $('#viewOrderModal').modal('show');
                            },
                            error: function() {
                                alert('Error fetching order details');
                            }
                        });
                    });

                    $('.assign-vendor-btn').click(function(e) {
                        e.preventDefault();
                        var orderId = $(this).data('order-id');
                        $('.assign_order_id').val(orderId);
                    });


                    $('.update-item-progress-btn').click(function() {
                        var orderId = $(this).data('order-id');

                        $.ajax({
                            url: "{{ route('orders.show', '') }}" + "/" + orderId,
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                $('#orderItemsContainer').empty();

                                response.items.forEach(function(item) {
                                    var itemHtml =
                                        '<div class="row mb-3">' +
                                        '<div class="col-md-4">' +
                                        '<label class="form-label">Item Name:</label>' +
                                        '<input class="form-control" type="text" readonly value="' +
                                        item.name + '">' +
                                        '</div>' +
                                        '<div class="col-md-4">' +
                                        '<label class="form-label">Item Price:</label>' +
                                        '<input class="form-control" type="text" readonly value="' +
                                        item.price + '">' +
                                        '</div>' +
                                        '<div class="col-md-4">' +
                                        '<label for="progress_percentage_' + item.id +
                                        '">Progress Percentage:</label>' +
                                        '<input class="form-control" id="progress_percentage_' +
                                        item.id +
                                        '" name="progress_percentage[]" type="number" min="0" max="100" value="' +
                                        item.progress_percentage + '">' +
                                        '<input type="hidden" name="item_ids[]" value="' + item
                                        .id + '">' +
                                        '</div>' +
                                        '</div>';

                                    $('#orderItemsContainer').append(itemHtml);
                                    $('.progress_order_id').val(orderId);
                                });

                                $('#updateItemProgressModal').modal('show');
                            },
                            error: function() {
                                alert('Error fetching order details');
                            }
                        });
                    });

                });
            </script>
        @endpush
    @endsection
