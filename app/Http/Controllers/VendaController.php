<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Grupo;
use App\Models\Cliente;
use App\Models\Parcela;
use App\Models\ArquivoVenda;
use App\Models\ArquivoCliente;
use App\Models\ArquivoContemplacao;
use App\Models\ArquivoResgate;

class VendaController extends Controller
{
    public function index(){
        //$vendas = Venda::all();
        $vendas = \DB::table('vendas')
            ->select('vendas.id','vendas.id_grupo','vendas.id_cliente','vendas.dtVenda','vendas.vlCarta','vendas.vlTotal','vendas.nrParcelas','vendas.dsObs','vendas.stVenda','vendas.id_usuario_venda','clientes.nmCliente','grupos.nrGrupo','users.name')
            ->leftJoin('clientes','vendas.id_cliente','=','clientes.id')
            ->leftJoin('grupos','vendas.id_grupo','=','grupos.id')
            ->leftJoin('users','vendas.id_usuario_venda','=','users.id')
            ->get();
        return view('admin/vendas/index', compact('vendas'));
    }

    public function add(){
        $grupos = Grupo::where('stGrupo', 'Ativo')->orderBy('nrGrupo')->get();
        $clientes = Cliente::all()->sortBy("nmCliente");;

        return view('admin/vendas/add', compact('grupos','clientes'));
    }

    public function calculaDadosVenda(Request $request){
        $dados = $request->only('id_grupo','id_cliente','dtVenda','dsObs');

        //vamos buscar os dados do grupos
        $grupo = Grupo::where('id', $dados['id_grupo'])->first();
        $cliente = Cliente::where('id', $dados['id_cliente'])->first();

        $retorno = calculaParcelasGrupo($grupo->nrPrazo, $grupo->dtInicio, $dados['dtVenda']);

        $dados['nrParcelas'] = $retorno['parcelasTotais'];
        $dtControle = $retorno['inicioPagamento'];

        $dados['inicioPagamento'] = $dtControle;
        $dados['vlCarta'] = $grupo['vlCarta'];
        $dados['vlAdm'] = round($grupo['vlCarta'] * ($grupo['txAdmin'] / 100), 2);
        $dados['vlTotal'] = round($dados['vlAdm'] + $grupo['vlCarta'], 2);
        $vlParcela = round($dados['vlTotal'] / $dados['nrParcelas'], 2);
        $dados['vlParcela'] = $vlParcela;

        $arrayParcelas = array();
        for($i=1 ; $i<=$dados['nrParcelas'] ; $i++){
            $parcela = array();
            $parcela[] = $i;
            $parcela[] = $dtControle;
            $parcela[] = $vlParcela;

            $arrayParcelas[] = $parcela;

            $dtControle = date('Y-m-d', strtotime('+1 month', strtotime($dtControle)));
        }

        return view('admin/vendas/viewParcelas', compact('dados', 'arrayParcelas', 'grupo', 'cliente'));
    }

    public function insert(Request $request){
        $dadosVenda = $request->only('id_grupo','id_cliente','dtVenda','vlCarta','vlTotal','nrParcelas','dsObs');
        $dadosVenda['id_usuario_venda'] = auth()->user()->id;
        $dadosVenda['stVenda'] = "Aberta";

        $venda = Venda::create($dadosVenda);

        $grupo = Grupo::find($dadosVenda['id_grupo']);
        $grupo->atualizaNrParticipantes();

        $dtParcela = $request->get('inicioPagamento');
        for($i=1 ; $i<=$dadosVenda['nrParcelas'] ; $i++){
            $dadosParcela['id_venda'] = $venda->id;
            $dadosParcela['id_cliente'] = $dadosVenda['id_cliente'];
            $dadosParcela['nrParcela'] = $i;
            $dadosParcela['vlParcela'] = $request->get('vlParcela');
            $dadosParcela['dtParcela'] = $dtParcela;
            $dadosParcela['stParcela'] = "Aberta";

            $dtParcela = date('Y-m-d', strtotime('+1 month', strtotime($dtParcela)));

            Parcela::create($dadosParcela);
        }

        //vamos verificar se veio arquivos no request
        $dadosUpdate = array();
        if($request->imagens){
            foreach ($request->imagens as $imagem) {
                $extensao = $imagem->extension();
                $dadosArquivo['id_venda'] = $venda->id;
                $dadosArquivo['id_cliente'] = $venda->id_cliente;
                $dadosArquivo['nmArquivo'] = $imagem->getClientOriginalName();

                $arquivo = ArquivoVenda::create($dadosArquivo);

                $arquivoPath = $arquivo->id.".".$extensao;

                $imagem->move(public_path('img/vendas/arquivos'), $arquivoPath);

                $dadosUpdate['arquivo'] = $arquivoPath;

                ArquivoVenda::where('id', $arquivo->id)->update($dadosUpdate);
            }
        }

        return redirect()->route('vendas')->with('mensagem', 'Venda registrada com sucesso!');
    }

    public function excluir($id){
        $venda = Venda::where('id', $id)->first();

        $cliente = Cliente::where('id', $venda->id_cliente)->first();

        $grupo = Grupo::where('id', $venda->id_grupo)->first();

        return view('/admin/vendas/excluir', compact('venda', 'cliente', 'grupo'));

    }

