<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        //'this  is the list of products from Controller';
        return View('products.index');
    }

    public function create()
    {
        return 'this  is the form create a product';
    }

    public function store()
    {
      return 'test message';   
    }    

    public function show($product)
    {
        return View('products.show');
    }

    public function edit($product)
    {

        return "showing form to edit the product with id {$product}";
    }

    public function update($product)
    {

       return "message test";
    }


    public function destroy($product)
    {
     
        return "message test"; 
    }

   
}