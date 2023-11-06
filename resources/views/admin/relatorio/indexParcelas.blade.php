@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Relatório de Parcelas</h5>
                </div>
            </div>
            <form action="{{ route('relatorios.parcelas.pesquisar') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mt-2 gy-4">
                    <div class="col-md-4">
                        <div class="form-floating form-floating-outline">
                            <select id="id_cliente" name='id_cliente' class="select2 form-select form-select-lg" data-allow-clear="true">
                                <option value=""></option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nmCliente }}</option>
                                @endforeach
                            </select>
                            <label for="id_cliente">Cliente:</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="form-floating form-floating-outline">
                            <select id="id_grupo" name='id_grupo' class="select2 form-select form-select-lg" data-allow-clear="true">
                                <option value=""></option>
                                @foreach($grupos as $grupo)
                                    <option value="{{ $grupo->id }}">{{ $grupo->nrGrupo }} - {{ $grupo->nmBanco }} - R$ {{ valorDbForm($grupo->vlCarta) }}</option>
                                @endforeach
                            </select>
                            <label for="id_grupo">Grupo do Consórcio:</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating form-floating-outline">
                          <select id="stParcela" name='stParcela' class="select2 form-select">
                            <option value="">Opções</option>
                            <option value="Aberta">Aberta</option>
                            <option value="Paga">Paga</option>
                          </select>
                          <label for="stParcela">Situação:</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dtInc" name="dtInc" placeholder="Data início da Parcela:"/>
                            <label for="dtInc">Data início da Parcela:</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dtFn" name="dtFn" placeholder="Data final da Parcela:"/>
                            <label for="dtFn">Data final da Parcela:</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dtIncPagamento" name="dtIncPagamento" placeholder="Data início da Pagamento:"/>
                            <label for="dtIncPagamento">Data início da Pagamento:</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dtFnPagamento" name="dtFnPagamento" placeholder="Data final da Pagamento:"/>
                            <label for="dtFnPagamento">Data final da Pagamento:</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">Pesquisar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
window.addEventListener('load',()=>{
    $(".select2").select2();
});

</script>
@endsection