    public function delete(Request $request){
        $venda = Venda::where('id', $request->get('id'))->first();
        //entrando aqui vamos deletar as vendas, as parcelas da venda e tambem os arquivos da vendaAdd
        //começamos pelas parcelas
        Parcela::where('id_venda', $venda->id)->delete();

        ArquivoVenda::where('id_venda', $venda->id)->delete();

        Venda::where('id', $venda->id)->delete();

        $grupo = Grupo::find($venda->id_grupo);
        $grupo->atualizaNrParticipantes();

        return redirect()->route('vendas')->with('mensagem', 'Venda Excluída com sucesso!');
    }

    public function visualizar($id){
        $venda = Venda::where('id', $id)->first();

        $cliente = Cliente::where('id', $venda->id_cliente)->first();

        $grupo = Grupo::where('id', $venda->id_grupo)->first();

        $parcelas = Parcela::where('id_venda', $venda->id)->orderBy('nrParcela')->get();

        $arqsCliente = ArquivoCliente::where('id_cliente', $cliente->id)->get();

        $arqsVenda = ArquivoVenda::where('id_venda', $venda->id)->get();

        $arqsContemplacao = ArquivoContemplacao::where('id_venda', $venda->id)->get();

        $arqsResgate = ArquivoResgate::where('id_venda', $venda->id)->get();

        return view('/admin/vendas/visualizar', compact('venda', 'cliente', 'grupo','parcelas','arqsVenda','arqsCliente','arqsContemplacao','arqsResgate'));

    }

    public function listarParcelas($id){
        $venda = Venda::where('id', $id)->first();

        $cliente = Cliente::where('id', $venda->id_cliente)->first();

        $grupo = Grupo::where('id', $venda->id_grupo)->first();

        $parcelas = Parcela::where('id_venda', $venda->id)->orderBy('nrParcela')->get();

        return view('admin/vendas/listarParcelas', compact('venda','parcelas','cliente','grupo'));
    }

    public function addParcela($id){
        $venda = Venda::where('id', $id)->first();
        $cliente = Cliente::where('id', $venda->id_cliente)->first();
        $grupo = Grupo::where('id', $venda->id_grupo)->first();

        return view('admin/vendas/addParcela', compact('venda','cliente','grupo'));
    }

    public function insertParcela(Request $request){
        $dados = $request->only('id_venda','nrParcela','dtParcela');
        $dados['vlParcela'] = valorFormDb($request->get('vlParcela'));
        $dados['stParcela'] = "Aberta";

        $venda = Venda::where('id',$dados['id_venda'])->first();

        $dados['id_cliente'] = $venda->id_cliente;

        Parcela::create($dados);

        return redirect()->route('vendaParcelas', $venda->id)->with('mensagem', 'Parcela adicionada com sucesso!');
    }

    public function excluirParcela($id){
        $parcela = Parcela::where('id', $id)->first();
        $venda = Venda::where('id', $parcela->id_venda)->first();
        $grupo = Grupo::where('id', $venda->id_grupo)->first();
        $cliente = Cliente::where('id', $parcela->id_cliente)->first();

        return view('admin/vendas/excluirParcela', compact('parcela','venda','cliente','grupo'));
    }

    public function deleteParcela(Request $request){
        $id = $request->get('id');

        $parcela = Parcela::where('id', $id)->first();
        Parcela::where('id', $parcela->id)->delete();

        return redirect()->route('vendaParcelas', $parcela->id_venda)->with('mensagem', 'Parcela excluida com sucesso!');
    }

    public function pagarParcela($id){
        $parcela = Parcela::where('id', $id)->first();

        $venda = Venda::where('id', $parcela->id_venda)->first();

        $cliente = Cliente::where('id', $venda->id_cliente)->first();

        $grupo = Grupo::where('id', $venda->id_grupo)->first();

        return view('/admin/vendas/pagarParcela', compact('venda', 'cliente', 'grupo','parcela'));
    }

    public function setPagarParcela(Request $request){
        $id = $request->get('id');
        $dados['dtPagamento'] = $request->get('dtPagamento');
        $dados['vlPagamento'] = valorFormDb($request->get('vlPagamento'));
        $dados['stParcela'] = "Paga";

        Parcela::where('id', $id)->update($dados);

        $parcela = Parcela::where('id', $id)->first();
        return redirect()->route('vendaParcelas', $parcela->id_venda)->with('mensagem', 'Parcela paga com sucesso!');
    }

    public function desfazerPgtParcela($id){
        $parcela = Parcela::where('id', $id)->first();
        $venda = Venda::where('id', $parcela->id_venda)->first();
        $cliente = Cliente::where('id', $parcela->id_cliente)->first();
        $grupo = Grupo::where('id', $venda->id_grupo)->first();

        return view('admin/vendas/desfazerPgtParcela', compact('parcela','venda','cliente','grupo'));
    }

    public function setDesfazerPgtParcela(Request $request){
        $parcela = Parcela::find($request->get('id'));

        $parcela->stParcela = "Aberta";
        $parcela->dtPagamento = NULL;
        $parcela->vlPagamento = NULL;

        $parcela->save();

        return redirect()->route('vendaParcelas', $parcela->id_venda)->with('mensagem', 'Desfazer pagamento com sucesso!');
    }

}
