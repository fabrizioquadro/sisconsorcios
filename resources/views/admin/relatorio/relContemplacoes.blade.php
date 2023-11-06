@extends('admin.layout')

@section('conteudo')
<form action="{{ route('exportar') }}" id='formulario' target='_blank' method="post">
    @csrf
    <input type="hidden" name="dados" id='dados'>
</form>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Relatório de Contemplados</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" align='right'>
                    <button type="button" id="btnExportar" class="btn btn-sm btn-primary">Exportar</button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="table-responsive" id='divDados'>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th></th>
                                    <td>Data Contemplação</td>
                                    <th>Cliente</th>
                                    <th>Grupo</th>
                                    <th>Situação</th>
                                </tr>
                            </thead>
                            @if(count($contemplacoes) == 0)
                                <tr>
                                    <td colspan="8" class='text-center'>Não foram encontrados resultados para a pesquisa</td>
                                </tr>
                            @endif
                            @foreach($contemplacoes as $linha)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ dataDbForm($linha->dtContemplacao) }}</td>
                                    <td>{{ $linha->nmCliente }}</td>
                                    <td>{{ $linha->nrGrupo }} - {{ $linha->nmBanco }}</td>
                                    <td>{{ $linha->stVenda }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
window.addEventListener('load',()=>{
    $(".select2").select2();
});

document.getElementById('btnExportar').addEventListener('click', ()=>{
    dados = document.getElementById('divDados').innerHTML;
    document.getElementById('dados').value = dados;

    document.getElementById('formulario').submit();
})
</script>
@endsection
