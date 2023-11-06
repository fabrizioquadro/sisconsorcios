@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Visualizar Venda</h5>
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
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <form  method="post" action="{{ route('vendaInsertParcela') }}">
                        @csrf
                        <input type="hidden" name="id_venda" value="{{ $venda->id }}">
                        <h5 class="card-title">Parcela</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input required class="form-control" type="number" id="nrParcela" name="nrParcela" placeholder="Parcela Numero"/>
                                    <label for="nrParcela">Parcela Numero:</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input required class="form-control" type="date" id="dtParcela" name="dtParcela" placeholder="Data Parcela"/>
                                    <label for="dtParcela">Data Parcela:</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-floating form-floating-outline">
                                <input required class="form-control" type="text" id="vlParcela" name="vlParcela" placeholder="Valor da Parcela" onkeypress="return(MascaraMoeda(this,'.',',',event))" />
                                <label for="vlParcela">Valor da Parcela:</label>
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
