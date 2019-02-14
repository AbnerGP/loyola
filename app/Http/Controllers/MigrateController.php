<?php
/**
 * Created by PhpStorm.
 * User: josehuerta
 * Date: 21/12/18
 * Time: 17:21
 */

namespace App\Http\Controllers;
use App\Models\Libro;
use Illuminate\Http\Request;

class MigrateController extends Controller
{
    public $r;

    public function __construct(Request $request)
    {
        $this->r = $request;
    }

/*
    
    public function context() {
        return [
            'cocina/caja1.csv' => 'phase1',
            'cocina/caja2.csv' => 'phase2',
            'cocina/caja3.csv' => 'phase2',
            'cocina/caja4.csv' => 'phase2',
            'cocina/caja5.csv' => 'phase2',
            'cocina/caja6.csv' => 'phase2',
            'cocina/caja7.csv' => 'phase2',
            'cocina/caja8.csv' => 'phase2',
            'cocina/caja9.csv' => 'phase2',
            'cocina/caja10.csv' => 'phase2',
            'cocina/caja11.csv' => 'phase2',
            'cocina/caja12.csv' => 'phase2',
            'cocina/caja13.csv' => 'phase2',
            'cocina/caja14.csv' => 'phase2',
            'cocina/caja15.csv' => 'phase2',
            'cocina/caja16.csv' => 'phase2',
            'cocina/caja17.csv' => 'phase2',
            'cocina/caja18.csv' => 'phase2',
            'cocina/caja19.csv' => 'phase2',
            'cocina/caja20.csv' => 'phase2',
            'cocina/caja21.csv' => 'phase2',
            'cocina/caja22.csv' => 'phase2',
            'cocina/caja23.csv' => 'phase2',
            'cocina/caja24.csv' => 'phase2',
            'cocina/caja25.csv' => 'phase2',
            'cocina/caja26.csv' => 'phase2',
            'cocina/caja27.csv' => 'phase2',
            'cocina/caja28.csv' => 'phase2',
            'cocina/caja29.csv' => 'phase2',
            'cocina/caja30.csv' => 'phase2',
            'cocina/caja31.csv' => 'phase2',
            'cocina/caja32.csv' => 'phase2',
            'cocina/caja33.csv' => 'phase2',
            'cocina/caja34.csv' => 'phase2',
            'cocina/caja35.csv' => 'phase2',
            'cocina/caja36.csv' => 'phase2',
            //'cocina/caja37.csv' => 'phase2',
            'cocina/caja38.csv' => 'phase2',
            'cocina/caja39.csv' => 'phase2',
            'cocina/caja40.csv' => 'phase2',
            'cocina/caja41.csv' => 'phase2',
            'cocina/caja42.csv' => 'phase2',
            'cocina/caja43.csv' => 'phase2',
            'cocina/caja44.csv' => 'phase2',
            'cocina/caja45.csv' => 'phase2',
            'cocina/caja46.csv' => 'phase2',
            'cocina/caja47.csv' => 'phase2',
            'cocina/caja48.csv' => 'phase2',
            'cocina/caja49.csv' => 'phase2',
            'cocina/caja50.csv' => 'phase2',
            'cocina/caja51.csv' => 'phase2',
            'cocina/caja52.csv' => 'phase2',
            'cocina/caja53.csv' => 'phase2',
            'cocina/caja54.csv' => 'phase2',
            'cocina/caja55.csv' => 'phase3',
            'cocina/caja56.csv' => 'phase3',
            'cocina/caja57.csv' => 'phase3',
            'cocina/caja58.csv' => 'phase3',
            'cocina/caja59.csv' => 'phase3',
            'cocina/caja60.csv' => 'phase3',
            'cocina/caja61.csv' => 'phase3',
            'cocina/caja62.csv' => 'phase3',
            'cocina/caja63.csv' => 'phase3',
            'cocina/caja64.csv' => 'phase3',
            'cocina/caja65.csv' => 'phase3',
            'cocina/caja66.csv' => 'phase3',
            'cocina/caja67.csv' => 'phase3',
            'cocina/caja68.csv' => 'phase3',
            'cocina/caja69.csv' => 'phase3',
            'cocina/caja70.csv' => 'phase3',
            'cocina/caja71.csv' => 'phase3',
            'cocina/caja72.csv' => 'phase3',
            'cocina/caja73.csv' => 'phase3',
            'cocina/caja74.csv' => 'phase3',
            'cocina/caja75.csv' => 'phase3',
            'cocina/caja76.csv' => 'phase3',
            'cocina/caja77.csv' => 'phase3',
            'cocina/caja78.csv' => 'phase3',
            'cocina/caja79.csv' => 'phase3',
            'cocina/caja81.csv' => 'phase4', // ---
            'cocina/caja82.csv' => 'phase3',
            'cocina/caja83.csv' => 'phase3',
            'cocina/caja84.csv' => 'phase3',
            'cocina/caja85.csv' => 'phase3',
            'cocina/caja86.csv' => 'phase3',
            'cocina/caja87.csv' => 'phase3',
            'cocina/caja88.csv' => 'phase3',
            'cocina/caja89.csv' => 'phase3',
            'cocina/caja90.csv' => 'phase3',
            'cocina/caja91.csv' => 'phase3',
            'cocina/caja92.csv' => 'phase3',
            'cocina/caja93.csv' => 'phase3',
            'cocina/caja94.csv' => 'phase3',
            'cocina/caja95.csv' => 'phase3',
            'cocina/caja96.csv' => 'phase3',
           // 'cocina/caja97.csv' => 'phase3',

            'historiamorelos/caja1.csv' => 'historia_dev1',
            'historiamorelos/caja2.csv' => 'phase2',
            'historiamorelos/caja3.csv' => 'phase2',
            'historiamorelos/caja4.csv' => 'phase2',
            'historiamorelos/caja5.csv' => 'phase2',
            'historiamorelos/caja6.csv' => 'phase2',
            'historiamorelos/caja7.csv' => 'phase2',
            'historiamorelos/caja8.csv' => 'phase2',
            'historiamorelos/caja9.csv' => 'phase2',
            'historiamorelos/caja10.csv' => 'phase2',
            'historiamorelos/caja11.csv' => 'phase2',
            'historiamorelos/caja12.csv' => 'phase2',
            'historiamorelos/caja13.csv' => 'phase2',
            'historiamorelos/caja14.csv' => 'phase2',
            'historiamorelos/caja15.csv' => 'phase2',
            'historiamorelos/caja16.csv' => 'phase2',
            'historiamorelos/caja17.csv' => 'phase2',
            'historiamorelos/caja18.csv' => 'phase2',
            'historiamorelos/caja19.csv' => 'phase2',
            'historiamorelos/caja20.csv' => 'phase2',
            'historiamorelos/caja21.csv' => 'phase2',
            'historiamorelos/caja22.csv' => 'phase2',
            'historiamorelos/caja23.csv' => 'phase2',
            'historiamorelos/caja24.csv' => 'phase2',
            'historiamorelos/caja25.csv' => 'phase2',
            'historiamorelos/caja26.csv' => 'phase2',
            'historiamorelos/caja27.csv' => 'phase2',
            'historiamorelos/caja28.csv' => 'phase2',
            'historiamorelos/caja29.csv' => 'phase2',
            'historiamorelos/caja30.csv' => 'phase2',
            'historiamorelos/caja31.csv' => 'phase2',
            'historiamorelos/caja32.csv' => 'phase2',
            'historiamorelos/caja33.csv' => 'phase2',
            'historiamorelos/caja34.csv' => 'phase2',
            'historiamorelos/caja35.csv' => 'phase2',
            'historiamorelos/caja36.csv' => 'phase2',
            'historiamorelos/caja37.csv' => 'phase2',
            'historiamorelos/caja38.csv' => 'phase2',
            'historiamorelos/caja39.csv' => 'phase2',
            'historiamorelos/caja40.csv' => 'phase2',
            'historiamorelos/caja41.csv' => 'phase2',
            'historiamorelos/caja42.csv' => 'phase2',
            'historiamorelos/caja43.csv' => 'phase2',
            'historiamorelos/caja44.csv' => 'phase2',
            'historiamorelos/caja45.csv' => 'phase2',
            'historiamorelos/caja46.csv' => 'phase2',
            'historiamorelos/caja47.csv' => 'phase2',
            'historiamorelos/caja48.csv' => 'phase3',
            'historiamorelos/caja49.csv' => 'phase3',
            'historiamorelos/caja50.csv' => 'phase3',
            'historiamorelos/caja51.csv' => 'phase3',
            'historiamorelos/caja52.csv' => 'phase3',
            'historiamorelos/caja53.csv' => 'phase3',
            'historiamorelos/caja54.csv' => 'phase3',
            'historiamorelos/caja55.csv' => 'phase3',
            'historiamorelos/caja56.csv' => 'phase3',
            'historiamorelos/caja57.csv' => 'phase3',
            'historiamorelos/caja58.csv' => 'phase3',
            'historiamorelos/caja59.csv' => 'phase3',
            'historiamorelos/caja60.csv' => 'phase3',
            'historiamorelos/caja61.csv' => 'phase3',
            'historiamorelos/caja62.csv' => 'phase3',
            'historiamorelos/caja63.csv' => 'phase3',
            'historiamorelos/caja64.csv' => 'phase3',
            'historiamorelos/caja65.csv' => 'phase3',
            'historiamorelos/caja66.csv' => 'phase3',
            'historiamorelos/caja67.csv' => 'phase3',
            'historiamorelos/caja68.csv' => 'phase3',
            'historiamorelos/caja69.csv' => 'phase3',
            'historiamorelos/caja70.csv' => 'phase3',
            'historiamorelos/caja71.csv' => 'phase3',
            'historiamorelos/caja72.csv' => 'phase3',
            'historiamorelos/caja73.csv' => 'phase3',
            'historiamorelos/caja74.csv' => 'phase3',
            'historiamorelos/caja75.csv' => 'phase3',
            'historiamorelos/caja76.csv' => 'phase3',
            'historiamorelos/caja77.csv' => 'phase3',
            'historiamorelos/caja79.csv' => 'phase3',
            'historiamorelos/caja80.csv' => 'phase3',
            'historiamorelos/caja81.csv' => 'historia_phase4',
            'historiamorelos/caja82.csv' => 'phase3',
            'historiamorelos/caja83.csv' => 'phase3',
            'historiamorelos/caja84.csv' => 'phase3',
            'historiamorelos/caja85.csv' => 'phase3',
            'historiamorelos/caja86.csv' => 'phase3',
            'historiamorelos/caja87.csv' => 'phase3',
            'historiamorelos/caja88.csv' => 'phase3',
            'historiamorelos/caja89.csv' => 'phase3',
            'historiamorelos/caja90.csv' => 'phase3',
            'historiamorelos/caja91.csv' => 'phase3',
            'historiamorelos/caja92.csv' => 'phase3',
            'historiamorelos/caja93.csv' => 'phase3',
            'historiamorelos/caja94.csv' => 'phase3',
            'historiamorelos/caja95.csv' => 'phase3',
            'historiamorelos/caja96.csv' => 'phase3',
        ];
    }

*/

