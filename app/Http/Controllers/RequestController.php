<?php

namespace App\Http\Controllers;

use App\Objects\Select;
use App\Models\Request;
use Barryvdh\DomPDF\Facade as PDF;

class RequestController extends Controller
{
    public function view() {
        $requests = Request::paginate();
        $paginate = $requests->render();
        return view('requests.index', compact('requests', 'paginate'));
    }

    public function new() {
        $levels = Select::create(Config('constants.levels'));
        return view('biblioteca.request', compact('levels'));
    }

    public function postValidator() {
        return [
            'type' => 'required|integer',
            'level' => 'required|string',
            'name' => 'required|string',
            'last_name' => 'required|string',
            'mat_last_name' => 'required|string',
            'curp' => 'required|min:18|max:18',
            'grade' => 'required',
            'sanguine' => 'required',
            'place_birth' => 'required',
            'birthday' => 'required',
            'age' => 'required|integer',
            'street' => 'required',
            'number' => 'required',
            'colony' => 'required',
            'town' => 'required',
            'zip_code' => 'required',
            'origin_school' => 'required',
            'f_name' => 'required',
            'f_last_name' => 'required',
            'f_mat_last_name' => 'required',
            'f_office_phone' => 'required_without_all:f_home_phone,f_cellphone',
            'f_home_phone' => 'required_without_all:f_office_phone,f_cellphone',
            'f_cellphone' => 'required_without_all:f_home_phone,f_office_phone',
            'f_email' => 'nullable|email',
            'm_name' => 'required',
            'm_last_name' => 'required',
            'm_mat_last_name' => 'required',
            'm_office_phone' => 'required_without_all:m_home_phone,m_cellphone',
            'm_home_phone' => 'required_without_all:m_office_phone,m_cellphone',
            'm_cellphone' => 'required_without_all:m_home_phone,m_office_phone',
            'm_email' => 'nullable|email',
            'o_name' => 'required',
            'o_last_name' => 'required',
            'o_mat_last_name' => 'required',
            'relationship' => 'required',
            'o_office_phone' => 'required_without_all:o_home_phone,o_cellphone',
            'o_home_phone' => 'required_without_all:o_office_phone,o_cellphone',
            'o_cellphone' => 'required_without_all:o_office_phone,o_home_phone',
            'o_email' => 'nullable|email',
            'observations' => 'required|max:255',
            'authorization' => 'required'
        ];
    }

    public function store() {
        request()->validate($this->postValidator());

        $request = Request::create([
            'date' => date('Y-m-d'),
            'type' => request('type'),
            'level' => request('level'),
            'name' => request('name'),
            'last_name' => request('last_name'),
            'mat_last_name' => request('mat_last_name'),
            'curp' => request('curp'),
            'grade' => request('grade'),
            'sanguine' => request('sanguine'),
            'place_birth' => request('place_birth'),
            'birthday' => request('birthday'),
            'age' => request('age'),
            'street' => request('street'),
            'number' => request('number'),
            'colony' => request('colony'),
            'town' => request('town'),
            'zip_code' => request('zip_code'),
            'origin_school' => request('origin_school'),
            'f_name' => request('f_name'),
            'f_last_name' => request('f_last_name'),
            'f_mat_last_name' => request('f_mat_last_name'),
            'f_company' => request('f_company'),
            'f_position' => request('f_position'),
            'f_office_phone' => request('f_office_phone'),
            'f_home_phone' => request('f_home_phone'),
            'f_cellphone' => request('f_cellphone'),
            'f_email' => request('f_email'),
            'm_name' => request('m_name'),
            'm_last_name' => request('m_last_name'),
            'm_mat_last_name' => request('m_mat_last_name'),
            'm_company' => request('m_company'),
            'm_position' => request('m_position'),
            'm_office_phone' => request('m_office_phone'),
            'm_home_phone' => request('m_home_phone'),
            'm_cellphone' => request('m_cellphone'),
            'm_email' => request('m_email'),
            'o_name' => request('o_name'),
            'o_last_name' => request('o_last_name'),
            'o_mat_last_name' => request('o_mat_last_name'),
            'relationship' => request('relationship'),
            'o_office_phone' => request('o_office_phone'),
            'o_home_phone' => request('o_home_phone'),
            'o_cellphone' => request('o_cellphone'),
            'o_email' => request('o_email'),
            'observations' => request('observations'),
            'authorization' => request('authorization')
        ]);

        $msg = 'Se registró una nueva solicitud para ' . strtoupper($request->level) . '. Para descargarla, visitar el siguiente enlace: https://grupoloyola.edu.mx/pdf/' . $request->id;

        $this->telegram($msg, $request->level);

        return ['status' => true, 'message' => 'Solicitud de inscripción registrada con éxito.', 'request' => $request->id];
    }

    public function telegram($msg, $level) {
        $telegrambot = '1248646771:AAF50yAFiz0IFstIsgcZa8Xj5o-m4Q_a5q8';
        $chatPrepaId = '-1001414436085';
        $chatPrimariaId = '-1001463317215';
        $chatCS = '-1001445407764';

        switch ($level) {
            case 'preparatoria':
                $telegramchatid = $chatPrepaId;
                break;
            case 'primaria':
                $telegramchatid = $chatPrimariaId;
                break;
            default:
                $telegramchatid = $chatCS;
        }

        $url='https://api.telegram.org/bot'.$telegrambot.'/sendMessage';$data=array('chat_id'=>$telegramchatid,'text'=>$msg);
        $options=array('http'=>array('method'=>'POST','header'=>"Content-Type:application/x-www-form-urlencoded\r\n",'content'=>http_build_query($data),),);
        $context=stream_context_create($options);
        $result=file_get_contents($url,false,$context);
        return $result;
    }

    public function delete(Request $request)
    {
        $request->delete();
        return ['success'=>true, 'message'=>'Solicitud eliminada con éxito.'];
    }

    public function pdf(Request $request)
    {
        $r = $request;
        $pdf = PDF::loadView('requests.pdf', compact('r'))->setPaper('legal');
        return $pdf->download($r->level . '-' . $r->full_name() . '.pdf');
        //return view('requests.pdf', compact('r'));
    }
}
