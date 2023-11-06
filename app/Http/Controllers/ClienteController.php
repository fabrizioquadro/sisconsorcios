<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ArquivoCliente;

class ClienteController extends Controller
{
    public function index(){
        $clientes = Cliente::all();

        return view('admin/clientes/index', compact('clientes'));
    }

    public function add(){
        return view('admin/clientes/add');
    }

    public function insert(Request $request){
        $dados = $request->except('imagem','password');
        $dados['password'] = bcrypt($request->password);

        $cliente = Cliente::create($dados);

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $imagem = $request->imagem;
            $extensao = $imagem->extension();

            $nmImagem = $cliente->id.".".$extensao;
            $dadosUpdate['imagem'] = $nmImagem;

            $request->imagem->move(public_path('img/clientes'), $nmImagem);

            Cliente::where('id', $cliente->id)->update($dadosUpdate);
        }

        $dadosUpdate = array();
        if($request->imagens){
            foreach ($request->imagens as $imagem) {
                $extensao = $imagem->extension();
                $dados['id_cliente'] = $cliente->id;
                $dados['nmArquivo'] = $imagem->getClientOriginalName();

                $arquivo = ArquivoCliente::create($dados);

                $arquivoPath = $arquivo->id.".".$extensao;

                $imagem->move(public_path('img/clientes/arquivos'), $arquivoPath);

                $dadosUpdate['arquivo'] = $arquivoPath;

                ArquivoCliente::where('id', $arquivo->id)->update($dadosUpdate);
            }
        }

        //vamos verificar se é necessario enviar email para o cliente
        $config = buscaDadosConfig();
        if($config->stMensagemCad == "Sim"){
            $mensagem = $config->dsMensagemCad;
            $mensagem = str_replace('%Link%', config('constantes.URL_LOGIN_CLIENTE'), $mensagem);
            $mensagem = str_replace('%User%', $request->get('dsEmail'), $mensagem);
            $mensagem = str_replace('%Password%', $request->get('password'), $mensagem);
            $mensagem = str_replace('%Name%', $request->get('nmCliente'), $mensagem);
            $mensagem = str_replace('%NameSystem%', $config->nmSistema, $mensagem);
            $mensagem = str_replace('%DescriptionSystem%', $config->dsTitulo, $mensagem);

            enviarMail($request->get('dsEmail'), 'Cliente Cadastrado', $mensagem);
        }

        return redirect()->route('clientes')->with('mensagem', 'Cliente Cadastrado');
    }

    public function editar($id){
        $cliente = Cliente::where('id', $id)->first();

        $arquivos = ArquivoCliente::where('id_cliente', $cliente->id)->get();

        return view('admin/clientes/editar', compact('cliente', 'arquivos'));
    }

    public function excluirArquivo($id){
        $arquivo = ArquivoCliente::where('id', $id)->first();
        return view('admin/clientes/excluirArquivo', compact('arquivo'));
    }

    public function excluirArquivoSql(Request $request){
        $id = $request->get('id');
        $arquivo = ArquivoCliente::where('id', $id)->first();

        ArquivoCliente::where('id', $id)->delete();

        return redirect()->route('clienteEditar', $arquivo->id_cliente)->with('mensagem', 'Arquivo Escluído com sucesso!');
    }

    public function update(Request $request){
        $id = $request->get('id');
        $dados = $request->except('id','imagens','imagem','_token');

        Cliente::where('id',$id)->update($dados);
        $cliente = Cliente::where('id',$id)->first();

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $imagem = $request->imagem;
            $extensao = $imagem->extension();

            $nmImagem = $cliente->id.".".$extensao;
            $dadosUpdate['imagem'] = $nmImagem;

            $request->imagem->move(public_path('img/clientes'), $nmImagem);

            Cliente::where('id', $cliente->id)->update($dadosUpdate);
        }

        $dadosUpdate = array();
        if($request->imagens){
            foreach ($request->imagens as $imagem) {
                $extensao = $imagem->extension();
                $dados['id_cliente'] = $cliente->id;
                $dados['nmArquivo'] = $imagem->getClientOriginalName();

                $arquivo = ArquivoCliente::create($dados);

                $arquivoPath = $arquivo->id.".".$extensao;

                $imagem->move(public_path('img/clientes/arquivos'), $arquivoPath);

                $dadosUpdate['arquivo'] = $arquivoPath;

                ArquivoCliente::where('id', $arquivo->id)->update($dadosUpdate);
            }
        }

        return redirect()->route('clientes')->with('mensagem', 'Cliente Editado');
    }

    public function excluir($id){
        $cliente = Cliente::where('id', $id)->first();

        return view('admin/clientes/excluir', compact('cliente'));
    }

    public function delete(Request $request){
        $id = $request->get('id');

        ArquivoCliente::where('id_cliente', $id)->delete();
        Cliente::where('id', $id)->delete();

        return redirect()->route('clientes')->with('mensagem', 'Cliente Excluído');
    }

    public function visualizar($id){
        $cliente = Cliente::where('id', $id)->first();

        $arquivos = ArquivoCliente::where('id_cliente', $cliente->id)->get();

        return view('admin/clientes/visualizar', compact('cliente', 'arquivos'));
    }

    public function alterarSenha($id){
        $cliente = Cliente::where('id', $id)->first();
        return view('admin/clientes/alterarSenha', compact('cliente'));
    }

    public function alterarSenhaSql(Request $request){
        $id = $request->get('id');
        $dados['password'] = bcrypt($request->get('password'));

        Cliente::where('id', $id)->update($dados);
        return redirect()->route('clientes')->with('mensagem', 'Senha Cliente Alterada!');
    }


}
