@extends('acessoCliente.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Chamadas</h5>
                </div>
                <div class="col-md-6" align='right'>
                    <a href="{{ route('cliente.chamadas.adicionar')}}" class="dt-button add-new btn btn-primary" type="button">
                      <span>
                        <i class="mdi mdi-plus me-0 me-sm-1"></i>
                        <span class="d-none d-sm-inline-block">Add Chamada</span>
                      </span>
                    </a>
                </div>
            </div>
            @if($mensagem = Session::get('mensagem'))
              <div class="alert alert-success alert-dismissible" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="tabela-index display" id="table-index">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Data</th>
                                    <th>Descrição</th>
                                    <th>Visualização</th>
                                    <th>Situação</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @foreach($chamadas as $chamada)
                              @php
                              $var = explode(' ', $chamada->dtHrChamada);
                              $dtHrChamada = dataDbForm($var[0])." ".$var[1];
                              @endphp
                              <tr>
                                  <td>@if($chamada->dsVisualizarCliente == 'Não') <span class="start-50 translate-middle-y badge badge-dot bg-danger mt-2 border"></span> @endif</td>
                                  <td><span style='display:none'>{{ strtotime($chamada->dtHrChamada) }}</span>{{ $dtHrChamada }}</td>
                                  <td>{{ $chamada->dsChamada }}</td>
                                  <td>{{ $chamada->dsVisualizarCliente }}</td>
                                  <td>{{ $chamada->stChamada }}</td>
                                  <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-dots-vertical"></i>
                                      </button>
                                      <div class="dropdown-menu" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-101.111px, 134.444px);">
                                        <a class="dropdown-item waves-effect" href="{{ route('cliente.chamadas.acessar', $chamada->id) }}"><i class="mdi mdi-eye-outline me-1"></i> Acessar</a>
                                      </div>
                                    </div>
                                  </td>
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
  $('#table-index').DataTable({
    order: [[1, 'desc']],
    "language": {
			"sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "_MENU_ resultados por página",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "Pesquisar",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    }
  });
})

</script>

@endsection
