<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\VerifyPasswd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Bouncer;
use Silber\Bouncer\Database\Role;
use App\Http\Traits\Activity;

class UserController extends Controller
{
    use Activity;

    static public function GenerateSelect($array, $key = null) {
        $input = '';
        foreach($array as $local_key => $value) {
            $role = Role::find($local_key);
            if($role->name == 'superadmin' && !(auth()->user()->isSuperadmin()))
                continue;

            $input .= '<option value="'.$local_key.'"';
            if($local_key == $key) {
                $input .= 'selected';
            }
            $input .= '>'.$value.'</option>';
        }
        return $input;
    }

    public function index()
    {
        $select = [];
        $users = User::paginate(10);
        $paginate = $users->render();
        $roles = Role::all();

        foreach($roles as $role) {
            $array_roles[$role->id] = $role->title;
        }


        foreach($users as $user) {
            $select[$user->id] = self::GenerateSelect($array_roles, $user->roles()->first()->id);
        }

        return view('users.index', compact('users', 'select', 'paginate'));
    }

    public function create()
    {
        //Obtenemos la lista de roles
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function edit_perfil()
    {
        $user = auth()->user();

        return view('users.perfil', compact('user'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'comentarios' => '',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required'
        ]);

        if($data['role'] == 'superadmin' && ! auth()->user()->isSuperadmin())
            $this->redirect()->route('usuarios.view');

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'comentarios' => $data['comentarios'],
            'password' => bcrypt($data['password']),
        ]);

        $user->assign($data['role']);


        Session::flash('message', 'Usuario creado con éxito.');
        return ['status' => true, 'message' => 'Usuario creado con éxito', 'redirect' => route('usuarios.view')];
    }

    public function mod_perfil()
    {
        $user = auth()->user();

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
            'new_password' =>'confirmed',
            'password' => ['required', new VerifyPasswd]
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];

        if($data['new_password'] != '')
            $user->password = bcrypt($data['new_password']);

        $user->save();


        Session::flash('message', 'Perfil modificado exitosamente.');
        return ['status' => true, 'message' => 'Perfil modificado exitosamente.'];
    }

    public function update(User $user)
    {
        $cambioRolSA = false;

        $data = request()->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'comentarios' => '',
            'role' => 'required'
        ]);
        $role = Role::find($data['role']);

        if($user->roles()->first()->name == 'superadmin'){
            //if(!( auth()->user()->isSuperadmin()) || $user->roles()->first()->id != $data['role'])
            if(!( auth()->user()->isSuperadmin()))
                throw new AuthorizationException;

            if($user->roles()->first()->name != $role->name){
                $cambioRolSA = true;

                if($user->id == auth()->user()->id)
                    throw new AuthorizationException;
            }


        }

        if($role->name == 'superadmin' && ! auth()->user()->isSuperadmin())
            throw new AuthorizationException;

        if(($user->roles()->first()->name != $role->name) && $role->name == 'superadmin')
            $cambioRolSA = true;

        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->comentarios = $data['comentarios'];
        $user->save();

        Bouncer::sync($user)->roles([]);

        $user->assign($role->name);


        return response()->json(['success'=>true, 'role' => $role->title, 'cambioRol' => $cambioRolSA]);
    }

    public function delete(User $user)
    {
        if($user->roles()->first()->name == 'superadmin'){
            Session::flash('message', 'No es posible eliminar el usuario de rol superadmin');
            return redirect()->route('usuarios.view');
        }

        if($user->id == auth()->user()->id){
            Session::flash('message', 'No es posible eliminar tu propio usuario');
            return redirect()->route('usuarios.view');
        }

        if($user->delete()){
            Session::flash('message', 'Usuario eliminado con éxito.');

        }

        return redirect()->route('usuarios.view');
    }
}
