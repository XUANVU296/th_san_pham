<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('viewAny', User::class);
            $users = User::with('groups')->get();
            return view('users.index', compact('users'));
        } catch (AuthorizationException $e) {
            return back()->with('errorMessage', 'Bạn không có quyền truy cập vào trang này.');
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Đã xảy ra lỗi: ' . $e->getMessage());
        }
    }
    public function create()
    {
        try {
            $this->authorize('create', User::class);
            $groups = Group::get();
            return view('users.create', compact('groups'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Bạn không có quyền truy cập vào trang tạo người dùng');
        }
    }
    public function store(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('123123');
            $user->group_id = $request->group_id;
            $user->save();
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors('Đã xảy ra lỗi.');
        }
    }
    public function edit($id)
    {
        $this->authorize('update', User::class);
        $user = User::findOrFail($id);
        $groups = Group::get();
        return view('users.edit', compact('user', 'groups'));
    }
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = null;
            $user->group_id = $request->group_id;
            $user->save();
            return redirect()->route('users.index')->with('successMessage', 'Cập nhật thành công');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('users.index')->with('errorMessage', 'Không tìm thấy bản ghi');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('errorMessage', 'Lỗi truy vấn CSDL');
        }
    }
    public function destroy($id)
    {
        try {
            $this->authorize('delete', User::class);
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->back()->with('successMessage', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Đã xảy ra lỗi khi xóa danh mục');
        }
    }
}
