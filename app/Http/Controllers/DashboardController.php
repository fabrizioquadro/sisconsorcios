<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\Parcela;

class DashboardController extends Controller
{
    public function index(){
        $qtGruposAtivos = Grupo::where('stGrupo', 'Ativo')->count();
        $qtClientes = Cliente::all()->count();
        $qtVendas = Venda::all()->count();
        $qtAbertas = Venda::where('stVenda', "Aberta")->count();
        $qtContempladas = Venda::where('stVenda', "Contemplada")->count();
        $qtResgatadas = Venda::where('stVenda', "Resgatada")->count();
        $parcelasAtrasadas = Parcela::listarAtrasadas();

        //vamos calcular as parcelas que entraram nos ultimos 7 dias
        $vlEntradaParcelas = Parcela::somaValoresEntradaUltimosDias(7);

        //vamos calcular as previsao proximos 7 dias
        $vlPrevisaoParcelas = Parcela::somaValoresEntradaProximosDias(7);

        $data = date('y-m-d');
        $dataControle1 = date('Y-m-d', strtotime("-2 month", strtotime($data)));
        $dataControle2 = date('Y-m-d', strtotime("+2 month", strtotime($data)));
        $gruposAniversario = Grupo::where('dtProxAniversario','>=',$dataControle1)
                    ->where('dtProxAniversario','<=',$dataControle2)
                    ->get();

        return view('admin/dashboard', compact('qtGruposAtivos','qtClientes','qtVendas',
            'qtAbertas','qtContempladas','qtResgatadas','parcelasAtrasadas','vlEntradaParcelas',
            'vlPrevisaoParcelas','gruposAniversario')
        );
    }
}
