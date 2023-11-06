<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\ArquivoContemplacao;
use App\Models\ArquivoResgate;
use App\Models\Parcela;
use App\Models\Reajuste;

class GrupoController extends Controller
{
    public function index(){
        $grupos = Grupo::all();
        return view('admin/grupos/index', compact('grupos'));
    }

    public function add(){
        return view('admin/grupos/add');
    }

    public function insert(Request $request){
        $dados = $request->all();
        $dados['vlCarta'] = valorFormDb($request->get('vlCarta'));
        $dados['vlCartaOriginal'] = $dados['vlCarta'];
        $dados['dtProxAniversario'] = date('Y-m-d', strtotime('+1 year', strtotime($request->get('dtInicio'))));
        $dados['nrAbertos'] = '0';
        $dados['nrContemplados'] = '0';
        $dados['nrResgatados'] = '0';

        if(strpos($dados['txAdmin'], ',')){
            $dados['txAdmin'] = str_replace(',','.',$dados['txAdmin']);
        }

        Grupo::create($dados);

        return redirect()->route('grupos')->with('mensagem', 'Grupo Cadastro com Sucesso!');
    }

    public function editar($id){
        $grupo = Grupo::where('id', $id)->first();
        if(Venda::numeroVendasGrupo($grupo->id) > 0){
            $mensagem = "Este grupo já possui vendas, dependento das alterações que fizer neste grupo você terá que fazer manualmente as alterarções nas parcelas das vendas. As novas vendas de cotas já serão incorporadas as alterações";
        }
        else{
            $mensagem = NULL;
        }

        return view('admin/grupos/editar', compact('grupo', 'mensagem'));

    }

    public function update(Request $request){
        $id = $request->get('id');

        $dados = $request->except('id', '_token');
        $dados['vlCarta'] = valorFormDb($request->get('vlCarta'));
        $dados['vlCartaOriginal'] = $dados['vlCarta'];
        $dados['dtProxAniversario'] = date('Y-m-d', strtotime('+1 year', strtotime($request->get('dtInicio'))));

        if(strpos($dados['txAdmin'], ',')){
            $dados['txAdmin'] = str_replace(',','.',$dados['txAdmin']);
        }

        Grupo::where('id', $id)->update($dados);

        return redirect()->route('grupos')->with('mensagem', 'Grupo Editado com Sucesso!');
    }

    public function excluir($id){
        $grupo = Grupo::find($id);

        if(Venda::numeroVendasGrupo($grupo->id) > 0){
            return redirect()->route('grupos')->with('mensagem', "O grupo possui vendas de cotas, isso impossibilita sua exclusão!");
        }
        else{
            return view('admin/grupos/excluir', compact('grupo'));
        }
    }

    public function delete(Request $request){
      $grupo = Grupo::find($request->get('id'));

      if(Venda::numeroVendasGrupo($grupo->id) == 0){
          $grupo->delete();
          return redirect()->route('grupos')->with('mensagem', 'Grupo excluido com Sucesso!');
      }
    }

    public function cotas($id){
        $grupo = Grupo::find($id);
        $cotistas = Venda::listarCotistasGrupo($grupo->id);

        return view('admin/grupos/cotas', compact('cotistas','grupo'));
    }

    public function contemplar($id){
        $venda = Venda::find($id);
        $grupo = Grupo::find($venda->id_grupo);
        $cliente = Cliente::find($venda->id_cliente);

        return view('admin/grupos/contemplar', compact('venda','grupo','cliente'));
    }

