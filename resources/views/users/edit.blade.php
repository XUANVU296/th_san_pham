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
                icon: 'success',
                text: '{{ session('errorMessage') }}',
                confirmButtonText: 'Đóng'
            });
        @endif
    </script>
    <h2 class="header_title container">Sửa danh mục</h2>
    <form action="{{ route('users.update',$user->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row col-12">
                <div class="col-4">
                    <label for="fname">Tên người dùng:</label>
                    <input type="text" id="fname" name="name" class="form-control" value="{{ $user->name }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="fname">Email:</label>
                    <input type="text" id="fname" name="email" class="form-control" value="{{ $user->email }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="fname">Loại tài khoản:</label>
                    <select name="group_id" id="lname" class="form-control">
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" <?php echo $group->name == $user->groups->name ? 'selected' : ''; ?>>{{ $group->name }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-1">
                    <div class="margin-top">
                        <button type="submit" class="form-control btn btn-outline-success">Sửa</button>
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