    public function context() {
        return [
            'cocina.csv' => 'cocina_phase',
            'historia.csv' => 'historia_phase'
        ];
    }

    public function index() {
        $items = $this->transform_context();
        return view('migracion.list', compact('items'));
    }

    public function iniciar(Request $request) {
        $filename = $request->get('file');
        $file = file(public_path('db/'.$filename));
        $success = 0;
        $failed = 0;
        $is_first = true;
        $check = null;
        foreach($file as $line) {
            $line = utf8_encode($line);
            $extract = explode('|', $line);
            if($is_first == false) {
                //----------------------
                if($request->get('execute')) {
                    $this->get_function($filename, $extract);
                }
                //----------------------
            }
            if($is_first == true) {
                $check = count($extract);
                $is_first = false;
            }
            if(count($extract) == $check) {
                $success++;
            }
            else {
                $failed++;
            }
            $item[] = ($extract);
        }
        return view('migracion.check', compact('item', 'success', 'failed', 'filename'));
    }

    public function transform_context() {
        $items = [];
        foreach ($this->context() as $file => $funcion) {
            $items[] = (Object) ['file' => $file, 'funcion' => $funcion, 'name' => str_replace('/', '_', str_replace('.csv', '', $file))];
        }
        return $items;
    }

    public function get_function($filename, $list) {
        $list['filename'] = str_replace('.csv', '', $filename);
        return call_user_func([$this, $this->context()[$filename]], $list);
    }