    public function contemplarInsert(Request $request){
        $id = $request->get('id');
        $dados = $request->only('dtContemplacao','dsContemplacao');
        $dados['id_usuario_contemplacao'] = auth()->user()->id;
        $dados['stVenda'] = "Contemplada";

        Venda::where('id', $id)->update($dados);

        $venda = Venda::find($id);

        $grupo = Grupo::find($venda->id_grupo);
        $grupo->atualizaNrParticipantes();

        $dadosUpdate = array();

        if($request->imagens){
            foreach ($request->imagens as $imagem) {
                $extensao = $imagem->extension();
                $dadosArquivo['id_venda'] = $venda->id;
                $dadosArquivo['id_cliente'] = $venda->id_cliente;
                $dadosArquivo['nmArquivo'] = $imagem->getClientOriginalName();

                $arquivo = ArquivoContemplacao::create($dadosArquivo);

                $arquivoPath = $arquivo->id.".".$extensao;

                $imagem->move(public_path('img/contemplacao/arquivos'), $arquivoPath);

                $dadosUpdate['arquivo'] = $arquivoPath;

                ArquivoContemplacao::where('id', $arquivo->id)->update($dadosUpdate);
            }
        }

        //vamos verificar se temos que enviar email
        $config = buscaDadosConfig();
        if($config->stMensagemContemplacao == "Sim"){
            $mensagem = $config->dsMensagemContemplacao;

            $cliente = Cliente::where('id', $venda->id_cliente)->first();

            $mensagem = str_replace('%Link%', config('constantes.URL_LOGIN_CLIENTE'), $mensagem);
            $mensagem = str_replace('%Name%', $cliente->nmCliente, $mensagem);
            $mensagem = str_replace('%Grupo%', $grupo->nrGrupo, $mensagem);
            $mensagem = str_replace('%Banco%', $grupo->nmBanco, $mensagem);
            $mensagem = str_replace('%DataContemplacao%', dataDbForm($venda->dtContemplacao), $mensagem);
            $mensagem = str_replace('%NameSystem%', $config->nmSistema, $mensagem);
            $mensagem = str_replace('%DescriptionSystem%', $config->dsTitulo, $mensagem);

            enviarMail($cliente->dsEmail, 'Parabéns, você foi contemplado', $mensagem);
        }

        return redirect()->route('grupoCotas', $venda->id_grupo)->with('mensagem', 'Contemplação registrada com sucesso!');
    }

    public function resgatar($id){
      $venda = Venda::find($id);
      $grupo = Grupo::find($venda->id_grupo);
      $cliente = Cliente::find($venda->id_cliente);

      return view('admin/grupos/resgatar', compact('venda','grupo','cliente'));
    }

    public function resgatarInsert(Request $request){
        $id = $request->get('id');
        $venda = Venda::find($id);
        $vlResgate = valorFormDb($request->get('vlResgate'));

        //se entrar aqui não precisa refazer as parcelas que já ainda falta pagar
        $venda->stVenda = "Resgatada";
        $venda->vlResgate = $vlResgate;
        $venda->dtResgate = $request->get('dtResgate');
        $venda->dsResgate = $request->get('dsResgate');
        $venda->id_usuario_resgate = auth()->user()->id;

        $venda->save();

        $grupo = Grupo::find($venda->id_grupo);
        $grupo->atualizaNrParticipantes();

        if($vlResgate != $venda->vlCarta){
            //vamos buscar qual o valor que este cliente já pagou de parcelas
            $totalParcelasPagas = Parcela::getTotalPagoVenda($venda->id);
            $nrParcelasAbertas = Parcela::getNrParcelasAbertas($venda->id);

            $novaParcela = round( ($venda->vlTotal + $vlResgate - $venda->vlCarta - $totalParcelasPagas) / $nrParcelasAbertas ,2);

            //vamos setar as parcelas restantes com  novo valor
            $dadosUpdateParcelas = array();
            $dadosUpdateParcelas['vlParcela'] = $novaParcela;
            $dadosUpdateParcelas['idPagamento'] = NULL;
            $dadosUpdateParcelas['linkPagamento'] = NULL;

            Parcela::where('id_venda', $venda->id)
              ->where('stParcela', 'Aberta')
              ->update($dadosUpdateParcelas);

        }

        $dadosUpdate = array();

        if($request->imagens){
            foreach ($request->imagens as $imagem) {
                $extensao = $imagem->extension();
                $dadosArquivo['id_venda'] = $venda->id;
                $dadosArquivo['id_cliente'] = $venda->id_cliente;
                $dadosArquivo['nmArquivo'] = $imagem->getClientOriginalName();

                $arquivo = ArquivoResgate::create($dadosArquivo);

                $arquivoPath = $arquivo->id.".".$extensao;

                $imagem->move(public_path('img/resgate/arquivos'), $arquivoPath);

                $dadosUpdate['arquivo'] = $arquivoPath;

                ArquivoResgate::where('id', $arquivo->id)->update($dadosUpdate);
            }
        }

        return redirect()->route('grupoCotas', $venda->id_grupo)->with('mensagem', 'Resgate registrada com sucesso!');

    }

