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
                    <h5 class="card-title">Relatório de Clientes</h5>
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
                                    <th>Nome</th>
                                    <th>Cpf</th>
                                    <th>Rg</th>
                                    <th>Email</th>
                                    <th>Tel</th>
                                    <th>Cel</th>
                                    <th>Cidade</th>
                                    <th>Uf</th>
                                </tr>
                            </thead>
                            @if(count($clientes) == 0)
                                <tr>
                                    <td colspan="8" class='text-center'>Não foram encontrados resultados para a pesquisa</td>
                                </tr>
                            @endif
                            @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $cliente->nmCliente }}</td>
                                    <td>{{ $cliente->nrCpf }}</td>
                                    <td>{{ $cliente->nrRg }}</td>
                                    <td>{{ $cliente->dsEmail }}</td>
                                    <td>{{ $cliente->nrTel }}</td>
                                    <td>{{ $cliente->nrCel }}</td>
                                    <td>{{ $cliente->nmCidade }}</td>
                                    <td>{{ $cliente->dsUf }}</td>
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
