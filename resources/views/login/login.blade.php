@php
$config = buscaDadosConfig();
$logoSistema = "/public/img/".$config->logo;
@endphp
@extends('login.layout')

@section('conteudo')
<div class="card-body mt-2">
  <h4 class="mb-2">Bem Vindo ao {{ $config->nmSistema }}! 👋</h4>
  <p class="mb-4">{{ $config->dsTitulo }}</p>
  @if($mensagem = Session::get('erro'))
      <div class="alert alert-solid-danger" role="alert">
          {{ $mensagem }}
      </div>
  @endif
  @if($mensagem = Session::get('mensagem'))
      <div class="alert alert-solid-success" role="alert">
          {{ $mensagem }}
      </div>
  @endif
  <form id="formAuthentication" class="mb-3" action="/autenticar" method="POST">
    @csrf
    <div class="form-floating form-floating-outline mb-3">
      <input type="email" class="form-control" id="email" name="email" placeholder="Email" autofocus />
      <label for="email">Email</label>
    </div>
    <div class="mb-3">
      <div class="form-password-toggle">
        <div class="input-group input-group-merge">
          <div class="form-floating form-floating-outline">
            <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="Senha" />
            <label for="password">Senha</label>
          </div>
          <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
        </div>
      </div>
    </div>
    <div class="mb-3 d-flex justify-content-between">
      <a href="/esqueceuSenha" class="float-end mb-1">
        <span>Esqueceu a Senha?</span>
      </a>
    </div>
    <div class="mb-3">
      <button class="btn btn-primary d-grid w-100" type="submit">Entrar</button>
    </div>
  </form>
</div>
@endsection
