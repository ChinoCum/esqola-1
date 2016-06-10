<?php

namespace App\Http\Controllers;

use App\errors as Error;
use App\Http\Requests;
use App\User as User;
use Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission as Permission;
use Spatie\Permission\Models\Role as Roles;
use Validation;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show dashboard home
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard() {

        $user = Auth::user();

        return view('admin.home', ['user' => $user]);
    }

    /**
     * Show users home
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mainUsers() {

        $user = Auth::user();
        $usersList = User::all();

        $roles = Roles::all();
        $permissions = Permission::all();

        return view('admin.users.main', ['user'=>$user, 'users'=>$usersList, 'roles'=>$roles]);
    }

    public function addUser() {
        $user = Auth::user();
        return view('admin.users.add', ['user' => $user]);
    }

    /**
     * User Validation and Creation
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createUser(Request $data) {
        $user = Auth::user();
        $message = [
            'required' => 'El campo :attribute es requerido.',
            'confirmed' => 'Las contraseñas no coinciden.',
            'min' => 'El campo :attribute debe de cumplir con el número de caracteres.'
        ];
        $this->validate($data, [
            'Nombre' => 'required',
            'Apellido' => 'required',
            'Email' => 'required',
            'Contraseña' => 'required|min:6|confirmed',
        ], $message);

        try {
            if(User::where('email','=',$data['Email'])->exists()){
                $status = (object) array(
                    'created' => 'error',
                    'message' => 'Ya hay un usuario registrado con ese email.',
                );
            }else{
                $saved_user = User::create([
                    'name' => $data['Nombre'],
                    'lastname' => $data['Apellido'],
                    'telephone' => $data['Telefono'],
                    'email' => $data['Email'],
                    'address' => $data['address'],
                    'age' => $data['Edad'],
                    'password' => bcrypt($data['Contraseña']),
                    'firstaccess' => 1
                ]);

                $saved_user->assignRole($data['role']);

                $status = (object) array(
                    'created' => 'success',
                    'message' => 'Usuario creado satisfactoriamente.',
                );
            }
        } catch(\Exception $e) {
            Error::create([
                'user_id' => $user->id,
                'error' => 'Failed to create user',
                'description' => $e,
                'type' => 2,
            ]);
            $status = (object) array(
                'created' => 'error',
                'message' => 'Error creando usuario intente de nuevo.',
            );
        }

        return view('admin.users.add', ['user' => $user, 'status' => $status]);
    }

    /**
     * Delete User From Database
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function removeUser($email) {
        try{
            $user = User::where('email','=',$email)->delete();
        }Catch(\Exception $e){
            Error::create([
                'user_id' => $user->id,
                'error' => 'Failed to create user',
                'description' => $e,
                'type' => 2,
            ]);
        }

        return redirect()->action('adminController@mainUsers');
    }

}
