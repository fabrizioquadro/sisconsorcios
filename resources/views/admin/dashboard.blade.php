@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4">Dashboard</h4>
    <div class="row">
      <div class="col-sm-6 col-lg-2 mb-4">
        <div class="card card-border-shadow-primary h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-2 pb-1">
              <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-primary"><i class="mdi mdi-consolidate mdi-20px"></i></span>
              </div>
              <h4 class="ms-1 mb-0 display-6">{{ $qtGruposAtivos }}</h4>
            </div>
            <p class="mb-0 text-heading">Grupos Ativos</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-2 mb-4">
        <div class="card card-border-shadow-warning h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-2 pb-1">
              <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-warning">
                  <i class="mdi mdi-account-group mdi-20px"></i></span>
              </div>
              <h4 class="ms-1 mb-0 display-6">{{ $qtClientes }}</h4>
            </div>
            <p class="mb-0 text-heading">Clientes</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-2 mb-4">
        <div class="card card-border-shadow-danger h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-2 pb-1">
              <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-danger">
                  <i class="mdi mdi-account-cash mdi-20px"></i>
                </span>
              </div>
              <h4 class="ms-1 mb-0 display-6">{{ $qtVendas }}</h4>
            </div>
            <p class="mb-0 text-heading">Vendas</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-2 mb-4">
        <div class="card card-border-shadow-info h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-2 pb-1">
              <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-info">
                  <i class="mdi mdi-text-box-outline mdi-20px"></i></span>
              </div>
              <h4 class="ms-1 mb-0 display-6">{{ $qtAbertas }}</h4>
            </div>
            <p class="mb-0 text-heading">Cotas Abertas</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-2 mb-4">
        <div class="card card-border-shadow-success h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-2 pb-1">
              <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-success">
                  <i class="mdi mdi-hand-clap mdi-20px"></i></span>
              </div>
              <h4 class="ms-1 mb-0 display-6">{{ $qtContempladas }}</h4>
            </div>
            <p class="mb-0 text-heading">Cotas Contempladas</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-2 mb-4">
        <div class="card card-border-shadow-secondary h-100">
          <div class="card-body">
            <div class="d-flex align-items-center mb-2 pb-1">
              <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-secondary">
                  <i class="mdi mdi-chevron-down-circle-outline mdi-20px"></i></span>
              </div>
              <h4 class="ms-1 mb-0 display-6">{{ $qtResgatadas }}</h4>
            </div>
            <p class="mb-0 text-heading">Cotas Resgatadas</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card card-border-shadow-danger h-100">
                <div class="card-body">
                    <h5 class="card-title">Cotas Atrasadas</h5>
                    <div class="table-responsive" style='height: 200px !important'>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Vencimento</th>
                                    <th>Cliente</th>
                                    <th>Grupo</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($parcelasAtrasadas->count() == 0)
                                    <tr>
                                        <td colspan='4' class="text-center">Não há parcelas atrasadas.</td>
                                    </tr>
                                @endif
                                @foreach($parcelasAtrasadas as $parcela)
                                    <tr>
                                        <td>{{ dataDbForm($parcela->dtParcela) }}</td>
                                        <td>{{ $parcela->nmCliente }}</td>
                                        <td>{{ $parcela->nrGrupo }} / {{ $parcela->nmBanco }}</td>
                                        <td>{{ valorDbForm($parcela->vlParcela) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-border-shadow-success h-50">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar me-3">
                            <div class="avatar-initial bg-label-success rounded">
                                <i class="mdi mdi-currency-usd mdi-24px"> </i>
                            </div>
                        </div>
                        <div class="card-info">
                            <div class="d-flex align-items-center">
                                <h4 class="mb-0">R$ {{ valorDbform($vlEntradaParcelas) }}</h4>
                            </div>
                            <small>Valores recebidos nos últimos 7 dias</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card  card-border-shadow-info h-50">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar me-3">
                            <div class="avatar-initial bg-label-info rounded">
                                <i class="mdi mdi-trending-up mdi-24px"> </i>
                            </div>
                        </div>
                        <div class="card-info">
                            <div class="d-flex align-items-center">
                                <h4 class="mb-0">R$ {{ valorDbform($vlPrevisaoParcelas) }}</h4>
                            </div>
                            <small>Previsão de valores a receber nos próximos 7 dias</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-border-shadow-warning">
                <div class="card-body">
                    <h5 class="card-title">Grupos que estão com reajuste atrasados ou que vencerão nos próximos 60 dias</h5>
                    <div class="table-responsive" style='max-height: 200px !important'>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Grupo</th>
                                    <th>Banco</th>
                                    <th>Início</th>
                                    <th>Aniversário</th>
                                    <th>Prazo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($gruposAniversario->count() == 0)
                                    <tr>
                                        <td colspan='6' class="text-center">Não há grupos atrasados ou vencendo para reajuste.</td>
                                    </tr>
                                @endif
                                @foreach($gruposAniversario as $grupo)
                                    @if(testaProximoAniversarioGrupo($grupo->id))
                                        <tr>
                                            <td>{{ $grupo->nrGrupo }}</td>
                                            <td>{{ $grupo->nmBanco }}</td>
                                            <td>{{ dataDbForm($grupo->dtInicio) }}</td>
                                            <td>{{ dataDbForm($grupo->dtProxAniversario) }}</td>
                                            <td>{{ $grupo->nrPrazo }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-101.111px, 134.444px);">
                                                        <a class="dropdown-item waves-effect" href="{{ route('grupoCotas.reajustar', $grupo->id) }}"><i class="mdi mdi-adjust me-1"></i> Reajuste Anual</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
