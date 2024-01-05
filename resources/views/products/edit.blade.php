@extends('layouts.index')
@section('content')
    <!DOCTYPE html>
    <html>

    <head>
        <!-- Thêm đường dẫn đến Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
        <style>
            .header_title {
                color: red;
                background-color: aqua;
                text-align: center;
                padding: 10px;
                margin-top: 200px;
            }

            .margin-top {
                margin-top: 32px;
            }

            .color {
                color: rgba(243, 239, 239, 0.868);
            }
        </style>
    </head>

    <body>
        <script>
            @if (session('errorMessage'))
                Swal.fire({
                    icon: 'error',
                    text: '{{ session('errorMessage') }}',
                    confirmButtonText: 'Đóng'
                });
            @endif
        </script>
        <h2 class="header_title container">Sửa sản phẩm</h2>
        <form action="{{ route('products.update', $product->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="container">
                <div class="row col-12">
                    <div class="col-6">
                        <label for="fname">Tên sản phẩm:</label>
                        <input type="text" id="fname" name="name" class="form-control"
                            value="{{ $product->name }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="fname">Trạng thái sản phẩm:</label>
                        <select name="status" id="lname" class="form-control">
                            <option value="Còn hàng" <?php echo $product->status == 'Còn hàng' ? 'selected' : ''; ?>>Còn hàng</option>
                            <option value="Hết hàng" <?php echo $product->status == 'Hết hàng' ? 'selected' : ''; ?>>Hết hàng</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="fname">Danh mục:</label>
                        <select name="category_id" id="lname" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" <?php echo $product->category_id == $category->id ? 'selected' : ''; ?>>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="fname">Giá sản phẩm:</label>
                        <input type="text" id="fname" name="price" class="form-control"
                            value="{{ $product->price }}">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6"> <label for="fname">Thẻ:</label>
                        <div class="form-check">
                            @foreach ($tags as $tag)
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="tag[]"
                                    value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineCheckbox1">{{ $tag->name }}</label>
                            @endforeach
                        </div>
                        <div class="margin-top">
                            <button type="submit" class="btn btn-outline-success">Sửa</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Thêm đường dẫn đến Bootstrap JS (nếu cần) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>
@endsection
