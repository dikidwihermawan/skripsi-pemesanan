<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('users.index', [
            'role' => $request->role,
        ]);
    }
    public function read($role)
    {
        $users = User::where('role', $role)->get();
        return view('users.table', compact('users'));
    }
    public function view($role, $id)
    {
        $users = User::find($id);
        return response()->json($users);
    }
    public function update(Request $request, $role, $id)
    {
        $user = User::find($id);
        $user->update([
            'role' => $request->changerole,
        ]);
        return response()->json("Data update Successfully");
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json("User delete Successfully");
    }
}
