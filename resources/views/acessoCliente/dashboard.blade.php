@extends('acessoCliente.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">Dashboard</h4>
    <div class="row">
      <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card card-border-shadow-danger h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-2 pb-1">
              <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-danger">
                  <i class="mdi mdi-account-cash mdi-20px"></i>
                </span>
              </div>
              <h4 class="ms-1 mb-0 display-6" style='margin-right: 10px'>{{ $qtVendas }}</h4>
              <p class="mb-0 text-heading">Cotas</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card card-border-shadow-success h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-2 pb-1">
              <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-success">
                  <i class="mdi mdi-hand-clap mdi-20px"></i></span>
              </div>
              <h4 class="ms-1 mb-0 display-6" style='margin-right: 10px'>{{ $qtContempladas }}</h4>
              <p class="mb-0 text-heading">Cotas Contempladas</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card card-border-shadow-secondary h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-2 pb-1">
              <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-secondary">
                  <i class="mdi mdi-chevron-down-circle-outline mdi-20px"></i></span>
              </div>
              <h4 class="ms-1 mb-0 display-6" style='margin-right: 10px'>{{ $qtResgatadas }}</h4>
              <p class="mb-0 text-heading">Cotas Resgatadas</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    @if($chamadas->count() > 0)
        <div class="card card-border-shadow-info">
            <div class="card-body">
                <h5 class="card-title">Chamadas não visualizados</h5>
                <div class="table-responsive">
                    <table class='table'>
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
                        <tbody>
                            @foreach($chamadas as $chamada)
                              @php
                              $var = explode(' ', $chamada->dtHrChamada);
                              $dtHrChamada = dataDbForm($var[0])." ".$var[1];
                              @endphp
                              <tr>
                                  <td>{{ $dtHrChamada }}</td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    <div class="card card-border-shadow-warning mt-3">
        <div class="card-body">
            <h5 class="card-title">Próximas Parcelas</h5>
            <div class="table-responsive">
                <table class='table'>
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Banco Consórcio</th>
                            <th>Nr Parcela</th>
                            <th>Valor</th>
                            <th>Situação</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parcelas as $parcela)
                            <tr>
                                <td>{{ dataDbForm($parcela->dtParcela) }}</td>
                                <td>{{ getBancoNrGrupoVenda($parcela->id_venda) }}</td>
                                <td>{{ $parcela->nrParcela }}</td>
                                <td>{{ valorDbForm($parcela->vlParcela) }}</td>
                                <td>{{ $parcela->stParcela }}</td>
                                <td>
                                    @if($parcela->stParcela == "Aberta")
                                        <a href="{{ route('cliente.gerarBoleto', $parcela->id) }}" target='_blank' class='btn btn-sm btn-primary'>Pagar</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
