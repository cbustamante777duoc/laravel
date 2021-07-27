@extends('layouts.app')

@section('content')
    <h1>Welcome</h1>
    @empty ($products)
        <div class="alert alert-danger">
           pagina principal
        </div>
    @else
        <div class="row">
            @foreach ($products as $product)
                <<td>{{$product->id}}</td>
                <td>{{$product->title}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->stock}}</td>	
                <td>{{$product->status}}</td>
            @endforeach
        </div>
    @endempty
@endsection