<?php
/**
 * Created by PhpStorm.
 * User: josehuerta
 * Date: 28/12/18
 * Time: 10:23
 */

namespace App\Http\Controllers\Cms;


use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MediaController extends Controller {


    public $r;

    public function __construct(Request $request)
    {
        $this->r = $request;
    }


    public function view_ajax() {
        $files = Media::orderBy('id', 'DESC')->paginate(12);
        return view('cms.media.view-ajax', compact('files'));
    }


    public function upload() {

        $this->validate($this->r, [
            'file' => ['required']
        ]);
        $file = $this->r->file('file');
        $fileName = $this->sanear_string($file->getClientOriginalName());
       $path_public = 'media/';
       $name = $path_public.$fileName;

        if(file_exists($name)){
            $name = $path_public . rand(1000,9999) . $fileName;
        }

       if(!file_exists($path_public)) {
           mkdir($path_public);
       }

       if(move_uploaded_file($file->getRealPath(), $name)) {
           $this->create_file($name);
           return ['success'=> 'success', 'message' => 'subido correctamente', 'archivo' => 'name', 'path' => 'asd'];
       }

    }


    private function create_file($ruta) {
        return Media::create([
            'ruta' => $ruta
        ]);
    }

    public function index() {
        $images = Media::paginate(10);
        $paginate = $images->render();

        return view('cms.media.index', compact('images', 'paginate'));
    }

    public function delete(Media $media)
    {
        unlink($media->ruta);
        $media->delete();

        Session::flash('message', 'Imagen eliminada con éxito');

        return response()->json(['success'=>true]);
    }

    /**
     * Reemplaza todos los acentos por sus equivalentes sin ellos
     *
     * @param $string
     *  string la cadena a sanear
     *
     * @return $string
     *  string saneada
     */
    private function sanear_string($string)
    {

        $string = trim($string);

        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );

        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
            array("¨", "º", "-", "~",
             "#", "@", "|", "!",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "<code>", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             " "),
            '',
            $string
        );


        return $string;
    }

}

