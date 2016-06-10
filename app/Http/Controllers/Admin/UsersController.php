<?php

namespace App\Http\Controllers\Admin;

use App\errors as Error;
use App\Grades as Grade;
use App\Http\Requests;
use App\User as User;
use App\User_attribute as Attributes;
use Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission as Permission;
use Spatie\Permission\Models\Role as Roles;
use Validation;
use Webpatser\Uuid\Uuid as UUID;

class UsersController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show users home
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function mainUsers() {
        $user = Auth::user();
        $usersList = User::all();

        $roles = Roles::where('name','!=','admin')->get();
        $permissions = Permission::all();

        return view('admin.users.main', ['users'=>$usersList, 'roles'=>$roles]);
    }

    public function addUser() {
        $roles = Roles::where('name','!=','admin')->get();
        $grades = Grade::all();
        return view('admin.users.add',['roles'=>$roles, 'grades'=>$grades]);
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
                    'bk' => $data['bk'],
                    'name' => $data['Nombre'],
                    'lastname' => $data['Apellido'],
                    'telephone' => $data['Telefono'],
                    'email' => $data['Email'],
                    'address' => $data['address'],
                    'age' => $data['Edad'],
                    'uuid' => UUID::generate(4),
                    'password' => bcrypt($data['Contraseña']),
                    'firstaccess' => 1,
                ]);

                $saved_user->assignRole($data['role']);

                $attribute = new Attributes(array(
                    'incharge' => $data['encargado'],
                    'incharge_info' => $data['infoEncargado']
                ));
                $saved_user->attribute()->save($attribute);

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
        $roles = Roles::where('name','!=','admin')->get();
        $grades = Grade::all();
        return view('admin.users.add', ['status' => $status, 'roles'=>$roles, 'grades'=>$grades]);
    }


    /**
     * Delete User From Database
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function removeUser($uuid) {
        $requested_user = Auth::user();
        try{
            $user = User::where('uuid','=',$uuid)->delete();
        }Catch(\Exception $e){
            Error::create([
                'user_id' => $requested_user->id,
                'error' => 'Failed to remove user',
                'description' => $e,
                'type' => 2,
            ]);
        }

        return redirect()->action('Admin\UsersController@mainUsers');
    }

    /**
     * @param $uuid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function editUser($uuid) {
        $requested_user = Auth::user();
        if(User::where('uuid','=',$uuid)->exists()) {
            $updating_user = User::where('uuid','=',$uuid)->get()->first();
            return View('admin.users.update', ['update_user'=>$updating_user]);
        } else {
            Error::create([
                'user_id' => $requested_user->id,
                'error' => 'Failed to edit user, user not found.',
                'description' => 'User not found',
                'type' => 2,
            ]);
            return redirect()->action('Admin\UsersController@mainUsers');
        }
    }


    /**
     * @param Request $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function updateUser(Request $data) {
        $user = Auth::user();
        $message = [
            'required' => 'El campo :attribute es requerido.',
            'confirmed' => 'Las contraseñas no coinciden.',
            'min' => 'El campo :attribute debe de cumplir con el número de caracteres.'
        ];
        $this->validate($data, [
            'Nombre' => 'required',
            'Apellido' => 'required'
        ], $message);
        try {
            $uuid = $data['auth'];
            $to_edit = User::where('uuid','=',$uuid)->get()->first();
            $to_edit->bk = $data['bk'];
            $to_edit->name = $data['Nombre'];
            $to_edit->lastname = $data['Apellido'];
            $to_edit->email = $data['Email'];
            $to_edit->telephone = $data['Telefono'];
            $to_edit->address = $data['address'];
            $to_edit->age = $data['Edad'];

            $to_edit->save();

            $to_edit_attributes = Attributes::where('user_id','=',$to_edit->id)->get()->first();
            $to_edit_attributes->incharge = $data['encargado'];
            $to_edit_attributes->incharge_info = $data['infoEncargado'];
            $to_edit_attributes->save();

            $to_edit->roles()->detach();

            $to_edit->assignRole($data['role']);

            $status = (object) array(
                'created' => 'success',
                'message' => 'Usuario actualizado satisfactoriamente.'
            );

            return View('admin.users.update', ['update_user'=>$to_edit, 'status'=>$status]);
        } catch(\Exception $e) {
            $to_edit = User::where('uuid','=',$uuid)->get()->first();
            Error::create([
                'user_id' => $user->id,
                'error' => 'Failed to update user',
                'description' => $e,
                'type' => 2,
            ]);
            $status = (object) array(
                'created' => 'error',
                'message' => 'Error al editar usuario intente de nuevo.',
            );
        }
        return View('admin.users.update', ['update_user'=>$to_edit, 'status'=>$status]);
    }

    public function userGrade($uuid) {
        $user = User::where('uuid','=',$uuid)->get()->first();
        $grades = Grades::all();
        return view('admin.users.user-grades',['user']);
    }

}
