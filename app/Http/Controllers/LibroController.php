<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Objects\Fpdi;

class LibroController extends Controller
{
    public function index()
    {
        $filter = request()->validate([
            'filtro' => ''
        ]);

        if(isset($filter['filtro'])){
            $libros = Libro::orderBy('id', 'asc')
                ->where('nombre', 'LIKE', '%'.$filter['filtro'].'%')
                /*->orWhere('descripcion', 'LIKE', '%'.$filter['filtro'].'%')
                ->orWhere('keywords', 'LIKE', '%'.$filter['filtro'].'%')
                ->orWhere('autor', 'LIKE', '%'.$filter['filtro'].'%')*/
                ->paginate(25)
                ->appends(request()->query());
        }else{
            $libros = Libro::paginate(25);
        }


        $paginate = $libros->render();

        return view('libros.index', compact('libros', 'paginate'));
    }

    public function create()
    {
        return view('libros.create');
    }

    public function show(Libro $libro)
    {
        //$libro = Libro::find($idLibro);

        $path = 'uploads/libros/' . $libro->id;

        $items = '';
        if(file_exists($path)){
            foreach (scandir($path) as $item){
                if ($item == '.' || $item == '..') {
                    continue;
                }
                else{
                    if(substr($item, -4) == '.pdf'){
                        $items .= '<li onclick="descargarPdf(\'/'.$path.'/'.$item.'\')">' . $item . '</li>';
                    }else{
                        $items .= '<li>' . $item;
                        $items .= '<ul>';
                        foreach (scandir($path . '/' . $item) as $value){
                            if ($value == '.' || $value == '..') {
                                continue;
                            }
                            else{
                                $items .= '<li onclick="descargarPdf(\'/'.$path.'/'.$item.'/'.$value.'\')">' . $value . '</li>';
                            }
                        }
                        $items .= '</ul></li>';
                    }
                }

            }
        }

        return view('libros.show', compact('libro', 'items'));
    }

    public function edit(Libro $libro)
    {
        //$libro = Libro::find($idLibro);

        return view('libros.edit', compact('libro'));
    }

    public function store()
    {
        $data = request()->validate([
            'nombre' => 'required|unique:libros,nombre',
            'descripcion' => 'required',
            'keywords' => 'required',
            'autor' => 'required',
            'num_edicion' => '',
            'lugar_edicion' => '',
            'coleccion' => '',
            'editorial' => '',
            'num_libro' => '',
            'year' => '',
            'tema' => ''
        ]);

        $ubicacion = 'uploads/libros/';

        $libro = Libro::create([
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'ubicacion' => $ubicacion,
            'keywords' => $data['keywords'],
            'autor' => $data['autor'],
            'num_edicion' => $data['num_edicion'],
            'lugar_edicion' => $data['lugar_edicion'],
            'coleccion' => $data['coleccion'],
            'editorial' => $data['editorial'],
            'num_libro' => $data['num_libro'],
            'year' => $data['year'],
            'tema' => $data['tema'],
        ]);

        $ubicacion = $ubicacion . $libro->id . '/';

        $libro->ubicacion = $ubicacion;
        $libro->save();

        //Session::flash('message', 'Libro creado con éxito.');
        return ['status' => 'ok', 'message' => 'Libro creado con éxito', 'id' => $libro->id];
    }

    public function update(Libro $libro)
    {
        $data = request()->validate([
            'nombre' => 'required|unique:libros,nombre,'. $libro->id,
            'descripcion' => 'required',
            'keywords' => 'required',
            'autor' => 'required',
            'num_edicion' => '',
            'lugar_edicion' => '',
            'coleccion' => '',
            'editorial' => '',
            'num_libro' => '',
            'year' => '',
            'tema' => ''
        ]);

        $ubicacion = 'uploads/libros/' . $libro->id . '/';

        $libro->nombre = $data['nombre'];
        $libro->descripcion = $data['descripcion'];
        $libro->keywords = $data['keywords'];
        $libro->autor = $data['autor'];
        $libro->num_edicion = $data['num_edicion'];
        $libro->lugar_edicion = $data['lugar_edicion'];
        $libro->coleccion = $data['coleccion'];
        $libro->editorial = $data['editorial'];
        $libro->num_libro = $data['num_libro'];
        $libro->year = $data['year'];
        $libro->tema = $data['tema'];
        $libro->ubicacion = $ubicacion;

        $libro->save();

        //Session::flash('message', 'Libro creado con éxito.');
        return ['status' => 'ok', 'message' => 'Libro actualizado con éxito'];
    }

