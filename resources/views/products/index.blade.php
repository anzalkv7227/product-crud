@extends('layouts.app')
@section('title', 'Products')
@section('content')

    <div class="container py-4">
        <h1 class="text-center mb-4">Products</h1>

        <div class="d-md-flex mb-4">
            <a href="{{ route('products.create') }}" class="btn btn-success mb-3 mb-md-0"><i class="fa-solid fa-plus me-2"></i>Add Product</a>
            <div class="ms-auto">
                <form action="{{ route('products.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search products">
                    <button type="submit" class="btn btn-secondary d-flex align-items-center"><i class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                </form>
            </div>
        </div>

        @if($products->isEmpty())
            <div class="col-12 border border-danger p-3 text-center">No products</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td> {{ $products->firstItem() + $loop->index }}. </td>
                            <td> {{ $product->name }} </td>
                            <td> {{ $product->description }} </td>
                            <td> {{ $product->price }} </td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm me-sm-2 mb-2 mb-lg-0"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')"><i class="fa-solid fa-trash me-2"></i>Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success" id="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-center mt-2">
            {{ $products->links() }}
        </div>
    </div>

    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 3000); 
    </script>

@endsection



