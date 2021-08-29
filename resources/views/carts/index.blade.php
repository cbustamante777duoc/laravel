@extends('layouts.app')

@section('content')
    <h1>your cart</h1>
    @if ($cart->products->isEmpty())
        <div class="alert alert-warning">
            your cart is empty
        </div>
    @else
        <div class="row">
            @foreach ($cart->products as $product)
                <div class="col-3">
                    @include('components.product-card')
                </div>
            @endforeach
        </div>
    @endempty
@endsection
