@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Grupos de Consórcio</h5>
                </div>
                <div class="col-md-6" align='right'>
                    <a href='{{ route('grupoAdd')}}' class="dt-button add-new btn btn-primary" type="button">
                      <span>
                        <i class="mdi mdi-plus me-0 me-sm-1"></i>
                        <span class="d-none d-sm-inline-block">Add Grupo</span>
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
                                    <th>Numero</th>
                                    <th>Banco</th>
                                    <th>Prazo</th>
                                    <th>Crédito</th>
                                    <th>Tx Admin</th>
                                    <th>Início</th>
                                    <th>Aniversário</th>
                                    <th>Abertos</th>
                                    <th>Contemplados</th>
                                    <th>Resgatados</th>
                                    <th>Situação</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @foreach($grupos as $grupo)
                              <tr>
                                  <td class='text-center'>{{ $grupo->nrGrupo }}</td>
                                  <td class='text-center'>{{ $grupo->nmBanco }}</td>
                                  <td class='text-center'>{{ $grupo->nrPrazo }}</td>
                                  <td class='text-center'>{{ valorDbForm($grupo->vlCarta) }}</td>
                                  <td class='text-center'>{{ $grupo->txAdmin }}</td>
                                  <td class='text-center'>{{ dataDbForm($grupo->dtInicio) }}</td>
                                  <td class='text-center'>{{ dataDbForm($grupo->dtProxAniversario) }}</td>
                                  <td class='text-center'>{{ $grupo->nrAbertos }}</td>
                                  <td class='text-center'>{{ $grupo->nrContemplados }}</td>
                                  <td class='text-center'>{{ $grupo->nrResgatados }}</td>
                                  <td class='text-center'>{{ $grupo->stGrupo }}</td>
                                  <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-dots-vertical"></i>
                                      </button>
                                      <div class="dropdown-menu" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-101.111px, 134.444px);">
                                        <a class="dropdown-item waves-effect" href="{{ route('grupoEditar', $grupo->id) }}"><i class="mdi mdi-pencil-outline me-1"></i> Editar</a>
                                        <a class="dropdown-item waves-effect" href="{{ route('grupoExcluir', $grupo->id) }}"><i class="mdi mdi-trash-can-outline me-1"></i> Excluir</a>
                                        <a class="dropdown-item waves-effect" href="{{ route('grupoVisualizar', $grupo->id) }}"><i class="mdi mdi-eye-outline me-1"></i> Visualizar</a>
                                        <a class="dropdown-item waves-effect" href="{{ route('grupoCotas', $grupo->id) }}"><i class="mdi mdi-file-sign me-1"></i> Cotas Vendidas</a>
                                        @if(testaProximoAniversarioGrupo($grupo->id))
                                            <a class="dropdown-item waves-effect" href="{{ route('grupoCotas.reajustar', $grupo->id) }}"><i class="mdi mdi-adjust me-1"></i> Reajuste Anual</a>
                                        @endif
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
    order: [[0, 'asc']],
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
