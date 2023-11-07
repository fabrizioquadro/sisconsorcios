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
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Reajustes</h5>
                            @if($qtReajustes == 0)
                                <p>Não há reajustes para este grupo</p>
                            @else
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>Data de Aniversário</th>
                                          <th>Reajuste</th>
                                          <th>Valor Carta</th>
                                          <th>Valor Parcelas</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($reajustes as $reajuste)
                                        <tr>
                                            <td>{{ dataDbForm($reajuste->dtAniversario) }}</td>
                                            <td>{{ $reajuste->txReajuste }}</td>
                                            <td>R$ {{ valorDbForm($reajuste->vlReajusteCarta) }}</td>
                                            <td>R$ {{ valorDbForm($reajuste->vlReajusteParcela) }}</td>
                                        </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                            @endif
                        </div>
                    </div>
                    <form action="{{ route('grupoCotas.reajustar.calcular') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_grupo" value="{{ $grupo->id }}">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">Reajuste</h5>
                                <div class="row align-items-end">
                                  <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                      <input required class="form-control" type="text" id="txReajuste" name="txReajuste" placeholder="Taxa de Reajuste" />
                                      <label for="txReajuste">Taxa de Reajuste:</label>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                      <button type="submit" class='btn btn-primary'>Próximo</button>
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
<script>
document.getElementById('txReajuste').addEventListener('blur', (e)=>{
    valor = e.target.value;
    valor = valor.replace(',','.');

    if(isNaN(valor)){
        alert('Taxa inválida');
        document.getElementById('txReajuste').value = "";
        document.getElementById('txReajuste').focus();
    }

})
</script>
@endsection
