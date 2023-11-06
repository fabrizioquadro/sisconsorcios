@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <form action="{{ route('vendaInsert') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_grupo" value="{{ $dados['id_grupo'] }}">
        <input type="hidden" name="id_cliente" value="{{ $dados['id_cliente'] }}">
        <input type="hidden" name="nrParcelas" value="{{ $dados['nrParcelas'] }}">
        <input type="hidden" name="dtVenda" value="{{ $dados['dtVenda'] }}">
        <input type="hidden" name="dsObs" value="{{ $dados['dsObs'] }}">
        <input type="hidden" name="vlCarta" value="{{ $dados['vlCarta'] }}">
        <input type="hidden" name="vlAdm" value="{{ $dados['vlAdm'] }}">
        <input type="hidden" name="vlTotal" value="{{ $dados['vlTotal'] }}">
        <input type="hidden" name="vlParcela" value="{{ $dados['vlParcela'] }}">
        <input type="hidden" name="inicioPagamento" value="{{ $dados['inicioPagamento'] }}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">Venda Dados e Parcelas</h5>
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
                                <span>R$ {{ valorDbForm($dados['vlCarta']) }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <span class="fw-medium">Taxa Adm:</span><br>
                                <span>{{ $grupo->txAdmin }} %</span>
                            </div>
                            <div class="col-md-4 mt-3">
                                <span class="fw-medium">Valor Adm:</span><br>
                                <span>R$ {{ valorDbForm($dados['vlAdm']) }}</span>
                            </div>
                            <div class="col-md-4 mt-3">
                                <span class="fw-medium">Valor Total:</span><br>
                                <span>R$ {{ valorDbForm($dados['vlTotal']) }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <span class="fw-medium">Início Consórcio:</span><br>
                                <span>{{ dataDbform($grupo['dtInicio']) }}</span>
                            </div>
                            <div class="col-md-3 mt-3">
                                <span class="fw-medium">Data Venda:</span><br>
                                <span>{{ dataDbform($dados['dtVenda']) }}</span>
                            </div>
                            <div class="col-md-3 mt-3">
                                <span class="fw-medium">Nº Parcelas:</span><br>
                                <span>{{ $dados['nrParcelas'] }}</span>
                            </div>
                            <div class="col-md-3 mt-3">
                                <span class="fw-medium">Valor Parcelas:</span><br>
                                <span>R$ {{ valorDbForm($dados['vlParcela']) }}</span>
                            </div>
                        </div>
                        @if($dados['dsObs'] != "")
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                  <span class="fw-medium">Observação:</span><br>
                                  <span>{{ $dados['dsObs'] }}</span>
                                </div>
                            </div>
                        @endif
                        <div class="card mt-4">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="file" id="imagens" name="imagens[]" multiple/>
                                            <label for="imagens">Arquivos da Venda:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6" align='right'>
                                        <button type="submit" class='btn btn-primary'>Finalizar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">Parcelas</h5>
                            </div>
                        </div>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Parcela</th>
                                    <th>Data</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($arrayParcelas as $parcela)
                                    <tr>
                                        <td>{{ $parcela[0] }}</td>
                                        <td>{{ dataDbForm($parcela[1]) }}</td>
                                        <td>R$ {{ valorDbForm($parcela[2]) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
window.addEventListener('load',()=>{
    $(".select2").select2();
});

</script>
@endsection
