@extends('acessoCliente.layout')

@section('conteudo')
@php
$var = explode(' ', $chamada->dtHrChamada);
$dtHrChamada = dataDbForm($var[0])." ".$var[1];
$cliente = session()->get('cliente');
@endphp
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            @if($mensagem = Session::get('mensagem'))
              <div class="alert alert-success alert-dismissible" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <h5 class="card-title">Chamada</h5>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="fw-medium">Abertura:</span><br>
                            <span>{{ $dtHrChamada }}</span>
                        </div>
                        <div class="col-md-6">
                            <span class="fw-medium">Situação:</span><br>
                            <span>{{ $chamada->stChamada }}</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <span class="fw-medium">Chamada:</span><br>
                            <span>{{ $chamada->dsChamada }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @if($chamada->stChamada == "Aberta")
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Adicionar Andamento</h5>
                        <form action="{{ route('cliente.chamadas.andamento') }}" method="post">
                            @csrf
                            <input type="hidden" name="id_chamada" value="{{ $chamada->id }}">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                  <div class="form-floating form-floating-outline mb-2">
                                    <textarea required class="form-control h-px-100" id="dsAndamento" name='dsAndamento' placeholder="Alguma observação pertinente ..."></textarea>
                                    <label for="dsAndamento">Andamento:</label>
                                  </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Andamentos</h5>
                    @if($andamentos->count() == 0)
                        <p>Não há andamentos cadastrados para esta chamada</p>
                    @endif
                    @foreach($andamentos as $andamento)
                        @php
                        $var = explode(' ', $andamento->dtHrAndamento);
                        $dtHrAndamento = dataDbForm($var[0])." ".$var[1];
                        if($andamento->dsInsercao == "Cliente"){
                            $autor = $cliente->nmCliente." - ".$dtHrAndamento;
                        }
                        else{
                            $autor = "Administrador - ".$dtHrAndamento;
                        }
                        @endphp
                        <div class="card mt-3">
                            <div class="card-header">
                                {{ $autor }}
                            </div>
                            <div class="card-body">
                                {{ $andamento->dsAndamento }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
