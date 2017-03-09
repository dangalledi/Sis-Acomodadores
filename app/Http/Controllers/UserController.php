<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() {
        $users = DB::select('select * from users order by rut');
        return view('users.index')
            ->with('users', $users);
    }

    public function cambioRol(Request $request, $id) {
        $user = DB::selectOne('select * from users where id = ' . $id);
        $rol = $request->rol;
        if ($user) {
            DB::update('update users set rol = ' . $rol . ' where id = ' . $id);
        }
        return redirect('/users');
    }
}
