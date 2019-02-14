<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Bouncer;
use Illuminate\Support\Facades\Session;
use Silber\Bouncer\Database\Role;
use App\Http\Traits\Activity;

class RolController extends Controller
{
    use Activity;

    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        //Obtenemos la lista de modelos y funciones en el directorio config/constants.php
        $modelos = Config('constants.models');
        $funciones = Config('constants.functions');

        $modelPermisos = array(); //Aquí guardaremos los permisos por modelo.

        foreach ($modelos as $modelo)
        {
            //Obtenemos los permisos que se crearán para cada Modelo.
            $perm = $modelo::$permisos;
            asort($perm); //Ordenamos alfabéticamente

            //Nombre de modelo. Quitamos el texto App\Models\
            $modelName = substr($modelo, 11);

            $arrAux = [
                'model' => $modelName,
                'permisos' => $perm,
            ];

            array_push($modelPermisos, $arrAux);
        }

        return view('roles.create', compact('modelPermisos', 'funciones'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|unique:bouncer_roles,name|alpha_num',
            'title' => 'required',
            'description' => '',
            'permisos' => '',
            'funciones' => '',
        ]);

        $role = Bouncer::role()->create([
            'name' => $data['name'],
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        $this->activity('Se creó elemento con Id: ' . $role->id, 'Silber\Bouncer\Database\Role', $role->id, null, 'POST');

        if(isset($data['permisos'])) {
            foreach ($data['permisos'] as $permiso) {
                $separador = explode('/', $permiso);
                $modelo = 'App\\Models\\' . $separador[0];
                Bouncer::allow($data['name'])->to([$separador[1]], $modelo);
            }
        }

        if(isset($data['funciones'])) {
            foreach ($data['funciones'] as $funcion) {
                Bouncer::allow($data['name'])->to($funcion);
            }
        }

        Session::flash('message', 'Rol creado con éxito.');
        return ['status' => true, 'message' => 'Rol creado con éxito', 'redirect' => route('roles.view')];
    }

    public function update(Role $role)
    {
        $data = request()->validate([
            'id_rol' => '',
            'name' => 'required|alpha_num|unique:bouncer_roles,name,'.$role->id,
            'title' => 'required',
            'description' => '',
            'permisos' => '',
            'funciones' => '',
        ]);

        $data_save = serialize($role->attributesToArray());

        if($role->name == 'superadmin' && ! auth()->user()->isSuperadmin())
            throw new AuthorizationException;

        if($role->name != $data['name']){
            $users = User::whereIs($role->name)->get();

            if(count($users) > 0) {
                Session::flash('message', 'No es posible cambiar nombre del rol, debido a que está asignado a 1 o más usuarios.');
                return ['status' => true, 'message' => 'No es posible cambiar nombre del rol, debido a que está asignado a 1 o más usuarios.', 'redirect' => route('roles.view')];
            }
        }

        $role->name = $data['name'];
        $role->title = $data['title'];
        $role->description = $data['description'];
        $role->save();

        $this->activity('Se modificó el elemento', 'Silber\Bouncer\Database\Role', $role->id, $data_save, 'PUT');

        $rolAbilities = $role->getAbilities();

        if(! ($role->name == 'superadmin')){
            foreach ($rolAbilities as $ability){
                /*if($$ability->entity_type == null)
                    Bouncer::disallow($data['name'])->to($ability->name);
                else*/
                    Bouncer::disallow($data['name'])->to($ability->name, $ability->entity_type);
            }

            if(isset($data['permisos'])){
                foreach ($data['permisos'] as $permiso){
                    $separador = explode('/', $permiso);

                    $modelo = 'App\\Models\\'.$separador[0];

                    Bouncer::allow($data['name'])->to([$separador[1]], $modelo);
                }
            }

            if(isset($data['funciones'])){
                foreach ($data['funciones'] as $funcion){
                    Bouncer::allow($data['name'])->to($funcion);
                }
            }
        }

        Session::flash('message', 'Rol actualizado con éxito.');
        return ['status' => true, 'message' => 'Rol actualizado con éxito', 'redirect' => route('roles.view')];
    }

    public function edit($idRol)
    {
        /* PERMISOS = HABILIDADES
        *  PERMISSIONS = ABILITIES
        */

        //Obtenemos el modelo Rol.
        $rolModel = Role::find($idRol);

        if($rolModel->name == 'superadmin' && ! auth()->user()->isSuperadmin())
            throw new AuthorizationException;

        //Obtenemos las habilidades pertenecientes al rol.
        $abilities = $rolModel->getAbilities();

        //Obtenemos la lista de modelos en el directorio config/constants.php
        $modelos = Config('constants.models');
        $funciones = Config('constants.functions');

        $modelPermisos = array(); //Aquí guardaremos los permisos por modelo.

        foreach ($modelos as $modelo)
        {
            //Obtenemos los permisos que se crearán para cada Modelo.
            $perm = $modelo::$permisos;
            asort($perm); //Ordenamos alfabéticamente

            //Nombre de modelo. Quitamos el texto App\Models\
            $modelName = substr($modelo, 11);

            $autorizados = array(); //Aquí guardaremos los permisos que ya tiene guardados el rol.
            $func_autorizadas = array();

            //Recorremos los permisos que ya tiene el rol para marcarlos "checked" en el formulario.
            foreach ($abilities as $ability)
            {
                if($ability->entity_type === $modelo){
                    foreach ($perm as $p)
                    {
                        if($p === $ability->name) {
                            array_push($autorizados, $p);
                            break;
                        }
                    }
                }
            }

            $arrAux = [
                'model' => $modelName,
                'permisos' => $perm,
                'autorizados' => $autorizados
            ];

            array_push($modelPermisos, $arrAux);
        }

        return view('roles.edit', compact('rolModel', 'modelPermisos', 'abilities', 'funciones'));
    }

    function delete(Role $role)
    {
        if($role->name == 'superadmin'){
            Session::flash('message', 'No es posible eliminar el rol superadmin');
            return redirect()->route('roles.view');
        }

        if($role->id == auth()->user()->roles()->first()->id){
            Session::flash('message', 'No es posible eliminar tu propio rol');
            return redirect()->route('roles.view');
        }

        $users = User::whereIs($role->name)->get();

        if(count($users) > 0){
            Session::flash('message', 'No es posible eliminar el rol, debido a que está asignado a 1 o más usuarios.');
        }else{
            $data_save = serialize($role->attributesToArray());
            if($role->delete()){
                Session::flash('message', 'Rol eliminado con éxito.');
                $this->activity('Se eliminó el elemento', 'Silber\Bouncer\Database\Role', $role->id, $data_save, 'DELETE');
            }
        }


        return redirect()->route('roles.view');
    }
}
