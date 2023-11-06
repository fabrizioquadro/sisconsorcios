@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Cota</h5>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">Dados da Venda</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <span class="fw-medium">Cliente:</span><br>
                            <span>{{ $cliente->nmCliente }}</span>
                        </div>
                        <div class="col-md-4 mt-3">
                            <span class="fw-medium">Grupo:</span><br>
                            <span>{{ $grupo->nmBanco }} - {{ $grupo->nrGrupo }}</span>
                        </div>
                        <div class="col-md-4 mt-3">
                            <span class="fw-medium">Valor Da carta:</span><br>
                            <span>R$ {{ valorDbForm($venda->vlCarta) }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <span class="fw-medium">Taxa Adm:</span><br>
                            <span>{{ $grupo->txAdmin }} %</span>
                        </div>
                        <div class="col-md-4 mt-3">
                            <span class="fw-medium">Valor Adm:</span><br>
                            <span>R$ {{ valorDbForm($venda->vlTotal - $venda->vlCarta) }}</span>
                        </div>
                        <div class="col-md-4 mt-3">
                            <span class="fw-medium">Valor Total:</span><br>
                            <span>R$ {{ valorDbForm($venda->vlTotal) }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <span class="fw-medium">Início Consórcio:</span><br>
                            <span>{{ dataDbform($grupo->dtInicio) }}</span>
                        </div>
                        <div class="col-md-4 mt-3">
                            <span class="fw-medium">Data Venda:</span><br>
                            <span>{{ dataDbform($venda->dtVenda) }}</span>
                        </div>
                        <div class="col-md-4 mt-3">
                            <span class="fw-medium">Nº Parcelas:</span><br>
                            <span>{{ $venda->nrParcelas }}</span>
                        </div>
                    </div>
                    @if($venda->dsObs != "")
                        <div class="row">
                            <div class="col-md-12 mt-3">
                              <span class="fw-medium">Observação:</span><br>
                              <span>{{ $venda->dsObs }}</span>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        @if($venda->dtContemplacao != "")
                            <div class="col-md-3 mt-3">
                                <span class="fw-medium">Data da Contemplação:</span><br>
                                <span>{{ dataDbForm($venda->dtContemplacao) }}</span>
                            </div>
                        @endif
                        @if($venda->dsContemplacao != "")
                            <div class="col-md-9 mt-3">
                                <span class="fw-medium">Contemplação:</span><br>
                                <span>{{ $venda->dsContemplacao }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <form  method="post" action="{{ route('grupoCotasResgatarInsert') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $venda->id }}">
                        <h5 class="card-title">Resgatar</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input required class="form-control" type="date" id="dtResgate" name="dtResgate" placeholder="Data Resgate"/>
                                    <label for="dtResgate">Data Resgate:</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input required class="form-control" type="text" id="vlResgate" name="vlResgate" placeholder="Valor do Resgate" onkeypress="return(MascaraMoeda(this,'.',',',event))" / value='{{ valorDbForm($venda->vlCarta) }}'>
                                    <label for="vlResgate">Valor Resgate:</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="file" id="imagens" name="imagens[]" multiple/>
                                    <label for="imagens">Arquivos da Contemplação:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <div class="form-floating form-floating-outline mb-4">
                                    <textarea class="form-control h-px-100" id="dsResgate" name='dsResgate' placeholder="Alguma observação pertinente ..."></textarea>
                                    <label for="dsResgate">Observação do Resgate:</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