    public function subir_archivos()
    {
        $data = request()->validate([
            'id' => 'required',
            'file' => 'required',
            'dividir' => '',
        ]);

        $path = 'uploads/libros/' . $data['id'] . '/';

        if(!file_exists($path))
            mkdir($path);

        $rand = '-'.date('Ymd') . rand(100, 999);
        $explode = explode('.', $_FILES['file']['name']);
        $format = end($explode);
        $nombre_archivo = str_replace('.'.$format, '', basename($_FILES['file']['name']));
        $nombre_archivo = $nombre_archivo.$rand.'.'.$format;
        $archivo = $path . $nombre_archivo;

        $status = false;
        $message = '';
        if(move_uploaded_file($_FILES['file']['tmp_name'], $archivo)){
            $status = true;
            $message = 'Archivo subido con éxito';
        }else{
            $message = 'Hubo un problema al subir el archivo';
            $archivo = '';
        }

        if($data['dividir'] != '' && $data['dividir'] > 0){
            $num_paginas = $data['dividir'];

            $carpeta = str_replace('.pdf', '', $archivo);

            $pdf = new FPDI();
            $pagecount = $pdf->setSourceFile($archivo); // How many pages?

            $parte = 0;

            if(! (($num_paginas == $pagecount) || ($num_paginas > $pagecount))){
                mkdir($carpeta, 0700);

                // Dividir PDF en partes, de acuerdo al valor asignado en el formulario.
                for ($i = 0; $i <= $pagecount; $i++) {
                    $parte++;
                    $new_pdf = new FPDI();
                    $new_pdf->setSourceFile($archivo);
                    $flag = false;
                    for ($j = 0; $j < $num_paginas; $j++){
                        if($i >= $pagecount || $j >= $pagecount){
                            $flag = true;
                            break;
                        }

                        $new_pdf->AddPage();
                        $new_pdf->useTemplate($new_pdf->importPage($i + 1), null, null, null, null, true);
                        $i++;
                    }
                    if(! $flag)
                        $i--;

                    try {
                        $new_filename = str_replace('.pdf', '', $archivo);
                        $new_filename .= '/' . $nombre_archivo . '_parte' . $parte;
                        $new_filename = str_replace('.pdf', '', $new_filename);
                        $new_filename .= '.pdf';
                        $new_pdf->Output($new_filename, "F");

                    } catch (Exception $e) {
                        echo 'Caught exception: ', $e->getMessage(), "\n";
                    }
                }
            }
        }
        return response()->json(['success'=>$status, 'message' => $message, 'archivo' => $nombre_archivo, 'dividir' => $data['dividir'], 'path' => $path, 'id' => $data['id']]);
    }

    public function delete_archivo()
    {
        $data = request()->validate([
            'path' => 'required',
            'archivo' => 'required'
        ]);

        $path = $data['path'];
        $archivo = $data['archivo'];
        $archivo_abs = $path . $archivo;
        $carpeta = str_replace('.pdf', '', $archivo_abs) . '/';

        if(file_exists($path)){
            if(file_exists($archivo_abs)){
                if(unlink($archivo_abs)){
                    if(file_exists($carpeta)){
                        foreach (scandir($carpeta) as $item){
                            if ($item == '.' || $item == '..') {
                                continue;
                            }
                            else
                                unlink($carpeta . $item);
                        }
                        rmdir($carpeta);
                    }
                }

            }
        }

        return response()->json(['success'=>true]);
    }

    public function getArchivos($libro)
    {
        $path = 'uploads/libros/' . $libro;

        $result = array();
        if(file_exists($path)){
            foreach (scandir($path) as $item){
                if ($item == '.' || $item == '..') {
                    continue;
                }
                else{
                    if(substr($item, -4) == '.pdf'){
                        $obj['name'] = $item;
                        $obj['size'] = filesize($path . '/' . $item);
                        $result[] = $obj;
                    }
                }
            }
        }
        return $result;
    }

    public function delete(Libro $libro)
    {
        if($libro->delete())
            Session::flash('message', 'Libro eliminado con éxito.');

        return redirect()->route('libros.view');
    }
}
