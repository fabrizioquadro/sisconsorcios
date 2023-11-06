@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Reajuste Anual</h5>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">Dados do Grupo</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            <span class="fw-medium">Banco:</span><br>
                            <span>{{ $grupo->nmBanco }}</span>
                        </div>
                        <div class="col-md-3 mt-3">
                            <span class="fw-medium">Grupo:</span><br>
                            <span>{{ $grupo->nrGrupo }}</span>
                        </div>
                        <div class="col-md-3 mt-3">
                            <span class="fw-medium">Prazo:</span><br>
                            <span>{{ $grupo->nrPrazo }}</span>
                        </div>
                        <div class="col-md-3 mt-3">
                            <span class="fw-medium">Taxa Adm:</span><br>
                            <span>{{ $grupo->txAdmin }} %</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            <span class="fw-medium">Data Início:</span><br>
                            <span>{{ dataDbForm($grupo->dtInicio) }}</span>
                        </div>
                        <div class="col-md-3 mt-3">
                            <span class="fw-medium">Data Próximo Aniversário:</span><br>
                            <span>{{ dataDbForm($grupo->dtProxAniversario) }}</span>
                        </div>
                        <div class="col-md-3 mt-3">
                            <span class="fw-medium">Valor Carta Inicial:</span><br>
                            <span>R$ {{ valorDbForm($grupo->vlCartaOriginal) }}</span>
                        </div>
                        <div class="col-md-3 mt-3">
                            <span class="fw-medium">Valor Carta Atual:</span><br>
                            <span>R$ {{ valorDbForm($grupo->vlCarta) }}</span>
                        </div>
                    </div>
                    <form action="{{ route('grupoCotas.reajustar.insert') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_grupo" value="{{ $grupo->id }}">
                        <input type="hidden" name="txReajuste" value="{{ $txReajuste }}">
                        <input type="hidden" name="vlCartaNova" value="{{ $vlCartaNova }}">
                        <input type="hidden" name="vlParcelaNova" value="{{ $vlParcelaNova }}">
                        <div class="card mt-5">
                            <div class="card-body">
                                <h5 class="card-title">Reajuste</h5>
                                <div class="row align-items-end">
                                  <div class="col-md-4">
                                    <span class="fw-medium">Reajuste:</span><br>
                                    <span>{{ $txReajuste }}%</span>
                                  </div>
                                  <div class="col-md-4">
                                    <span class="fw-medium">Valor Reajustado Carta:</span><br>
                                    <span>R$ {{ valorDbForm($vlCartaNova) }}</span>
                                  </div>
                                  <div class="col-md-4">
                                    <span class="fw-medium">Valor Reajustado Parcela:</span><br>
                                    <span>R$ {{ valorDbForm($vlParcelaNova) }}</span>
                                  </div>
                                </div>
                                <div class="row mt-3">
                                  <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                      <button type="submit" class='btn btn-primary'>Finalizar</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
