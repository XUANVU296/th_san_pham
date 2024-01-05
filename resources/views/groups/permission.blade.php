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
                margin-top: 20px;
            }

            .margin-top {
                margin-top: 32px;
            }

            .color {
                color: rgba(243, 239, 239, 0.868);
            }

            .card-header {
                text-align: center;
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
        <script>
            @if (session('successMessage'))
                Swal.fire({
                    icon: 'success',
                    text: '{{ session('successMessage') }}',
                    confirmButtonText: 'Đóng'
                });
            @endif
        </script>
      <div class="header_title container">
        <h2>Trao quyền</h2>
    </div>
    <form action="{{ route('groups.update', $group->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="container margin-top">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header text-center">Danh sách quyền:</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        @php
                                            $count = count($roles);
                                            $halfCount = ceil($count / 2);
                                        @endphp
                                        @foreach ($roles->take($halfCount) as $role)
                                            <li class="list-group-item">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="{{ $role->name }}"
                                                        name="role_id[]" value="{{ $role->id }}"
                                                        {{ $group->roles->pluck('name')->contains($role->name) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="{{ $role->name }}">{{ $role->name }}</label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        @foreach ($roles->skip($halfCount) as $role)
                                            <li class="list-group-item">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="{{ $role->name }}"
                                                        name="role_id[]" value="{{ $role->id }}"
                                                        {{ $group->roles->pluck('name')->contains($role->name) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="{{ $role->name }}">{{ $role->name }}</label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container margin-top">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary btn-block">Lưu</button>
                </div>
            </div>
        </div>
    </form>
        <!-- Thêm đường dẫn đến Bootstrap JS (nếu cần) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>
@endsection
