<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h1>List of products</h1>

	@empty ($products)	   
		<div class="alert alert-warning">
            the list of products is empty
		</div>
	@else
		<div class="table-responsive">
			<table class="table table-striped">
				<thead class="thead-light">
					<tr>
						<td>Id</td>
						<td>Title</td>
						<td>Description</td>
						<td>price</td>
						<td>stock</td>
						<td>status</td>
					</tr>
				</thead>

				<tbody>
					@foreach ($products as $product)
						<tr>
							<td>{{$product->id}}</td>
							<td>{{$product->title}}</td>
							<td>{{$product->description}}</td>
							<td>{{$product->price}}</td>
							<td>{{$product->stock}}</td>	
							<td>{{$product->status}}</td>
						</tr>
					@endforeach
					
				
				</tbody>
			</table>
		</div>

	@endempty

</body>
</html>