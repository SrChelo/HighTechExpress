<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(count(Role::all()) == 0){
            $roles = ["Cliente","Administrador","Repartidor"];
            for($i = 0;$i < 3;$i++){
                $role = new Role();
                $role->name = $roles[$i];
                $role->save();
            }
        }
        if(count(User::all()) == 0){
            $admin = new User();
            $admin->name = "Admin";
            $admin->email = "admin@admin.com";
            $admin->password = bcrypt("admin");
            $admin->save();
            $admin->save();
            $admin->asignarRol(Role::findOrFail(2));
        }
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
