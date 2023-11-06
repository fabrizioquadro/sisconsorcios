<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\Parcela;

class RelatorioController extends Controller
{
    public function indexClientes(){
        $grupos = Grupo::all()->sortBy('nrGrupo');

        return view('admin/relatorio/indexClientes', compact('grupos'));
    }

    public function pesquisarClientes(Request $request){
        $dados = $request->except('_token');
        $clientes = Cliente::pesquisar($dados);
        $i = 0;

        return view('admin/relatorio/relClientes', compact('clientes','i'));
    }

    public function indexGrupos(){
        return view('admin/relatorio/indexGrupos');
    }

    public function pesquisarGrupos(Request $request){
        $dados = $request->except('_token');
        $grupos = Grupo::pesquisar($dados);
        $i = 0;

        return view('admin/relatorio/relGrupos', compact('grupos','i'));
    }

    public function indexVendas(){
        $grupos = Grupo::all()->sortBy('nrGrupo');
        $clientes = Cliente::all()->sortBy('nmCliente');

        return view('admin/relatorio/indexVendas', compact('grupos','clientes'));
    }

    public function pesquisarVendas(Request $request){
        $dados = $request->except('_token');
        $vendas = Venda::pesquisar($dados);
        $i=0;

        return view('admin/relatorio/relVendas', compact('vendas','i'));
    }

    public function indexParcelas(){
        $clientes = Cliente::all()->sortBy('nmCliente');
        $grupos = Grupo::all()->sortBy('nrGrupo');

        return view('admin/relatorio/indexParcelas', compact('clientes','grupos'));
    }

    public function pesquisarParcelas(Request $request){
        $dados = $request->except('_token');
        $parcelas = Parcela::pesquisar($dados);
        $i=0;
        $total=0;
        $totalPgt=0;

        return view('admin/relatorio/relParcelas', compact('parcelas','i','total','totalPgt'));
    }

    public function indexContemplacoes(){
        $grupos = Grupo::all()->sortBy('nrGrupo');

        return view("admin/relatorio/indexContemplacoes", compact('grupos'));
    }

    public function pesquisarContemplacoes(Request $request){
        $dados = $request->except('_token');
        $contemplacoes = Venda::getContemplacoes($dados);
        $i=0;

        return view('admin/relatorio/relContemplacoes', compact('contemplacoes','i'));
    }

    public function indexResgates(){
        $grupos = Grupo::all()->sortBy('nrGrupo');

        return view("admin/relatorio/indexResgates", compact('grupos'));
    }

    public function pesquisarResgates(Request $request){
        $dados = $request->except('_token');
        $resgates = Venda::getResgatados($dados);
        $total = 0;
        $i=0;

        return view('admin/relatorio/relResgates', compact('resgates','i','total'));
    }

}
