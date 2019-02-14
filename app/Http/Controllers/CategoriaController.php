<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriaController extends Controller
{
    static public function GenerateSelect($array, $key = null) {
        $input = '';
        foreach($array as $local_key => $value) {
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
        $categorias = Categoria::paginate(10);
        $paginate = $categorias->render();
        $users = User::all();

        foreach($users as $user) {
            $array_users[$user->id] = $user->name;
        }


        foreach($categorias as $categoria) {
            $select[$categoria->id] = self::GenerateSelect($array_users, $categoria->user_id);
        }

        return view('categorias.index', compact('categorias', 'select', 'paginate'));
    }

    public function create()
    {
        //Obtenemos la lista de roles
        $users = User::all();

        return view('categorias.create', compact('users'));
    }

    public function store()
    {
        $data = request()->validate([
            'descripcion' => 'required',
            'user_id' => 'required',
            'status' => 'required'
        ]);

        $categoria = Categoria::create([
            'descripcion' => $data['descripcion'],
            'user_id' => $data['user_id'],
            'status' => $data['status'],
        ]);

        Session::flash('message', 'Categoría creada con éxito.');
        return ['status' => true, 'message' => 'Categoría creada con éxito', 'redirect' => route('categorias.view')];
    }

    public function update(Categoria $categoria)
    {
        $data = request()->validate([
            'descripcion' => 'required',
            'user_id' => 'required',
            'status' => 'required'
        ]);

        $user = User::find($data['user_id']);

        $categoria->descripcion = $data['descripcion'];
        $categoria->user_id = $data['user_id'];
        $categoria->status = $data['status'];
        $categoria->save();

        return response()->json(['success'=>true, 'user' => $user->name]);
    }

    public function delete(Categoria $categoria)
    {
        if($categoria->delete())
            Session::flash('message', 'Categoría eliminada con éxito.');

        return redirect()->route('categorias.view');
    }
}