    public function migration_ready($filename = null) {
        $lines = 0;
        if($filename == null) {
            $filename = $this->r->get('file');
        }
        $file = file(public_path('db/'.$filename));
        $is_first = true;
        foreach($file as $line) {
            $line = utf8_encode($line);
            $extract = explode('|', $line);
            if($is_first == false) {
                $this->get_function($filename, $extract);
            }
            else {
                $lines = count($extract);
            }
            $is_first = false;
        }
        $records = count($file) - 1;
        return ['status' => true, 'records' => $records, 'lines' => $lines];
    }

    public function cleanArray(array $array) {
        $out = [];
        foreach($array as $key => $value) {
            $value = trim($value);
            if(strlen($value) > 1) {
                $out[$key] = $value;
            }
        }
        return $out;
    }


    public function phase1($list) {
        $data = [
            'nombre' => $list[2],
            'descripcion' => $list[14],
            'keywords' => $list[13],
            'autor' => $list[0],
            'num_edicion' => $list[9],
            'lugar_edicion' => $list[3],
            'coleccion' => $list[8],
            'editorial' => $list[4],
            'num_libro' => 0,
            'year' => $this->get_value($list[5]),
            'tema' => 'Cocina'
        ];
        $this->create_book($data, null, $list);
    }

    public function phase2($list){

        $autor = $this->author_version1($list);

        $data = [
            'nombre' => $list[3],
            'descripcion' => 'Sin descripción',
            'keywords' => '',
            'autor' => $autor,
            'num_edicion' => $list[6],
            'lugar_edicion' => $list[9],
            'coleccion' => $list[11],
            'editorial' => $list[10],
            'num_libro' => $this->get_value($list[12]),
            'year' =>  $this->get_value($list[13]),
            'tema' => 'Cocina'
        ];

        if(str_contains($list['filename'], 'historia')) {
            $data['tema'] = 'Historia Morelos';
        }

        $meta['ifcm'] = $list[15];
        $meta['traduccion'] = $list[8];
        $meta['reimpresion'] = $list[7];

        $this->create_book($data, $meta, $list);
    }

