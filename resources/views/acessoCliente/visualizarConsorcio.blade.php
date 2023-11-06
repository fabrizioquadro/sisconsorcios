@extends('acessoCliente.layout')

@section('conteudo')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Visualizar Cota de Consórcio</h5>
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
            @if($venda->dtContemplacao)
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Dados da Contemplação</h5>
                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <span class="fw-medium">Data Contemplação:</span><br>
                                <span>{{ dataDbForm($venda->dtContemplacao) }}</span>
                            </div>
                            @if($venda->dsContemplacao != "")
                                <div class="col-md-9 mt-3">
                                    <span class="fw-medium">Contemplação:</span><br>
                                    <span>{{ $venda->dsContemplacao }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            @if($venda->dtResgate)
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Dados do Resgate</h5>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <span class="fw-medium">Data Resgate:</span><br>
                                <span>{{ dataDbForm($venda->dtResgate) }}</span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <span class="fw-medium">Valor Resgate:</span><br>
                                <span>R$ {{ valorDbForm($venda->vlResgate) }}</span>
                            </div>
                        </div>
                        @if($venda->dsContemplacao != "")
                            <div class="row">
                                <div class="col-md-9 mt-3">
                                    <span class="fw-medium">Resgate:</span><br>
                                    <span>{{ $venda->dsResgate }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            @if($arqsCliente->count() > 0)
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class='card-title'>Arquivos do Cliente</h5>
                        <div class="row">
                            @foreach($arqsCliente as $arquivo)
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
            @endif
            @if($arqsVenda->count() > 0)
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class='card-title'>Arquivos da Venda</h5>
                        <div class="row">
                            @foreach($arqsVenda as $arquivo)
                                <div class="col-md-3 col-sm-6 mt-3">
                                    <a href='{{ asset("/public/img/vendas/arquivos/$arquivo->arquivo") }}' target='_blank'>
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
            @endif
            @if($arqsContemplacao->count() > 0)
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class='card-title'>Arquivos da Contemplação</h5>
                        <div class="row">
                            @foreach($arqsContemplacao as $arquivo)
                                <div class="col-md-3 col-sm-6 mt-3">
                                    <a href='{{ asset("/public/img/contemplacao/arquivos/$arquivo->arquivo") }}' target='_blank'>
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
            @endif
            @if($arqsResgate->count() > 0)
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class='card-title'>Arquivos do Resgate</h5>
                        <div class="row">
                            @foreach($arqsResgate as $arquivo)
                                <div class="col-md-3 col-sm-6 mt-3">
                                    <a href='{{ asset("/public/img/resgate/arquivos/$arquivo->arquivo") }}' target='_blank'>
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
            @endif
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">Parcelas</h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm">
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
                                        $vlPagamento = valorDbForm($parcela->vlPagamento);
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
                                            @if($parcela->stParcela == "Aberta")
                                                <a href="{{ route('cliente.gerarBoleto', $parcela->id) }}" target='_blank' class='btn btn-sm btn-primary'>Pagar</a>
                                            @endif
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
</div>
@endsection
