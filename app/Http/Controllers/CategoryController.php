<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $this->authorize('viewAny', Category::class);
            $search = $request->input('search');
            $categories = Category::query()
                ->where('name', 'LIKE', "%$search%")
                ->orWhere(function ($query) use ($search) {
                    if ($search == 'Còn hàng') {
                        $query->where('status', 'Còn hàng');
                    } elseif ($search == 'Hết hàng') {
                        $query->where('status', 'Hết hàng');
                    }
                })
                ->get();
            $param = [
                '0' => 'Còn hàng',
                '1' => 'Hết hàng',
            ];
            return view('categories.index', compact('categories', 'param'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Bạn không có quyền truy cập vào trang danh sách');
        }
    }
    public function create()
    {
        try {
            $this->authorize('create', Category::class);
            return view('categories.create');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Bạn không có quyền truy cập vào trang tạo mới');
        }
    }
    public function store(StoreCategoryRequest $request)
    {
        try {
            $categories = new Category();
            $categories->name = $request->name;
            $categories->status = $request->status;
            $categories->save();
            return redirect()->route('categories.index')->with('successMessage', 'Thêm thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Đã xảy ra lỗi');
        }
    }
    public function edit($id)
    {
        try {
            $categories = Category::findOrFail($id);
            $this->authorize('update', Category::class);
            return view('categories.edit', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Bạn không có quyền truy cập vào trang chỉnh sửa');
        }
    }
    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            $categories = Category::findOrFail($id);
            $categories->name = $request->name;
            $categories->status = $request->status;
            $categories->save();
            return redirect()->route('categories.index')->with('successMessage', 'Cập nhật thành công');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('categories.index')->with('errorMessage', 'Không tìm thấy bản ghi');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('errorMessage', 'Lỗi truy vấn CSDL');
        }
    }
    public function destroy($id)
    {
        try {
            $this->authorize('delete', Category::class);
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()->back()->with('successMessage', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Bạn không có quyền truy cập');
        }
    }
}