    //Cordinador/Compilador/Editor
    public function phase3($list) {

        $autor = $this->author_version1($list);

        $data = [
            'nombre' => $list[4],
            'descripcion' => 'Sin descripción',
            'keywords' => '',
            'autor' => $autor,
            'num_edicion' => $list[7],
            'lugar_edicion' => $list[10],
            'coleccion' => $list[12],
            'editorial' => $list[11],
            'num_libro' => $this->get_value($list[13]),
            'year' => $this->get_value($list[14]),
            'tema' => 'Cocina'
        ];

        if(str_contains($list['filename'], 'historia')) {
            $data['tema'] = 'Historia Morelos';
        }

        $meta['ifcm'] = $list[16];
        $meta['traduccion'] = $list[9];
        $meta['reimpresion'] = $list[8];
        $meta['volumen'] = $list[6];
        $meta['tomo'] = $list[5];
        $meta['Coordinador/Compilador/Editor'] = $list[3];

        $this->create_book($data, $meta, $list);
    }

    public function phase4($list) {

        $autor = $this->author_version1($list);

        $data = [
            'nombre' => $list[3],
            'descripcion' => 'Sin descripción',
            'keywords' => '',
            'autor' => $autor,
            'num_edicion' => $list[6],
            'lugar_edicion' => $list[9],
            'coleccion' => $list[11],
            'editorial' => $list[10],
            'num_libro' => null,
            'year' => $this->get_value($list[12]),
            'tema' => 'Cocina'
        ];

        if(str_contains($list['filename'], 'historia')) {
            $data['tema'] = 'Historia Morelos';
        }

        $meta['ifcm'] = $list[14];
        $meta['traduccion'] = $list[9];
        $meta['reimpresion'] = $list[8];
        $meta['volumen'] = $list[6];
        $meta['tomo'] = $list[5];
        $meta['Coordinador/Compilador/Editor'] = $list[3];

        $this->create_book($data, $meta, $list);
    }

