<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-3">Product List</h2>

        <!-- Success message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Add Product</a>

        <!-- Check if the product list is empty -->
        @if(empty($products))
            <div class="alert alert-warning">No products available.</div>
        @else
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product['id'] }}</td>
                            <td>{{ $product['name'] }}</td>
                           <td> <img src="{{ asset($product['avatar']) }}" alt="Product Image" width="100"></td>
                            <td>{{ $product['description'] ?? 'No description available' }}</td>
                            <td>{{ isset($product['price']) ? number_format($product['price'], 0, ',', '.') . ' ₫' : 'No price available' }}
                            </td>
                            <td>{{ $product['quantity'] ?? 'No quantity available' }}</td>

                            <td>
                                <a href="{{ route('products.edit', $product['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('products.destroy', $product['id']) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>

</html>
