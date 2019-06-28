<?php
namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Auth;
use App\Frequencia;
use App\User;
use App\Task;
use Khill\Lavacharts\Lavacharts;
use DateTime;

class FrequenciaController extends Controller{

    public function index() {
        $demolay = User::all();
        $frequencia = Frequencia::all();
        $task = Task::all();
               
        return view('frequencia.index')->with('demolay', $demolay)->with('frequencia', $frequencia)->with('tasks', $task);
    }

    public function create()
    {
        return view('frequencia.create');
    }

    public function store(Request $request)
    {
         // INSERT
         if($request) {
            $objFreqModel = new Frequencia();
            $objFreqModel->frequencia = Request::input('frequencia');
            $arr = explode(" ", Request::input('id_user'));
            $id_u = $arr[0];
            $objFreqModel->id_user = $id_u;
            $arr2 = explode(" ", Request::input('id_task'));
            $id_t = $arr2[0];
            $objFreqModel->id_task = $id_t;
            $objFreqModel->save();
        }
        // UPDATE
        else {
            $objFreqModel = Frequencia::find($id);
            $objFreqModel->frequencia = Request::input('frequencia');
            $arr = explode(" ", Request::input('id_user'));
            $id_u = $arr[0];
            $objFreqModel->id_user = $id_u;
            $arr2 = explode(" ", Request::input('id_task'));
            $id_t = $arr2[0];
            $objFreqModel->id_task = $id_t;
            $objFreqModel->save();
        }
        return redirect()->route('frequencia.index')->withInput();
    }

    public function cadastrar() {
        $demolay = User::all();
        $cap = Capitulo::orderBy('id')->get();
        return view('frequenciaCadastrar')->with('demolay', $demolay)->with('capitulo', $cap);
    }


    public function salvar($id) {
        // INSERT
        if($id == 0) {
            $objFreqModel = new Frequencia();
            $objFreqModel->frequencia = Request::input('frequencia');
            $arr = explode(" ", Request::input('id_user'));
            $id_u = $arr[0];
            $objFreqModel->id_user = $id_u;
            $arr2 = explode(" ", Request::input('id_task'));
            $id_t = $arr2[0];
            $objFreqModel->id_task = $id_t;
            $objFreqModel->save();
        }
        // UPDATE
        else {
            $objFreqModel = Frequencia::find($id);
            $objFreqModel->frequencia = Request::input('frequencia');
            $arr = explode(" ", Request::input('id_user'));
            $id_u = $arr[0];
            $objFreqModel->id_user = $id_u;
            $arr2 = explode(" ", Request::input('id_task'));
            $id_t = $arr2[0];
            $objFreqModel->id_task = $id_t;
            $objFreqModel->save();
        }
        return redirect()->route('frequencia.index')->withInput();
    }

    public function remover($id) {
        $alunos = AlunoModel::select('id', 'nome')->get();
        if(is_numeric($id)) {

            $registro = Frequencia::find($id);
            

            if(empty($registro)) {
                return view("erro");
            }

            return view('frequenciaRemover')->with("registro", $registro)->with('alunos', $alunos);
        }

        return view("erro");
    }

    public function confirmar($id) {

        $objRegistroModel = Frequencia::find($id);

        if(empty($objRegistroModel)) {
            return view("erro");
        }

        $objRegistroModel->delete();

        return redirect()->route('frequencia.index');
    }
}