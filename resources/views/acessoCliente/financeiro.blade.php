@extends('acessoCliente.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-title">Parcelas</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Banco Consórcio</th>
                                    <th>Nr Parcela</th>
                                    <th>Valor</th>
                                    <th>Situação</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parcelas as $parcela)
                                    <tr>
                                        <td>{{ dataDbForm($parcela->dtParcela) }}</td>
                                        <td>{{ getBancoNrGrupoVenda($parcela->id_venda) }}</td>
                                        <td>{{ $parcela->nrParcela }}</td>
                                        <td>{{ valorDbForm($parcela->vlParcela) }}</td>
                                        <td>{{ $parcela->stParcela }}</td>
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
