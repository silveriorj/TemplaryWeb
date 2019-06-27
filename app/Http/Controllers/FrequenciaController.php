<?php
namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Auth;
use App\Frequencia;
use App\Gestao;
use App\User;
use App\Capitulo;
use App\Task;
use Khill\Lavacharts\Lavacharts;
use DateTime;

class FrequenciaController extends Controller{
    
   public function listar() {
        $demolay = User::all();
        $freq = Frequencia::all();
        $task = Task::all();
               
        return view('frequencia')->with('task', $task)->with('demolay', $demolay)->with('frequencia', $freq);
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
            $objDMModel->save();
        }
        // UPDATE
        else {
            $objDMModel = User::find($id);
            $objDMModel->name = mb_strtoupper(Request::input('name'), 'UTF-8');
            $objDMModel->email = Request::input('email');
            $arr = explode(" ", Request::input('id_grau'));
            $id_g = $arr[0];
            $objDMModel->id_grau = $id_g;
            $arr2 = explode(" ", Request::input('id_cargo'));
            $id_c = $arr2[0];
            $objDMModel->id_cargo = $id_c;
            $arr3 = explode(" ", Request::input('id_capitulo'));
            $id_cap = $arr3[0];
            $objDMModel->id_capitulo = $id_cap;
            

            $objDMModel->save();
        }
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

        return redirect()->action('FrequenciaController@listar');
    }





    public static function loadTabelafrequencias() {

        $frequencias = modelofrequencia::getfrequencias();

        while($objfrequencia = $frequencias->fetchObject()) {

            echo "<tr>";
                echo "<td>".$objfrequencia->id."</td>";
                echo "<td>".$objfrequencia->nome."</td>";
                echo "<td>".$objfrequencia->data."</td>";
                echo "<td>".$objfrequencia->carga_horaria."</td>";
                echo "<td>".$objfrequencia->responsavel."</td>";

                echo "<td>";
                    echo "<button type='submit' name='acao' value='alterar/".$objfrequencia->id."'>";
                        echo "<span class='glyphicon glyphicon-pencil'></span>";
                    echo "</button>";
                    echo "&nbsp";
                    echo "<button type='submit' name='acao' value='remover/".$objfrequencia->id."'>";
                        echo "<span class='glyphicon glyphicon-remove'></span>";
                    echo "</button>";
                    echo "&nbsp";
                    echo "<button type='submit' name='acao' value='vincular/".$objfrequencia->id."'>";
                        echo "<span class='glyphicon glyphicon-check'></span>";
                    echo "</button>";
                echo "</td>";
            echo "</tr>";
        }
    }

    public static function loadTabelaAlunosAulas() {
        $recordset = null;
        
        $recordset = self::montaArray();

        foreach ($recordset as $key => $value) {
            echo "<tr id=\"".$key."\" ><td>".$value['nome']."</td>";
            foreach ($value['frequencia'] as $id_frequencia => $reg) {              
                $i = 0;
                echo "<td>";
                echo "<select name=\"dados[sel_".$key."_".$id_frequencia."]\" >";

                while($i<3){
                    $select = $reg['faltas'] == $i ? "SELECTED" : '';

                    echo "<option ".$select." value=\"".$i."\">";
                    echo $i;
                    echo "</option>";
                    $i++;
                }
                echo "</select>";
                echo "</td>";
            }

            echo "<td class=\"porcentagem ". ($value['porcentagem'] < 70 ? ' redtext' : ' bluetext' ) ."\">".$value['porcentagem']."%</td>";
            echo "</tr>";
        }
    }


    public static function montaArray(){
        $alunos = modeloAluno::getAlunos();


        while($objAluno = $alunos->fetchObject()) {

            $aulas = modeloAula::getAula();
            $recordset[$objAluno->id]['nome'] = $objAluno->nome;
            $total_aula = 0;
            $total_faltas = 0;
            while($objAula = $aulas->fetchObject()) {
                $total_aula ++;
                $freq = modeloFrequenciaAluno::getFrequenciaAlunos($objAluno->id, $objAula->id);
                $recordset[$objAluno->id]['id_aula'] = $objAula->id;
                $recordset[$objAluno->id]['frequencia'][$objAula->id]['data'] = $objAula->data;
                $recordset[$objAluno->id]['frequencia'][$objAula->id]['conteudo'] = $objAula->conteudo;
                $objFreq = $freq->fetchObject();
                $recordset[$objAluno->id]['frequencia'][$objAula->id]['faltas'] = !empty($objFreq->faltas) ? $objFreq->faltas : 0;
                $total_faltas += $recordset[$objAluno->id]['frequencia'][$objAula->id]['faltas'];             
            }
            $total_aula = $total_aula*2;
            $recordset[$objAluno->id]['total_aula'] = $total_aula;
            $recordset[$objAluno->id]['total_faltas'] = $total_faltas;
            $recordset[$objAluno->id]['porcentagem'] = number_format(100-($total_faltas * 100 / $total_aula),1,'.',',');
        }
        return $recordset;
    }

    public static function loadCabecalhoTabelaAlunosAulas() {
        $aulas = modeloAula::getAula();
        echo "<td><strong>Alunos</strong></td>";
        while($objAula = $aulas->fetchObject()) {
                echo "<td><strong>".controleMain::databr($objAula->data)."</strong></td>";
        }
    }
}