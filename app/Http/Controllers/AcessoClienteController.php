<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Grupo;
use App\Models\Parcela;
use App\Models\ArquivoCliente;
use App\Models\ArquivoVenda;
use App\Models\ArquivoContemplacao;
use App\Models\ArquivoResgate;
use App\Models\Cliente;
use App\Models\Chamada;
use App\Models\ChamadaAndamento;

use LifenPag\Asaas\V3\Client;
use LifenPag\Asaas\V3\Domains\Customer as CustomerDomain;
use LifenPag\Asaas\V3\Domains\Payment as PaymentDomain;
use LifenPag\Asaas\V3\Entities\Customer as CustomerEntity;
use LifenPag\Asaas\V3\Collections\Customer as CustomerCollection;
use LifenPag\Asaas\V3\Entities\Payment as PaymentEntity;

class AcessoClienteController extends Controller
{
    public function dashboard(Request $request){
        //vamos buscar quantos consorcios o cliente possui quantos contemplados e quantos resgatados
        $cliente = session()->get('cliente');

        $qtVendas = Venda::where('id_cliente', $cliente->id)->count();

        $qtContempladas = Venda::where('id_cliente', $cliente->id)
            ->where('stVenda', 'Contemplada')
            ->count();

        $qtResgatadas = Venda::where('id_cliente', $cliente->id)
            ->where('stVenda', 'Resgatada')
            ->count();

        $chamadas = Chamada:: where('id_cliente', $cliente->id)
            ->where('dsVisualizarCliente','Não')
            ->orderby('dtHrChamada', 'asc')
            ->get();

        $data = date('Y-m-d');
        $dtControle = date('Y-m-d', strtotime('+2 month', strtotime($data)));

        $parcelas = Parcela::where('id_cliente', $cliente->id)
            ->where('dtParcela','<=',$dtControle)
            ->where('stParcela', 'Aberta')
            ->get();

        return view('acessoCliente/dashboard', compact('qtVendas','qtContempladas','qtResgatadas','chamadas','parcelas'));
    }

    public function consorcios(){
        $cliente = session()->get('cliente');

        $nrCotas = Venda::where('id_cliente', $cliente->id)->count();
        $vendas = Venda::listarVendasCliente($cliente->id);

        return view('acessoCliente/consorcios', compact('nrCotas','vendas'));
    }

    public function visualizarConsorcio($id){
        $cliente = session()->get('cliente');

        $venda = Venda::where('id', $id)->first();

        $grupo = Grupo::where('id', $venda->id_grupo)->first();

        $parcelas = Parcela::where('id_venda', $venda->id)->orderBy('nrParcela')->get();

        $arqsCliente = ArquivoCliente::where('id_cliente', $cliente->id_cliente)->get();

        $arqsVenda = ArquivoVenda::where('id_venda', $venda->id)->get();

        $arqsContemplacao = ArquivoContemplacao::where('id_venda', $venda->id)->get();

        $arqsResgate = ArquivoResgate::where('id_venda', $venda->id)->get();

        return view('/acessoCliente/visualizarConsorcio', compact('venda', 'cliente', 'grupo','parcelas','arqsVenda','arqsCliente','arqsContemplacao','arqsResgate'));
    }

    public function financeiro(){
        $cliente = session()->get('cliente');

        $parcelas = Parcela::listarParcelasCliente($cliente->id);

        return view('acessoCliente/financeiro', compact('parcelas'));
    }

