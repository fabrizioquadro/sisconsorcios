<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamada;
use App\Models\ChamadaAndamento;
use App\Models\Cliente;

class ChamadaController extends Controller
{
    public function index(){
        //$chamadas = Chamada::select('chamadas.id AS id_chamada','*')->leftJoin('clientes', 'chamadas.id_cliente','=','clientes.id')->get();
        $chamadas = Chamada::listar();

        return view('admin/chamadas/index', compact('chamadas'));
    }

    public function acessar($id){
        $chamada = Chamada::where('id', $id)->first();

        $chamada->dsVisualizarAdmin = "Sim";
        $chamada->save();

        $cliente = Cliente::where('id', $chamada->id_cliente)->first();

        $andamentos = ChamadaAndamento::where('id_chamada', $chamada->id)
            ->orderBy('dtHrAndamento', 'desc')
            ->get();

        return view('admin/chamadas/chamadasAcessar', compact('chamada','andamentos','cliente'));
    }

    public function andamento(Request $request){
        $chamada = Chamada::where('id', $request->get('id_chamada'))->first();

        $chamada->dsVisualizarCliente = 'Não';
        $chamada->stChamada = $request->get('stChamada');
        $chamada->save();

        if($request->get('dsAndamento')){
            $dados = [
                'id_chamada' => $chamada->id,
                'dtHrAndamento' => date('Y-m-d H:i:s'),
                'dsInsercao' => 'Administrador',
                'dsAndamento' => $request->get('dsAndamento'),
            ];

            ChamadaAndamento::create($dados);
        }

        return redirect()->route('chamadas.acessar',$chamada->id)->with('mensagem','Andamento Cadastrado com Sucesso!');
    }
}
