<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Objects\Select;
use App\Rules\VerifyPasswd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Bouncer;
use Silber\Bouncer\Database\Role;
use App\Http\Traits\Activity;

class UserController extends Controller
{
    use Activity;

    /**
     * Muestra la lista de Usuarios.
     */
    public function index()
    {
        $select = [];
        $users = User::paginate();
        $paginate = $users->render();
        $roles = Role::all();

        foreach($roles as $role) {
            $array_roles[$role->id] = $role->title;
        }

        $roles = Select::create($array_roles);
        return view('users.index', compact('users', 'roles', 'paginate'));
    }

    /**
     * Abre formulario para crear nuevo usuario.
     */
    public function create()
    {
        $user = new User;
        $roles = Role::all();
        return view('users.create', compact('user', 'roles'));
    }

    /**
     * Guarda el usuario nuevo.
     */
    public function store()
    {
        request()->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required'
        ]);

        if(request('role') == 'superadmin'){
            currentUser()->abortIfNotSuperadmin();
        }

        $user = User::create([
            'name' => request('name'),
            'username' => request('username'),
            'email' => request('email'),
            'comentarios' => request('comentarios'),
            'password' => bcrypt(request('password')),
        ]);

        $user->assign(request('role'));

        return ['status' => true, 'message' => 'Usuario creado con éxito', 'redirect' => route('users.view')];
    }

    /**
     * Abre formulario para editar perfil del usuario actual.
     */
    public function edit_perfil()
    {
        $user = currentUser();
        return view('users.perfil', compact('user'));
    }

    /**
     * Guarda los cambios en el perfil del usuario actual.
     */
    public function mod_perfil()
    {
        $user = currentUser();

        request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
            'new_password' =>'confirmed',
            'password' => ['required', new VerifyPasswd]
        ]);

        $user->name = request('name');
        $user->email = request('email');

        if(request('new_password'))
            $user->password = bcrypt(request('new_password'));

        $user->save();
        return ['status' => true, 'message' => 'Perfil modificado exitosamente.'];
    }

    /**
     * Cambia status (activo o inactivo [1 o 0].
     */
    public function change_status(User $user)
    {
        $user->abortIfSuperadmin();
        $user->active = !$user->active;
        $user->save();
        return ['success' => true, 'active' => $user->active];
    }

    /**
     * Cambio de contraseña del usuario.
     */
    public function change_password(User $user)
    {
        $user->abortIfSuperadmin();
        request()->validate(['password' => 'string|min:6|confirmed']);

        /*if(strlen(request('password')) < 6)
            return ['success' => false, 'message' => 'La contraseña debe ser mayor a 6 caracteres.'];*/

        $user->password = bcrypt(request('password'));
        $user->save();
        return ['status' => true, 'message' => 'Contraseña cambiada con éxito.'];
    }

    /**
     * Guarda la información actualizada del usuario.
     */
    public function update(User $user)
    {
        $cambioRolSA = false;

        request()->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required'
        ]);
        $role = Role::find(request('role'));

        if($role->name == 'superadmin'){
            currentUser()->abortIfNotSuperadmin();
        }

        if($user->isSuperadmin()){
            currentUser()->abortIfNotSuperadmin();

            if($user->getRoleName() != $role->name){
                $this->abortIfSameUser($user);
                $cambioRolSA = true;
            }
        }

        if(($user->getRoleName() != $role->name) && $role->name == 'superadmin')
            $cambioRolSA = true;

        $user->name = request('name');
        $user->username = request('username');
        $user->email = request('email');
        $user->comentarios = request('comments');
        $user->save();
        Bouncer::sync($user)->roles([]);
        $user->assign($role->name);

        return ['status'=>true, 'role' => $role->title, 'cambioRol' => $cambioRolSA, 'message' => 'Usuario actualizado con éxito.'];
    }

    /**
     * Elimina el usuario.
     */
    public function delete(User $user)
    {
        $user->abortIfSuperadmin();
        $this->abortIfSameUser($user);

        $user->delete();

        return ['success'=>true, 'message'=>'Usuario eliminado con éxito.'];
    }

    // ============== HELPERS =============
    /**
     * Genera select html con las opciones dadas.
     */
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

    /**
     * Manda error si se está eliminando el mismo usuario que está conectado.
     */
    protected function abortIfSameUser($user)
    {
        if($user->id == auth()->user()->id)
            abort(403);
    }
}
