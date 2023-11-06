<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    public function index(){
        $usuarios = User::all();

        return view('admin/usuarios/index', compact('usuarios'));
    }

    public function add(){
        return view('admin/usuarios/add');
    }

    public function insert(Request $request){
        $dados = $request->all();

        $user = User::create($dados);

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $imagem = $request->imagem;
            $extensao = $imagem->extension();

            $nmImagem = $user->id.".".$extensao;

            $request->imagem->move(public_path('img/usuarios'), $nmImagem);

            $user['image'] = $nmImagem;

            $user->save();
        }

        return redirect()->route('usuarios')->with('mensagem', 'Usuário Cadastrado');
    }

    public function editar($id){
        $usuario = User::where('id',$id)->first();

        return view('admin/usuarios/editar', compact('usuario'));
    }

    public function update(Request $request){
        $id = $request->get('id');
        $dados = $request->only('name','email','type');

        User::where('id', $id)->update($dados);

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $user = User::find($id);
            $imagem = $request->imagem;
            $extensao = $imagem->extension();

            $nmImagem = $user->id.".".$extensao;

            $request->imagem->move(public_path('img/usuarios'), $nmImagem);

            $user['image'] = $nmImagem;

            $user->save();
        }

        return redirect()->route('usuarios')->with('mensagem', "Usuário Editado");

    }

    public function excluir($id){
        $usuario = User::where('id', $id)->first();

        return view('admin/usuarios/excluir', compact('usuario'));
    }

    public function delete(Request $request){
        $id = $request->get('id');
        User::where('id', $id)->delete();

        return redirect()->route('usuarios')->with('mensagem', "Usuário Excluído");
    }

    public function visualizar($id){
        $usuario = User::where('id', $id)->first();

        return view('admin/usuarios/visualizar', compact('usuario'));
    }

    public function alterarSenha($id){
        $usuario = User::where('id', $id)->first();

        return view('admin/usuarios/alterarSenha', compact('usuario'));
    }

    public function alterarSenhaSql(Request $request){
        $id = $request->get('id');
        $dados['password'] = bcrypt($request->get('password'));

        User::where('id', $id)->update($dados);

        return redirect()->route('usuarios')->with('mensagem', "Senha Alterada");
    }

}
