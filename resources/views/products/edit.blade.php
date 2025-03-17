@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Product</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required class="form-control mb-2">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control mb-2">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required class="form-control mb-2" min="0" step="0.01">
            @error('price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required class="form-control mb-3" min="0">
            @error('quantity')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Avatar Input + Preview -->
        <div class="form-group">
            <label for="avatar">Image Link</label>
            <input type="text" id="avatar" name="avatar" value="{{ old('avatar', $product->avatar) }}" class="form-control mb-2" oninput="updateImage()">
            @error('avatar')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Image Preview -->
        <div class="mb-3">
            <img id="avatarPreview" src="{{ old('avatar', $product->avatar) }}" alt="Product Image" width="150" onerror="this.src='https://via.placeholder.com/150'">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    function updateImage() {
        let input = document.getElementById('avatar').value;
        let img = document.getElementById('avatarPreview');
        img.src = input ? input : 'https://via.placeholder.com/150'; // Hiển thị ảnh mặc định nếu rỗng
    }
</script>
@endsection