    public function historia_phase4($list) {

        $autor = $this->author_version1($list);

        $data = [
            'nombre' => $list[3],
            'descripcion' => 'Sin descripción',
            'keywords' => '',
            'autor' => $autor,
            'num_edicion' => $list[6],
            'lugar_edicion' => $list[9],
            'coleccion' => $list[11],
            'editorial' => $list[10],
            'num_libro' => null,
            'year' => $this->get_value($list[12]),
            'tema' => 'Historia Morelos'
        ];

        $meta['ifcm'] = $list[14];
        $meta['traduccion'] = $list[8];
        $meta['reimpresion'] = $list[7];
        $meta['volumen'] = $list[5];
        $meta['tomo'] = $list[4];

        $this->create_book($data, $meta, $list);
    }

    public function historia_dev1($list) {

        $data = [
            'nombre' => $list[2],
            'descripcion' => $list[14],
            'keywords' => $list[13],
            'autor' => $list[0],
            'num_edicion' => $list[9],
            'lugar_edicion' => $list[3],
            'coleccion' => $list[8],
            'editorial' => $list[4],
            'num_libro' => null,
            'year' => $list[5],
            'tema' => 'Historia Morelos', //$list[8],
        ];

        $meta = [
            'imprenta' => $list[12],
            'tomo' => $list[10],
            'formato' => $list[7],
            'traduccion' => $list[1]
        ];


        $this->create_book($data, $meta, $list);
    }

    public function cocina_phase($list) {

        $data = [
            'nombre' => $list[2],
            'descripcion' => $list[14],
            'keywords' => $list[13],
            'autor' => $list[0],
            'num_edicion' => $list[9],
            'lugar_edicion' => $list[3],
            'coleccion' => $list[8],
            'editorial' => $list[4],
            'num_libro' => null,
            'year' => $list[5],
            'tema' => 'Cocina'
        ];

        $meta = [
            'imprenta' => $list[12],
            'tomo' => $list[10],
            'formato' => $list[7],
            'traduccion' => $list[1],
            'paginas' => $list[6],
        ];

        $this->create_book($data, $meta, $list);
    }

    public function historia_phase($list) {

        $data = [
            'nombre' => $list[2],
            'descripcion' => $list[14],
            'keywords' => $list[13],
            'autor' => $list[0],
            'num_edicion' => $list[9],
            'lugar_edicion' => $list[3],
            'coleccion' => $list[8],
            'editorial' => $list[4],
            'num_libro' => null,
            'year' => $list[5],
            'tema' => 'Historia Morelos',
        ];

        $meta = [
            'imprenta' => $list[12],
            'tomo' => $list[10],
            'formato' => $list[7],
            'traduccion' => $list[1],
            'paginas' => $list[6],
        ];

        $this->create_book($data, $meta, $list);
    }

    public function create_book($data, $meta = [], $list) {
        $libro = Libro::create($data);
        $meta['source'] = $list['filename'];
        $libro->syncMeta($this->cleanArray($meta));
        $filename = $this->search_file($data['nombre']);
        $dirname = public_path('uploads/libros/'.$libro->id);
        if($filename) {
            if(!is_dir($dirname)) {
                mkdir($dirname);
            }
            $explode = explode('/', $filename);
            copy($filename, $dirname.'/'.end($explode));
        }
        return $libro;
    }


    public function author_version1($list) {
        $autor = '';

        if(!empty($list[1])) {
            $autor .= $list[1];
        }
        if(strlen(trim($list[0])) > 1) {
            $autor .= ' '.$list[0];
        }
        if(strlen(trim($list[2])) > 1) {
            if(strlen($autor) > 1) {
                $autor .= ', ';
            }
            $autor .= $list[2];
        }
        return $autor;
    }

    public function get_value($year, $default = null) {
        if(empty($year)) {
            return $default;
        }
        return $year;
    }


    function search_file($filename) {
        $path = '/db/files';
        $dir = scandir(public_path($path));
        foreach($dir as $file) {
            $filecheck = strtolower(str_replace('.pdf', '', $file));
            if(strtolower($filename) == $filecheck) {
                return public_path($path).'/'.$file;
            }
        }
        return null;
    }



}