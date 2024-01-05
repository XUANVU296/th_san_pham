<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ asset('assets/index.html')}}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Trang chủ</span>
        </a>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('categories.index')}}">
                <i class="mdi mdi-folder-outline menu-icon"></i>
                <span class="menu-title">Danh mục</span>
            </a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('products.index')}}">
            <i class="mdi mdi-package-variant-closed menu-icon"></i>
          <span class="menu-title">Sản phẩm </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('tags.index')}}">
            <i class="mdi mdi-cards-playing-outline menu-icon"></i>
          <span class="menu-title">Thẻ</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('groups.index')}}">
          <i class="mdi mdi-lock menu-icon"></i>
          <span class="menu-title">Quyền</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index')}}">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">Người dùng</span>
        </a>
      </li>
    </ul>
  </nav>