<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
    public function index(Request $request)
    {
        try {
            $this->authorize('viewAny', Tag::class);
            $search = $request->input('search');
            $tags = Tag::query()
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
            return view('tags.index', compact('tags', 'param'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Bạn không có quyền truy cập vào trang danh sách');
        }
    }
    public function create()
    {
        try {
            $this->authorize('create', Tag::class);
            return view('tags.create');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Bạn không có quyền truy cập vào trang tạo mới');
        }
    }
    public function store(StoreTagRequest $request)
    {
        try {
            $tags = new Tag();
            $tags->name = $request->name;
            $tags->status = $request->status;
            $tags->save();
            return redirect()->route('tags.index')->with('successMessage', 'Thêm thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Đã xảy ra lỗi');
        }
    }
    public function edit($id)
    {
        try {
            $this->authorize('update', Tag::class);
            $tag = Tag::findOrFail($id);
            return view('tags.edit', compact('tag'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Bạn không có quyền truy cập vào trang chỉnh sửa');
        }
    }
    public function update(UpdateTagRequest $request, $id)
    {
        try {
            $tags = Tag::findOrFail($id);
            $tags->name = $request->name;
            $tags->status = $request->status;
            $tags->save();
            return redirect()->route('tags.index')->with('successMessage', 'Cập nhật thành công');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('tags.index')->with('errorMessage', 'Không tìm thấy bản ghi');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('errorMessage', 'Lỗi truy vấn CSDL');
        }
    }
    public function destroy($id)
    {
        try {
            $this->authorize('delete', Tag::class);
            $tag = Tag::findOrFail($id);
            $tag->delete();
            return redirect()->back()->with('successMessage', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Bạn không có quyền truy cập');
        }
    }
}
