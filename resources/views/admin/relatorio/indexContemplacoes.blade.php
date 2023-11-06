@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Relatório de Contemplados</h5>
                </div>
            </div>
            <form action="{{ route('relatorios.contemplacoes.pesquisar') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mt-2 gy-4">
                    <div class="col-md-6 mb-4">
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
                    <div class="col-md-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dtInc" name="dtInc" placeholder="Data início:"/>
                            <label for="dtVenda">Data início:</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dtFn" name="dtFn" placeholder="Data final:"/>
                            <label for="dtVenda">Data final:</label>
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
