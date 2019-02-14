<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PageController extends Controller {

    public function index() {
        $pages = Page::orderBy('created_at', 'DESC')->get();
        return view('cms.pages.index', compact('pages'));
    }

    public function create() {
        return view('cms.pages.create');
    }

    protected function processRuta($ruta) {
        if($ruta == '/') {
           return $ruta;
        }
        return str_slug($ruta);
    }

    public function store(Request $r) {
        $this->validate($r, [
            'titulo' => ['required', 'string', 'min:2', 'max:255'],
            'ruta' => ['required', 'string', 'min:1', 'max:255', 'unique:pages,slug'],
            'contenido' => ['required', 'string'],
            'status' => ['required', 'integer'],
        ]);


        Page::create([
            'titulo' => $r->get('titulo'),
            'slug' => $this->processRuta($r->get('ruta')),
            'contenido' => $r->get('contenido'),
            'status' => $r->get('status')
        ]);

        return ['status' => true, 'redirect' => route('cms.page.index')];
    }

    public function edit(Page $page) {
        return view('cms.pages.edit', compact('page'));
    }

    public function update(Page $page) {
        $data = request()->validate([
            'titulo' => 'required|string|min:2|max:255',
            'ruta' => 'required|string|min:1|max:255|unique:pages,slug,'.$page->id,
            'contenido' => 'required|string',
            'status' => 'required|integer'
        ]);

        $page->titulo = $data['titulo'];
        $page->slug = $this->processRuta($data['ruta']);
        $page->contenido = $data['contenido'];
        $page->status = $data['status'];
        $page->save();

        return ['status' => true, 'message' => 'Actualizado correctamente.'];
    }

    public function delete(Page $page)
    {
        if($page->delete()){
            Session::flash('message', 'Página eliminada con éxito.');
        }

        return redirect()->route('cms.page.index');
    }

}