    public function gerarBoleto($id){
        $config = buscaDadosConfig();

        $cliente = session()->get('cliente');

        $dadosCliente = Cliente::find($cliente->id);

        $parcela = Parcela::find($id);

        if($parcela->linkPagamento != ""){
            return redirect($parcela->linkPagamento);
            exit();
        }

        $venda = Venda::find($parcela->id_venda);

        $grupo = Grupo::find($venda->id_grupo);

        $asaas_client = $config->asaas_client;
        $asaas_method = $config->asaas_method;

        $qtParcela = '1';
        $vlParcela = $parcela->vlParcela;

        $nrCpf = str_replace('.','',$dadosCliente->nrCpf);
        $nrCpf = str_replace('-','',$nrCpf);

        $nrEndereco = $dadosCliente->nrEndereco == "" ? "1285" : $dadosCliente->nrEndereco;
        $nrCep = $dadosCliente->nrCep == "" ? "96300-000" : $dadosCliente->nrCep;

        $var = explode(' ', $dadosCliente->nrCel);
        $telefone = $var[1];
        $telefone = str_replace('-','', $telefone);
        $ddd = $var[0];
        $ddd = $ddd[1].$ddd[2];

        $dtVencimento = dataDbForm($parcela->dtParcela);
        $dtVencimento = \DateTime::createFromFormat('d/m/Y', $dtVencimento);

        $descricao = "Pagamento da parcela ".$parcela->nrParcela." referente ao consórcio: Banco ".$grupo->nmBanco." ".", grupo ".$grupo->nrGrupo;

        Client::connect($asaas_client, $asaas_method);

        //vamos analizar se já existe o customer_id

        if($dadosCliente->customer_id == ""){
            $customer = new CustomerEntity();
            $customer->name = $dadosCliente->nmCliente;
            $customer->email = $dadosCliente->dsEmail;
            $customer->cpfCnpj = $nrCpf;

            $customerCreated = $customer->create();

            $customer_id = $customerCreated->id;
            $dadosCliente->customer_id = $customer_id;
            $dadosCliente->save();
        }

        $payment = new PaymentEntity();
        $payment->customer = $dadosCliente->customer_id;
        $payment->billingType = 'BOLETO';
        $payment->value = $vlParcela;
        $payment->dueDate = $dtVencimento->format('Y-m-d');
        $payment->description = $descricao;

        $paymentCreated = $payment->create();


        try{
            $paymentCreated = $payment->create();
            $id = $paymentCreated->id;
            $pdf = $paymentCreated->invoiceUrl;

            $parcela->idPagamento = $id;
            $parcela->linkPagamento = $pdf;

            $parcela->save();

            return redirect($pdf);
        }catch (\Exception $e) {

            echo "<h3>Erro:</h3>Desculpe o transtorno, mas aconteceu um erro na sua solicitação<br>Exceção capturada: <br>',  ".$e->getMessage();
        }

    }

    public function chamadas(){
        $cliente = session()->get('cliente');

        $chamadas = Chamada::where('id_cliente', $cliente->id)
            ->orderBy('dtHrChamada','desc')->get();
        return view('acessoCliente/chamadas', compact('chamadas','cliente'));
    }

    public function chamadasAdicionar(){
        return view('acessoCliente/chamadasAdicionar');
    }

    public function chamadasInsert(Request $request){
        $cliente = session()->get('cliente');

        $dados = [
            'id_cliente' => $cliente->id,
            'dtHrChamada' => date('Y-m-d H:i:s'),
            'dsChamada' => $request->get('dsChamada'),
            'dsVisualizarCliente' => 'Sim',
            'dsVisualizarAdmin' => 'Não',
            'stChamada' => 'Aberta',
        ];

        Chamada::create($dados);

        return redirect()->route('cliente.chamadas')->with('mensagem', "Chamada Cadastrada!");
    }

    public function chamadasAcessar($id){
        $cliente = session()->get('cliente');

        $chamada = Chamada::where('id', $id)
            ->where('id_cliente', $cliente->id)
            ->first();

        if($chamada){
            $chamada->dsVisualizarCliente = "Sim";
            $chamada->save();

            $andamentos = ChamadaAndamento::where('id_chamada', $chamada->id)
                ->orderBy('dtHrAndamento', 'desc')
                ->get();

            return view('acessoCliente/chamadasAcessar', compact('chamada','andamentos'));
        }
        else{
            return redirect()->route('cliente.chamadas')->with('mensagem', 'Você não possui permissão para acessar esta chamada!');
        }
    }

    public function chamadasAndamento(Request $request){
        $dados = [
            'id_chamada' => $request->get('id_chamada'),
            'dtHrAndamento' => date('Y-m-d H:i:s'),
            'dsInsercao' => 'Cliente',
            'dsAndamento' => $request->get('dsAndamento'),
        ];

        ChamadaAndamento::create($dados);

        //vamos setar a chamada como não vista pelo admi
        $chamada = Chamada::where('id', $dados['id_chamada'])->first();
        $chamada->dsVisualizarAdmin = 'Não';
        $chamada->save();

        return redirect()->route('cliente.chamadas.acessar',$chamada->id)->with('mensagem','Andamento Cadastrado com Sucesso!');

    }
}
