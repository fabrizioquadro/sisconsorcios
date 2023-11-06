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
                    <h5 class="card-title">Relatório de Grupos</h5>
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
                                    <th>Grupo</th>
                                    <th>Banco</th>
                                    <th>Prazo</th>
                                    <th>Valor Carta Original</th>
                                    <th>Valor Carta Atual</th>
                                    <th>Taxa Admin</th>
                                    <th>Data Inicio</th>
                                    <th>Aniversário</th>
                                    <th>Cotas Abertas</th>
                                    <th>Cotas Contempladas</th>
                                    <th>Cotas Resgatadas</th>
                                    <th>Situação</th>
                                </tr>
                            </thead>
                            @if(count($grupos) == 0)
                                <tr>
                                    <td colspan="8" class='text-center'>Não foram encontrados resultados para a pesquisa</td>
                                </tr>
                            @endif
                            @foreach($grupos as $grupo)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $grupo->nrGrupo }}</td>
                                    <td>{{ $grupo->nmBanco }}</td>
                                    <td>{{ $grupo->nrPrazo }}</td>
                                    <td>R$ {{ valorDbForm($grupo->vlCartaOriginal) }}</td>
                                    <td>R$ {{ valorDbForm($grupo->vlCarta) }}</td>
                                    <td>{{ $grupo->txAdmin }}%</td>
                                    <td>{{ dataDbForm($grupo->dtInicio) }}</td>
                                    <td>{{ dataDbForm($grupo->dtProxAniversario) }}</td>
                                    <td>{{ $grupo->nrAbertos }}</td>
                                    <td>{{ $grupo->nrContemplados }}</td>
                                    <td>{{ $grupo->nrResgatados }}</td>
                                    <td>{{ $grupo->stGrupo }}</td>
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
