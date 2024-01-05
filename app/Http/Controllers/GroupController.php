<?php

namespace App\Http\Controllers;

use App\Traits\HasPermissions;
use App\Models\Group;
use App\Models\Role;
use App\Models\Role_Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('viewAny', Group::class);
            $groups = Group::get();
            return view('groups.index', compact('groups'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Bạn không có quyền truy cập');
        }
    }
    public function create()
    {
        try {
            $this->authorize('create', Group::class);
            return view('groups.create');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Bạn không có quyền truy cập');
        }
    }
    public function store(Request $request)
    {
        try {
            $group = new Group();
            $group->name = $request->name;
            $group->save();
            return redirect()->route('groups.index');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors('Đã xảy ra lỗi.');
        }
    }
    public function edit($id)
    {
        $this->authorize('update', Group::class);
        $group = Group::findOrFail($id);
        $roles = Role::get();
        return view('groups.permission', compact('group', 'roles'));
    }
    public function update(Request $request, $id)
    {
        try {
            Role_Group::where('group_id', $id)->delete();
            $roles = $request->role_id;
            if (Auth::user()->group_id != 0) {
                throw new \Exception('Bạn không có quyền cấp quyền');
            }
            foreach ($roles as $role) {
                $group_role = new Role_Group();
                $group_role->role_id = $role;
                $group_role->group_id = $id;
                $group_role->save();
            }

            return redirect()->route('groups.index')->with('successMessage', 'Cấp quyền thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $this->authorize('delete', Group::class);
            $group = Group::findOrFail($id);
            $group->delete();
            return redirect()->back()->with('successMessage', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Bạn không có quyền truy cập');
        }
    }
}
