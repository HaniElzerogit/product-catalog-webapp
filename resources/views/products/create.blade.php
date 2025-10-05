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
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $item)
                  <li>{{$item}}</li>  
                @endforeach
            </ul>
        </div>
        
    @endif
    <div class="container p-5">
        <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- enctyp to accept photo --}}
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                {{-- الأسم لازم يكون نفس الأسم المحطوط بالكونترولر --}}
                <input type="text" class="form-control" name="name">
            
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Details</label>
                <textarea class="form-control" name="details" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Image</label>
                <input type="file" class="form-control" name="image">
            </div>
            <button type="submit" class="btn btn-primary" > Submit </button>
            
        </form>    
    </div>

@endsection