<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function list()
    {
        $data['admins'] = User::getAdmin();
        return view('admin.admin.list', $data);
    }
    public function add()
    {
        return view('admin.admin.add');
    }
    public function PostAdd(Request $request)
    {
        $user = new User();
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->save();
        return redirect('admin/admin/list')->with('success', 'Admin Successfully Created');
        // dd($request);
    }

    public function edit($id)
    {
        $admin = User::getOneAdmin($id);
        if (!empty($admin)) {
            $data['admin'] = $admin;
            return view('admin.admin.edit', $data);
        } else {
            abort(404);
        }
    }
    public function PostEdit($id, Request $request)
    {
        $admin = User::getOneAdmin($id);
        $admin->name = trim($request->name);
        $admin->email = trim($request->email);
        if (!empty($request->password)) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();
        return redirect('admin/admin/list')->with('success', 'Admin Successfully Updated');


    }
    public function delete($id)
    {
        $admin = User::getOneAdmin($id);
        $admin->is_delete = 1;
        $admin->save();
        return redirect('admin/admin/list')->with('success', 'Admin Successfully Deleted');
    }

}
