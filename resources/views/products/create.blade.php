@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Thêm sản phẩm</h2>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" id="name" name="name" placeholder="Tên sản phẩm" required class="form-control mb-2">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="avatar">Ảnh</label>
            <textarea id="avatar" name="avatar" placeholder="Ảnh sản phẩm" class="form-control mb-2"></textarea>

            @error('avatar')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea id="description" name="description" placeholder="Mô tả sản phẩm" class="form-control mb-2"></textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" id="price" name="price" placeholder="Giá" required class="form-control mb-2" min="0" step="0.01">
            @error('price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="quantity">Số lượng</label>
            <input type="number" id="quantity" name="quantity" placeholder="Số lượng" required class="form-control mb-3" min="0">
            @error('quantity')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>
@endsection