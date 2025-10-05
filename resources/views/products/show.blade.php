@extends('products.layout')
@section('content')


    <br>
    <div class="container">
        <div class="row">
            <div class="col align-self-start">
                <a class="btn btn-primary"href="{{route('products.index')}}">All Products</a>
            </div>
        
        </div>
    </div>
    <br>

    
        
            
            
        <div class="mb-3">
            
            
            <h3>Name : {{$product->name}}</h3>    
                
            
        </div>
        <div class="mb-3">
                
            <p>{{$product->details}}</p>
        </div>
        <div class="mb-3">
            <img src="/images/{{$product->image}}" width="300px">
        </div>
            
            
      
    

@endsection