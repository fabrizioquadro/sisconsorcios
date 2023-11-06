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
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="card-title">Parcelas</h5>
                        </div>
                        <div class="col-md-6" align='right'>
                            <a href="{{ route('vendaAddParcela', $venda->id) }}" class='btn btn-sm btn-primary'>Adicionar Parcela</a>
                        </div>
                    </div>
                    @if($mensagem = Session::get('mensagem'))
                      <div class="alert alert-success alert-dismissible" role="alert">
                        {{ $mensagem }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                    <table class="table table-sm mt-3">
                        <thead>
                            <tr>
                                <th>Parcela</th>
                                <th>Data</th>
                                <th>Valor</th>
                                <th>Situação</th>
                                <th>Data Pagamento</th>
                                <th>Valor Pagamento</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($parcelas as $parcela)
                                @php
                                if($parcela->stParcela == "Paga"){
                                    $dtPagamento = dataDbForm($parcela->dtPagamento);
                                    $vlPagamento = 'R$ '.valorDbForm($parcela->vlPagamento);
                                }
                                else{
                                  $dtPagamento = '';
                                  $vlPagamento = '';
                                }
                                @endphp
                                <tr>
                                    <td>{{ $parcela->nrParcela }}</td>
                                    <td>{{ dataDbForm($parcela->dtParcela) }}</td>
                                    <td>R$ {{ valorDbForm($parcela->vlParcela) }}</td>
                                    <td>{{ $parcela->stParcela }}</td>
                                    <td>{{ $dtPagamento }}</td>
                                    <td>{{ $vlPagamento }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-101.111px, 134.444px);">
                                                @if($parcela->stParcela == 'Aberta')
                                                    <a class="dropdown-item waves-effect" href="{{ route('vendaPagarParcela', $parcela->id) }}"><i class="mdi mdi-currency-usd me-1"></i> Pagar</a>
                                                @else
                                                    <a class="dropdown-item waves-effect" href="{{ route('vendaDesfazerPgtParcela', $parcela->id) }}"><i class="mdi mdi-cash-refund me-1"></i> Desfazer Pgt</a>
                                                @endif
                                                <a class="dropdown-item waves-effect" href="{{ route('vendaExcluirParcela', $parcela->id) }}"><i class="mdi mdi-trash-can-outline me-1"></i> Excluir</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
