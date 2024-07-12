@extends('frontend.layouts.app')
@section('title', 'Services')
@section('content')
    <!-- Cards Section Start -->
    <section>
        <div class="container">
            <div class="row py-5">
                @foreach ($services as $service)
                    <div class="col-lg-4">
                        <div class="card__box">
                            <div>
                                <div class="card__icon">
                                    <i class="{{ $service->icon }}" style="font-size: 100px"></i>
                                </div>
                                <div class="mt-4">
                                    <h4>{{ $service->name }}</h4>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p>
                                    {{ $service->description }}
                                </p>
                            </div>
                            <div class="w-100 d-flex align-items-center justify-content-center mt-3">
                                <a href="{{ route('packages.index', ['service' => $service->id]) }}" class="btn__purple">Packages</a>
                            </div>
                            <div class="mt-4">
                                <h5>Reviews</h5>
                                {{-- @forelse ($service->reviews as $review) --}}
                                    <div class="review">
                                        <p><strong>NOman:</strong>very good</p>
                                    </div>
                                {{-- @empty --}}
                                    <p>No reviews yet.</p>
                                {{-- @endforelse --}}
                                @auth
                                    <form action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                                        <div class="form-group">
                                            <textarea name="content" class="form-control" rows="3" placeholder="Add your review"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                    </form>
                                @else
                                    <p>Please <a href="{{ route('login') }}">login</a> to add a review.</p>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
