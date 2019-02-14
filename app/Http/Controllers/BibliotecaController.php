<?php
/**
 * Created by PhpStorm.
 * User: josehuerta
 * Date: 02/01/19
 * Time: 11:08
 */

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Objects\CMSRepository;

class BibliotecaController extends Controller
{


    public function home(CMSRepository $cms) {
        $links = $cms->getPageLinks();
        return view('biblioteca.home', compact('links'));
    }

    public function page($slug = '/', CMSRepository $cms) {
        $page = $cms->getPage($slug);
        $links = $cms->getPageLinks();
        return View('biblioteca.page', compact('page', 'links'));
    }

    public function ViewLibros(CMSRepository $cms) {
        $links = $cms->getPageLinks();
        $libros = $this->QueryLibros();
        return view('biblioteca.libros', compact('links', 'libros'));
    }

    public function QueryLibros() {
        $busqueda = request()->get('busqueda');
        if(empty($busqueda)) {
          //  return null;
        }
        $query = Libro::where(function($query) use ($busqueda) {
            $query->where('nombre', 'like', '%'.$busqueda.'%')->orWhere('keywords', 'like', '%'.$busqueda.',%')->orWhere('autor', 'like', '%'.$busqueda.'%');
        });

        return $query->paginate('15');
    }


    public function ViewLibro($libroid, CMSRepository $cms) {
        $libro = Libro::find($libroid);
        $links = $cms->getPageLinks();
        return View('biblioteca.libro', compact('libro', 'links'));
    }

}