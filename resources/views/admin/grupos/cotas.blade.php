@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h5 class="card-title">Cotistas Grupo: {{ $grupo->nrGrupo }} do {{ $grupo->nmBanco }}. Valor Carta: R$ {{ valorDbForm($grupo->vlCarta) }}</h5>
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
                                    <th>Cliente</th>
                                    <th>CPF</th>
                                    <th>Email</th>
                                    <th>Tel/Cel</th>
                                    <th>Data da Venda</th>
                                    <th>Numero de Parcelas</th>
                                    <th>Situação</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @foreach($cotistas as $cota)
                              <tr>
                                  <td class='text-center'>{{ $cota->nmCliente }}</td>
                                  <td class='text-center'>{{ $cota->nrCpf }}</td>
                                  <td class='text-center'>{{ $cota->dsEmail }}</td>
                                  <td class='text-center'>{{ $cota->nrTel }} / {{ $cota->nrCel }}</td>
                                  <td class='text-center'>{{ dataDbForm($cota->dtVenda) }}</td>
                                  <td class='text-center'>{{ $cota->nrParcelas }}</td>
                                  <td class='text-center'>{{ $cota->stVenda }}</td>
                                  <td>
                                      <div class="dropdown">
                                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                              <i class="mdi mdi-dots-vertical"></i>
                                          </button>
                                          <div class="dropdown-menu" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-101.111px, 134.444px);">
                                              @if($cota->stVenda == "Aberta")
                                                  <a class="dropdown-item waves-effect" href="{{ route('grupoCotasContemplar', $cota->id) }}"><i class="mdi mdi-hand-clap me-1"></i> Contemplar</a>
                                              @endif
                                              @if($cota->stVenda == "Aberta" || $cota->stVenda == "Contemplada")
                                                  <a class="dropdown-item waves-effect" href="{{ route('grupoCotasResgatar', $cota->id) }}"><i class="mdi mdi-chevron-down-circle-outline me-1"></i> Regatar</a>
                                              @endif
                                              <a class="dropdown-item waves-effect" href="{{ route('vendaVisualizar', $cota->id) }}"><i class="mdi mdi-eye-outline me-1"></i> Visualizar</a>
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
