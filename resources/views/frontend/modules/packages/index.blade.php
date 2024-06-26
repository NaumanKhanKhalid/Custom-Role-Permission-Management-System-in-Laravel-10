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
                                        <input type="checkbox" value="{{ $package->price }}" onchange="calculateTotal();" class="package-checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="quest-content accordion-content" id="accordion-{{ $package->id }}">
                                <ul>
                                    @foreach ($package->items as $item)
                                        <li>
                                            <label class="ct-container">{{ $item->name }}
                                                <input type="checkbox" value="{{ $item->price }}" onchange="calculateTotal();" class="item-checkbox">
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
                    <a href="javascript:;" class="w-100" id="submit-btn" onclick="initiatePayPalPayment()">
                        <i class="fa fa-check"></i>
                        <p>Pay with PayPal</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // PayPal SDK script initialization
        var paypalScriptLoaded = false;
        function loadPayPalScript(callback) {
            if (!paypalScriptLoaded) {
                paypalScriptLoaded = true;
                var script = document.createElement('script');
                script.src = 'https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID&currency=AED';
                script.onload = callback;
                document.body.appendChild(script);
            } else {
                callback();
            }
        }

        function initiatePayPalPayment() {
            loadPayPalScript(function() {
                // Replace with your PayPal client ID
                paypal.Buttons({
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: $('#grand-total').text().replace('AED ', '') // Total amount to be paid
                                }
                            }]
                        });
                    },
                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(details) {
                            alert('Transaction completed by ' + details.payer.name.given_name);
                            // You can redirect to a success page or handle further processing here
                        });
                    }
                }).render('#paypal-button-container');
            });
        }

        function calculateTotal() {
            var totalAmount = 0;

            $('.package-checkbox:checked, .item-checkbox:checked').each(function() {
                totalAmount += parseFloat($(this).val());
            });

            $('#grand-total').text('AED ' + totalAmount.toFixed(2));
        }

        $(document).ready(function() {
            $('.show-accordion').click(function() {
                var packageId = $(this).data('package-id');
                $('#accordion-' + packageId).slideToggle(300);
            });

            // Initial calculation when the page loads
            calculateTotal();
        });
    </script>
@endpush
