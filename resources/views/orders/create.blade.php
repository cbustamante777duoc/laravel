@extends('layouts.app')

@section('content')
<h1>Order details</h1>

<h4 class="text-center"> <strong>Gran Total: </strong> {{$cart->total}} </h4>

<div class="text-center mb-3">
	
	<!--boton para agregar-->
	<form 
	class="d-inline" 
	method="POST" 
	action="{{ route('orders.store') }}"
	>
	
	@csrf
	<button type="submit" class="btn btn-success">Confirm Order</button>
	
	</form>

</div>

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
							<td>{{$product->pivot->quantity}}</td>
							<td>
								<strong>
									{{ $product->total }}
								</strong>
							</td>
						</tr>
					@endforeach
					
				
				</tbody>
			</table>
		</div>

	
@endsection

	
