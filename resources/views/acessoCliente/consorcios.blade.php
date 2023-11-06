@extends('acessoCliente.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-title">Cotas Adquiridas</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Banco/Grupo</th>
                                    <th>Valor da Carta</th>
                                    <th>Nr Parcelas</th>
                                    <th>Situação</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vendas as $venda)
                                    <tr>
                                        <td>{{ dataDbForm($venda->dtVenda) }}</td>
                                        <td>{{ $venda->nmBanco }} - {{ $venda->nrGrupo }}</td>
                                        <td>R$ {{ valorDbForm($venda->vlCarta) }}</td>
                                        <td>{{ $venda->nrParcelas }}</td>
                                        <td>{{ $venda->stVenda }}</td>
                                        <td> <a href="{{ route('cliente.visualizarConsorcio', $venda->id) }}" class='btn btn-sm btn-primary'>Visualizar</a> </td>
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
