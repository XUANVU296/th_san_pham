<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use App\Models\Product_tag;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $this->authorize('viewAny', Product::class);
            $categories = Category::get();
            $search = $request->input('search');
            $products = Product::query()
                ->where('name', 'LIKE', "%$search%")
                ->orWhere('status', $search)
                ->get();

            return view('products.index', compact('products', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Bạn không có quyền truy cập vào trang danh sách');
        }
    }
    public function create()
    {
        $this->authorize('create', Product::class);
        $categories = Category::get();
        $tags = Tag::get();
        return view('products.create', compact('categories', 'tags'));
    }
    public function store(StoreProductRequest $request)
    {
        try {
            $selectedTags = $request->input('tag');
            $product = new Product();
            $product->name = $request->name;
            $product->status = $request->status;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->save();
            $product->tags()->attach($selectedTags);
            return redirect()->route('products.index')->with('successMessage', 'Thêm thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Đã xảy ra lỗi trong quá trình thêm sản phẩm');
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $this->authorize('update', Product::class);
            $categories = Category::get();
            $tags = Tag::get();
            $selectedTags = $product->tags->pluck('id')->toArray();
            return view('products.edit', compact('product', 'categories', 'tags', 'selectedTags'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Bạn không có quyền truy cập vào trang chỉnh sửa');
        }
    }
    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->name = $request->name;
            $product->status = $request->status;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->save();
            $selectedTags = $request->input('tag');
            if ($selectedTags) {
                $product->tags()->sync($selectedTags);
            }
            return redirect()->route('products.index')->with('successMessage', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Đã xảy ra lỗi trong quá trình cập nhật');
        }
    }
    public function destroy($id)
    {
        try {
            $this->authorize('delete', Product::class);
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect()->back()->with('successMessage', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Bạn không có quyền truy cập');
        }
    }
}
