<?php

namespace App\Http\Controllers\Admin;

use App\errors as Error;
use App\Grades as Grade;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use Validation;
use Webpatser\Uuid\Uuid as UUID;

class GradesController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */

    public function index() {
        $grades = Grade::all();

        return view('admin.grades.main', ['grades'=>$grades]);
    }

    public function addGrade() {
        return view('admin.grades.add');
    }

    public function create(Request $data) {
        $user = Auth::user();
        $message = [
            'required' => 'El campo :attribute es requerido.',
            'confirmed' => 'Las contraseñas no coinciden.',
            'min' => 'El campo :attribute debe de cumplir con el número de caracteres.'
        ];
        $this->validate($data, [
            'Grado' => 'required'
        ], $message);

        try{
            if(!Grade::where('name','=',$data['Grado'])->exists()){
                Grade::create([
                    'name' => $data['Grado'],
                    'uuid' => UUID::generate(4)
                ]);
                $status = (object) array(
                    'created' => 'success',
                    'message' => 'Grado creado satisfactoriamente..',
                );
            } else {
                $status = (object) array(
                    'created' => 'error',
                    'message' => 'Error creando grado, grado ya existe.',
                );
            }
        } catch (\Exception $e) {
            Error::create([
                'user_id' => $user->id,
                'error' => 'Failed to create grade',
                'description' => $e,
                'type' => 2,
            ]);
            $status = (object) array(
                'created' => 'error',
                'message' => 'Error creando grado intente de nuevo.',
            );
        }

        return view('admin.grades.add',['status'=>$status]);

    }


    public function remove($uuid) {
        $requested_user = Auth::user();
        try{
            $grade = Grade::where('uuid','=',$uuid)->delete();
        }Catch(\Exception $e){
            Error::create([
                'user_id' => $requested_user->id,
                'error' => 'Failed to remove grade',
                'description' => $e,
                'type' => 2,
            ]);
        }

        $grades = Grade::all();
        return redirect()->action('Admin\GradesController@index', ['grades'=>$grades]);
    }

    public function edit($uuid) {
        $requested_user = Auth::user();
        if(Grade::where('uuid','=',$uuid)->exists()) {
            $updating_grade = Grade::where('uuid','=',$uuid)->get()->first();
            return View('admin.grades.update', ['grade' => $updating_grade]);
        } else {
            Error::create([
                'user_id' => $requested_user->id,
                'error' => 'Failed to edit grade, grade not found.',
                'description' => 'Grade not found',
                'type' => 2,
            ]);
            return View('admin.grades.main');
        }
    }

    public function update(Request $data) {
        $user = Auth::user();
        $message = [
            'required' => 'El campo :attribute es requerido.',
            'confirmed' => 'Las contraseñas no coinciden.',
            'min' => 'El campo :attribute debe de cumplir con el número de caracteres.'
        ];
        $this->validate($data, [
            'Grado' => 'required',
        ], $message);

        try {
            if(!Grade::where('uuid','=',$data['auth'])->exists()){
                $status = (object) array(
                    'created' => 'error',
                    'message' => 'Error grado no existe.',
                );
            }else{
                $to_edit = Grade::where('uuid','=',$data['auth'])->get()->first();
                $to_edit->name = $data['Grado'];

                $to_edit->save();

                $status = (object) array(
                    'created' => 'success',
                    'message' => 'Grado actualizado satisfactoriamente.',
                );

                return view('admin.grades.update', ['status' => $status, 'grade'=>$to_edit]);
            }
        } catch(\Exception $e) {
            Error::create([
                'user_id' => $user->id,
                'error' => 'Failed to update grade',
                'description' => $e,
                'type' => 2,
            ]);
            $status = (object) array(
                'created' => 'error',
                'message' => 'Error al editar grado intente de nuevo.',
            );
        }

        return view('admin.grades.main', ['status' => $status]);
    }

}
