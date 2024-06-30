@extends('frontend.layouts.app')

@section('content')
    <section id="custom-form">
        <div class="container mt-3">
            <div class="setup-business-account">
                <h2>Service Name</h2>
                <div class="accordion">
                    @foreach ($packages as $package)
                        <div class="quest-section">
                            <div class="ct-accor">
                                <a class="quest-title show-accordion" data-package-id="{{ $package->id }}">
                                    <p>{{ $package->name }}</p>
                                    <span>AED {{ $package->price }}</span>
                                </a>
                                <div class="checkbox-ct">
                                    <label class="ct-container">
                                        <input type="checkbox" value="{{ $package->price }}"
                                            data-package-id="{{ $package->id }}"
                                            onchange="selectPackage({{ $package->id }});" class="package-checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="quest-content accordion-content" id="accordion-{{ $package->id }}">
                                <ul>
                                    @foreach ($package->items as $item)
                                        <li>
                                            <label class="ct-container">{{ $item->name }}
                                                <input type="checkbox" value="{{ $item->price }}"
                                                    data-item-id="{{ $item->id }}"
                                                    data-package-id="{{ $package->id }}" onchange="calculateTotal();"
                                                    class="item-checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                            <p>AED {{ $item->price }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="grandTotalBtn" class="total-amount">
                <div class="total-amount-inner">
                    <h6>Total Amount</h6>
                    <p id="grand-total">AED 0</p>
                </div>
                <div class="total-amount-cart mt-lg-0 mt-2">
                    @if (Auth::check())
                        <a href="javascript:;" class="w-100" id="submit-btn">
                            <i class="fa fa-check"></i>
                            <p>Order Now</p>
                        </a>
                    @else
                        <a href="{{ route('showLoginForm') }}">Login First!</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function selectPackage(packageId) {
            var isChecked = $('input[data-package-id="' + packageId + '"].package-checkbox').prop('checked');

            // Check/uncheck all items within the package
            $('.item-checkbox[data-package-id="' + packageId + '"]').prop('checked', isChecked);

            calculateTotal();
        }

        function calculateTotal() {
            var totalAmount = 0;

            // Calculate the total for selected packages
            $('.package-checkbox:checked').each(function() {
                totalAmount += parseFloat($(this).val());
            });

            // Calculate the total for individually selected items
            $('.item-checkbox').each(function() {
                var packageId = $(this).data('package-id');
                // Only add item price if the package itself is not selected
                if (!$('input[data-package-id="' + packageId + '"].package-checkbox').prop('checked')) {
                    if ($(this).prop('checked')) {
                        totalAmount += parseFloat($(this).val());
                    }
                }
            });

            $('#grand-total').text('AED ' + totalAmount.toFixed(2));
        }

        $(document).ready(function() {
            $('.show-accordion').click(function() {
                var packageId = $(this).data('package-id');
                $('#accordion-' + packageId).slideToggle(300);
            });

            $('#submit-btn').click(function() {
                var selectedItems = [];
                var totalAmount = parseFloat($('#grand-total').text().replace('AED ', ''));

                $('.package-checkbox:checked').each(function() {
                    var packageId = $(this).data('package-id');
                    selectedItems.push({
                        id: packageId,
                        type: 'package',
                        price: parseFloat($(this).val())
                    });

                    // Add all items of this package as individual items
                    $('.item-checkbox[data-package-id="' + packageId + '"]:checked').each(
                function() {
                        selectedItems.push({
                            id: $(this).data('item-id'),
                            type: 'item',
                            price: parseFloat($(this).val())
                        });
                    });
                });

                $('.item-checkbox:checked').each(function() {
                    var packageId = $(this).data('package-id');
                    if (!$('input[data-package-id="' + packageId + '"].package-checkbox').prop(
                            'checked')) {
                        selectedItems.push({
                            id: $(this).data('item-id'),
                            type: 'item',
                            price: parseFloat($(this).val())
                        });
                    }
                });

                $.ajax({
                    url: '{{ route('order.store') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        total_price: totalAmount,
                        items: selectedItems
                    },
                    success: function(response) {
                        flasher.success(response.message);
                    },
                    error: function(response) {
                        flasher.error('Error placing order')
                        alert('Error placing order');
                    }
                });
            });
        });
    </script>
@endpush
