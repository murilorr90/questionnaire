@extends('admin.layout')

@section('content')
    <h1>{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h1>

    <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif

        <div class="form-group">
            <div class="input-group mb-2">
                <input type="text" name="name" id="product" class="form-control" placeholder="Name" value="{{ old('product', $product->name ?? '') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group mb-2">
                <input type="text" name="uid" id="uid" class="form-control" placeholder="UID" value="{{ old('uid', $product->uid ?? '') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group mb-2">
                <input type="number" min="0" step="1" name="size" id="size" class="form-control" placeholder="Size" value="{{ old('size', $product->size ?? '') }}">
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update Product' : 'Create Product' }}</button>
    </form>
@endsection
