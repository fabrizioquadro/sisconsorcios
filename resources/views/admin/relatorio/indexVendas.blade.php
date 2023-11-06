@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Relatório de Vendas</h5>
                </div>
            </div>
            <form action="{{ route('relatorios.vendas.pesquisar') }}" method="post" enctype="multipart/form-data">
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
                    <div class="col-md-2">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dtInc" name="dtInc" placeholder="Data início da Venda:"/>
                            <label for="dtInc">Data início da Venda:</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dtFn" name="dtFn" placeholder="Data final da Venda:"/>
                            <label for="dtFn">Data final da Venda:</label>
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
