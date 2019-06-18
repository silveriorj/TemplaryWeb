<?php
namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Auth;
use App\Frequencia;
use App\User;
use App\Capitulo;
use Khill\Lavacharts\Lavacharts;
use DateTime;

class FrequenciaController extends Controller{
    
   public function listar() {
        $cap = Capitulo::all();
        $demolay = User::all();
               
        return view('frequencia')->with('capitulo', $cap)->with('demolay', $demolay);
    }

    public function listarCapitulo($id) {

        if(is_numeric($id)) {

            $cap = Capitulo::find($id);
            if(empty($cap)) {
                return view("erro");
            }

            $registros = Frequencia::orderBy('created_at', 'desc')->get();
            $dm = User::all();
            return view('frequenciaCapitulo')->with('registros', $registros)->with('demolay', $dm)->with('capitulo', $cap);
        }
        else {
            return view("erro");
        }
    }

    public function cadastrar() {
        $demolay = User::all();
        $cap = Capitulo::orderBy('id')->get();
        return view('frequenciaCadastrar')->with('demolay', $demolay)->with('capitulo', $cap);
    }


    public function salvar($id) {

        $alunoss = Demolay::select('id', 'matricula')->get();
        $professor = ProfessorModel::all();
        $date = new DateTime();
        $dados['data'] = $date->format('d-m-Y H:i:s');
        // INSERT
        if($id == 0) {
            $objRegistroModel = new FrequenciaModel();

            $arr =  explode(" ", Request::input('aluno'));
            
            if(Auth::user()->type!=3){
                $prof = Request::input('professor');
            }else{
                foreach($professor as $profe){
                    if($profe->user->email==Auth::user()->email){
                        $prof = $profe->id;
                    }
                }
            }
            $objRegistroModel->id_user = Auth::user()->id;
            $objRegistroModel->id_aluno = $arr[0];
            $objRegistroModel->id_professor = $prof;
            $objRegistroModel->id_curso = $arr[1];
            $objRegistroModel->id_turma = $arr[2];
            $objRegistroModel->save();


            $msg = "Registro realizado com sucesso!!";
            return view('messagebox')->with('tipo', 'alert alert-success')
                    ->with('titulo', 'REGISTRO REALIZADOS COM SUCESSO')
                    ->with('msg', $msg)
                    ->with('acao', "/frequencia");

            return redirect()->action('FrequenciaController@listar')->withInput();

        }
      
        return redirect()->action('FrequenciaController@listar');
    }

    public function remover($id) {
        $alunos = AlunoModel::select('id', 'nome')->get();
        if(is_numeric($id)) {

            $registro = FrequenciaModel::find($id);
            

            if(empty($registro)) {
                return view("erro");
            }

            return view('frequenciaRemover')->with("registro", $registro)->with('alunos', $alunos);
        }

        return view("erro");
    }

    public function confirmar($id) {

        $objRegistroModel = FrequenciaModel::find($id);

        if(empty($objRegistroModel)) {
            return view("erro");
        }

        $objRegistroModel->delete();

        return redirect()->action('FrequenciaController@listar');
    }

}