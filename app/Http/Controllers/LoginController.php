<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Cliente;


class LoginController extends Controller
{
    public function index(){
        return view('login/login');
    }

    public function autenticar(Request $request){
        $dados = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($dados)){
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        else{
          return redirect()->back()->with('erro', "Email ou senha inválidos");
        }
    }

    public function esqueceuSenha(){
        return view('login/esqueceuSenha');
    }

    public function recuperarSenha(Request $request){
        $email = $request->email;

        //echo $email;
        $user = User::where('email', $email)->first();

        if($user){
            $novaSenha = createPassword(8, true, true, true, false);

            $user->password = bcrypt($novaSenha);

            $user->save();

            $config = buscaDadosConfig();

            $mensagem = $config->dsMensagemSenha;

            $mensagem = str_replace('%Link%', config('constantes.URL_LOGIN'), $mensagem);
            $mensagem = str_replace('%User%', $user->email, $mensagem);
            $mensagem = str_replace('%Password%', $novaSenha, $mensagem);
            $mensagem = str_replace('%Name%', $user->name, $mensagem);
            $mensagem = str_replace('%NameSystem%', $config->nmSistema, $mensagem);
            $mensagem = str_replace('%DescriptionSystem%', $config->dsTitulo, $mensagem);

            enviarMail($user->email, 'Nova Senha de Acesso', $mensagem);

            return redirect()->route('login')->with('mensagem','Sua nova senha foi enviado para o seu email.');
        }
        else{
            return redirect()->back()->with('mensagem', "Email Inválido");
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function perfil(){
        return view('login/perfil');
    }

    public function update(Request $request){

        $id = auth()->user()->id;
        $dados = $request->only('name','email','type');
        User::where('id', $id)->update($dados);

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $imagem = $request->imagem;
            $extensao = $imagem->extension();

            $nmImagem = $id.".".$extensao;
            $dadosUpdate['image'] = $nmImagem;

            $request->imagem->move(public_path('img/usuarios'), $nmImagem);

            User::where('id', $id)->update($dadosUpdate);
        }

        return redirect()->route('login.perfil')->with('mensagem', "Perfil Alterado");
    }

    public function alterarSenha(){
        return view('login/alterarSenha');
    }

    public function updateSenha(Request $request){
      $dados['password'] = bcrypt($request->get('password'));
      User::where('id', auth()->user()->id)->update($dados);

      return redirect()->route('login.perfil')->with('mensagem', "Senha Alterada");
    }

    public function clienteIndex(){
        return view('login/clienteLogin');
    }

    public function clienteAutenticar(Request $request){
        //$dados = $request->validate([
        //    'email' => ['required', 'email'],
        //    'password' => ['required'],
        //]);
        $email = $request->get('email');
        $password = bcrypt($request->get('password'));

        $cliente = Cliente::where('dsEmail', $email)->first();

        if($cliente){
            $request->session()->put('cliente', $cliente);

            return redirect()->route('cliente.dashboard');
        }
        else{
          return redirect()->back()->with('erro', "Email ou senha inválidos");
        }
    }

    public function clienteEsqueceuSenha(){
        return view('login/clienteEsqueceuSenha');
    }

    public function clienteRecuperarSenha(Request $request){
        $email = $request->email;

        //echo $email;
        $cliente = Cliente::where('dsEmail', $email)->first();

        if($cliente){
            $novaSenha = createPassword(8, true, true, true, false);

            $cliente->password = bcrypt($novaSenha);

            $cliente->save();

            $config = buscaDadosConfig();

            $mensagem = $config->dsMensagemSenha;

            $mensagem = str_replace('%Link%', config('constantes.URL_LOGIN_CLIENTE'), $mensagem);
            $mensagem = str_replace('%User%', $cliente->dsEmail, $mensagem);
            $mensagem = str_replace('%Password%', $novaSenha, $mensagem);
            $mensagem = str_replace('%Name%', $cliente->nmCliente, $mensagem);
            $mensagem = str_replace('%NameSystem%', $config->nmSistema, $mensagem);
            $mensagem = str_replace('%DescriptionSystem%', $config->dsTitulo, $mensagem);

            enviarMail($cliente->dsEmail, 'Nova Senha de Acesso', $mensagem);

            return redirect()->route('cliente.login')->with('mensagem','Sua nova senha foi enviado para o seu email.');
        }
        else{
            return redirect()->back()->with('mensagem', "Email Inválido");
        }
    }

    public function clienteLogout(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('cliente.login');
    }

}