    public function reajustar($id){
        $grupo = Grupo::where('id', $id)->first();

        $qtReajustes = Reajuste::where('id_grupo', $grupo->id)->orderBy('dtAniversario')->count();
        $reajustes = Reajuste::where('id_grupo', $grupo->id)->orderBy('dtAniversario')->get();

        return view('admin/grupos/reajustar', compact('grupo','reajustes','qtReajustes'));
    }

    public function reajusteCalcular(Request $request){
        $id = $request->get('id_grupo');
        $grupo = Grupo::where('id', $id)->first();

        $txReajuste = $request->get('txReajuste');

        if(strpos($txReajuste, ',')){
            $txReajuste = str_replace(',','.',$txReajuste);
        }

        $reajusteCarta = round(($grupo->vlCarta * $txReajuste) / 100, 2);
        $vlCartaNova = $grupo->vlCarta + $reajusteCarta;

        $var = round(($vlCartaNova * $grupo->txAdmin) / 100, 2);

        $valorTotal = round($vlCartaNova + $var, 2);

        $vlParcelaNova = round($valorTotal / $grupo->nrPrazo, 2);

        return view('admin/grupos/reajusteCalculos', compact('grupo','txReajuste','vlCartaNova','vlParcelaNova'));
    }

    public function reajusteInsert(Request $request){
        $id = $request->get('id_grupo');
        $txReajuste = $request->get('txReajuste');
        $vlCartaNova = $request->get('vlCartaNova');
        $vlParcelaNova = $request->get('vlParcelaNova');

        $grupo = Grupo::where('id', $id)->first();

        $controleData = $grupo->dtProxAniversario;

        $grupo->vlCarta = $request->get('vlCartaNova');
        $grupo->dtProxAniversario = date('Y-m-d', strtotime('+1 year', strtotime($grupo->dtProxAniversario)));

        $grupo->save();

        //vamos salvar os dados na tabela de Reajustes
        $dadosReajuste['id_grupo'] = $grupo->id;
        $dadosReajuste['dtAniversario'] = $controleData;
        $dadosReajuste['txReajuste'] = $txReajuste;
        $dadosReajuste['vlReajusteCarta'] = $vlCartaNova;
        $dadosReajuste['vlReajusteParcela'] = $vlParcelaNova;
        $dadosReajuste['id_user'] = auth()->user()->id;

        Reajuste::create($dadosReajuste);

        //vamos reajustar todos as vendas que ainda não foram resgatadas o valor da carta
        //Venda::atualizaVendasNãoResgatadas($grupo->id, $grupo->vlCarta);

        //vamos bscar todas as parcelas que vem a partir da data de aniversario para reajuste
        $parcelas = Parcela::listarParcelasParaReajuste($grupo->id, $controleData);

        foreach ($parcelas as $linha) {
            $parcela = Parcela::where('id',$linha->id)->first();
            $parcela->vlParcela = round($parcela->vlParcela + (($parcela->vlParcela * $txReajuste) / 100), 2);

            $parcela->save();
        }

        //vamos reajustar os valores de todas as vendas desse grupo
        $vendas = Venda::where('id_grupo', $grupo->id)->get();
        foreach($vendas as $venda){
            if($venda->stVenda != "Resgatada"){
                $dadosVenda = [
                    'vlCarta' => $grupo->vlCarta,
                    'vlTotal' => Parcela::somaTotalParcelas($venda->id),
                ];
            }
            else{
                $dadosVenda = [
                    'vlTotal' => Parcela::somaTotalParcelas($venda->id),
                ];
            }
            Venda::where('id', $venda->id)->update($dadosVenda);
        }

        return redirect()->route('grupos')->with('mensagem','Grupo reajustado com sucesso!');

    }

    public function visualizar($id){
        $grupo = Grupo::where('id', $id)->first();
        $qtReajustes = Reajuste::where('id_grupo', $grupo->id)->orderBy('dtAniversario')->count();
        $reajustes = Reajuste::where('id_grupo', $grupo->id)->orderBy('dtAniversario')->get();
        $cotistas = Venda::listarCotistasGrupo($grupo->id);

        return view('admin/grupos/visualizar', compact('grupo',  'reajustes', 'cotistas', 'qtReajustes'));
    }

}
