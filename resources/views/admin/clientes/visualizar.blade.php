@extends('admin.layout')

@section('conteudo')
@php
if($cliente->imagem != ""){
    $avatar = "/public/img/clientes/$cliente->imagem";
}
elseif($cliente->dsGenero == "Masculino"){
    $avatar = "/public/materialize/img/avatars/1.png";
}
else{
    $avatar = "/public/materialize/img/avatars/2.png";
}
@endphp
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
              <img
                src='{{ asset("$avatar") }}'
                alt="user-avatar"
                class="d-block w-px-120 h-px-120 rounded"
                id="uploadedAvatar" />
              <div class="button-wrapper">
                <h4 class="card-header">Visualizar Cliente</h4>
              </div>
            </div>
          </div>
          <div class="card-body pt-2 mt-1">
              <div class="row mt-2 gy-4">
                  <div class="col-md-6">
                      <span class="fw-medium">Nome:</span><br>
                      <span>{{ $cliente->nmCliente }}</span>
                  </div>
                  <div class="col-md-3">
                      <span class="fw-medium">CPF:</span><br>
                      <span>{{ $cliente->nrCpf }}</span>
                  </div>
                  <div class="col-md-3">
                      <span class="fw-medium">RG:</span><br>
                      <span>{{ $cliente->nrRg }}</span>
                  </div>
              </div>
              <div class="row mt-2 gy-4">
                  <div class="col-md-6">
                      <span class="fw-medium">Genero:</span><br>
                      <span>{{ $cliente->dsGenero }}</span>
                  </div>
                  <div class="col-md-6">
                      <span class="fw-medium">Email:</span><br>
                      <span>{{ $cliente->dsEmail }}</span>
                  </div>
              </div>
              <div class="row mt-2 gy-4">
                  <div class="col-md-4">
                      <span class="fw-medium">Telefone:</span><br>
                      <span>{{ $cliente->nrTel }}</span>
                  </div>
                  <div class="col-md-4">
                      <span class="fw-medium">Celular:</span><br>
                      <span>{{ $cliente->nrCel }}</span>
                  </div>
                  <div class="col-md-4">
                      <span class="fw-medium">CEP:</span><br>
                      <span>{{ $cliente->nrCep }}</span>
                  </div>
              </div>
              <div class="row mt-2 gy-4">
                  <div class="col-md-6">
                      <span class="fw-medium">Endereço:</span><br>
                      <span>{{ $cliente->dsEndereco }}</span>
                  </div>
                  <div class="col-md-3">
                      <span class="fw-medium">Numero:</span><br>
                      <span>{{ $cliente->nrEndereco }}</span>
                  </div>
                  <div class="col-md-3">
                      <span class="fw-medium">Complemento:</span><br>
                      <span>{{ $cliente->dsComplemento }}</span>
                  </div>
              </div>
              <div class="row mt-2 gy-4">
                  <div class="col-md-4">
                      <span class="fw-medium">Bairro:</span><br>
                      <span>{{ $cliente->dsBairro }}</span>
                  </div>
                  <div class="col-md-4">
                      <span class="fw-medium">Cidade:</span><br>
                      <span>{{ $cliente->nmCidade }}</span>
                  </div>
                  <div class="col-md-4">
                      <span class="fw-medium">UF:</span><br>
                      <span>{{ $cliente->dsUf }}</span>
                  </div>
              </div>
              <div class="card mt-5">
                  <div class="card-body">
                      <h5 class='card-title'>Arquivos do Cliente</h5>
                      <div class="row">
                          @foreach($arquivos as $arquivo)
                              <div class="col-md-3 col-sm-6 mt-3">
                                  <a href='{{ asset("/public/img/clientes/arquivos/$arquivo->arquivo") }}' target='_blank'>
                                      <div class="card">
                                          <div class="card-body" align='center'>
                                              <span class="avatar-initial rounded bg-label-secondary">
                                                  <i class="mdi mdi-file-document-outline mdi-24px"></i>
                                              </span>
                                              <p class='text-center'>{{ $arquivo->nmArquivo }}</p>
                                          </div>
                                      </div>
                                  </a>
                              </div>
                          @endforeach
                      </div>
                  </div>
              </div>
          </div>
          <!-- /Account -->
        </div>
      </div>
    </div>
</div>
@endsection
