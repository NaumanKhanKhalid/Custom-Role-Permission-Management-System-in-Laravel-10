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
                                        <input type="checkbox" value="{{ $package->price }}" data-package-id="{{ $package->id }}"
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
                                                <input type="checkbox" value="{{ $item->price }}" data-item-id="{{ $item->id }}"
                                                    data-package-id="{{ $package->id }}" onchange="calculateTotal();" class="item-checkbox">
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
            var isChecked = $('input[data-package-id="' + packageId + '"]').prop('checked');
            $('input[data-package-id="' + packageId + '"]').prop('checked', isChecked);
            calculateTotal();
        }

        function calculateTotal() {
            var totalAmount = 0;

            $('.package-checkbox:checked').each(function() {
                totalAmount += parseFloat($(this).val());

                var packageId = $(this).data('package-id');
                $('.item-checkbox[data-package-id="' + packageId + '"]').prop('checked', true);
            });

            $('.item-checkbox:checked').each(function() {
                totalAmount += parseFloat($(this).val());
            });

            $('#grand-total').text('AED ' + totalAmount.toFixed(2));
        }

        $(document).ready(function() {
            $('.show-accordion').click(function() {
                var packageId = $(this).data('package-id');
                $('#accordion-' + packageId).slideToggle(300);
            });

           
        });
    </script>
@endpush
