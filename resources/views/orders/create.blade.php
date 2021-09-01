@extends('layouts.app')

@section('content')
<h1>Order details</h1>

<div class="table-responsive">
			<table class="table table-striped">
				<thead class="thead-light">
					<tr>
						<td>Product</td>
						<td>Price</td>
						<td>Quantity</td>
						<td>Total</td>
					</tr>
				</thead>

				<tbody>
					@foreach ($cart->products as $product)
						<tr>
							<td>
								<img src="{{asset($product->images->first()->path)}}" width="100">
								{{$product->title}}
							</td>
							<td>{{$product->price}}</td>
							<td>{{$product->description}}</td>
							<td>{{$product->pivot->quantity}}</td>
							<td>
								{{ $product->pivot->quantity * $product->price }}
							</td>
						</tr>
					@endforeach
					
				
				</tbody>
			</table>
		</div>

	
@endsection

	
