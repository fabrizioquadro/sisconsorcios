<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfigMensagem;
use App\Models\Configuracao;

class ConfiguracaoController extends Controller
{
    public function index(){
        $config = Configuracao::where('id', '1')->first();

        return view('admin/config/index', compact('config'));
    }

    public function setNome(Request $request){
        $config = Configuracao::where('id','1')->first();
        //vamos salvar nome e titulo
        $config->nmSistema = $request->get('nmSistema');
        $config->dsTitulo = $request->get('dsTitulo');
        $config->save();

        //vamos ver o logo
        if($request->hasFile('logo') && $request->file('logo')->isValid()){
            $imagem = $request->logo;
            $extensao = $imagem->extension();

            $nmImagem = "logo.".$extensao;

            $request->logo->move(public_path('img'), $nmImagem);

            $config->logo = $nmImagem;
            $config->save();
        }

        return redirect()->route('configuracoes')->with('mensagem', 'Dados Salvos');
    }

    public function setMensagensCad(Request $request){
        $config = Configuracao::where('id', '1')->first();

        $config->stMensagemCad = $request->get('stMensagemCad');
        $config->dsMensagemCad = $request->get('dsMensagemCad');

        $config->save();

        return redirect()->route('configuracoes')->with('mensagem', 'Dados Salvos');
    }

    public function setMensagensSenha(Request $request){
        $config = Configuracao::where('id', '1')->first();

        $config->stMensagemSenha = $request->get('stMensagemSenha');
        $config->dsMensagemSenha = $request->get('dsMensagemSenha');

        $config->save();

        return redirect()->route('configuracoes')->with('mensagem', 'Dados Salvos');
    }

    public function setMensagensContemplacao(Request $request){
        $config = Configuracao::where('id', '1')->first();

        $config->stMensagemContemplacao = $request->get('stMensagemContemplacao');
        $config->dsMensagemContemplacao = $request->get('dsMensagemContemplacao');

        $config->save();

        return redirect()->route('configuracoes')->with('mensagem', 'Dados Salvos');
    }

    public function setAsaas(Request $request){
        $config = Configuracao::where('id', '1')->first();

        $config->asaas_client = $request->get('asaas_client');
        $config->asaas_method = $request->get('asaas_method');

        $config->save();

        return redirect()->route('configuracoes')->with('mensagem', 'Dados Salvos');
    }






    //public function indexMensagens(){
    //    $mensagem = ConfigMensagem::find('1');
    //    return view('admin/config/mensagens', compact('mensagem'));
    //}
}
