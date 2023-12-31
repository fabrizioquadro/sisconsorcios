@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Editar Grupo</h5>
                </div>
            </div>
            @if($mensagem)
              <div class="alert alert-warning alert-dismissible" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <form action="{{ route('grupoUpdate') }}" method="post">
              <input type="hidden" name="id" value="{{ $grupo->id }}">
              @csrf
              <div class="row mt-2 gy-4">
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nmBanco" name="nmBanco" placeholder="Banco" value="{{ $grupo->nmBanco }}"/>
                    <label for="nmBanco">Banco:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nrGrupo" name="nrGrupo" placeholder="Numero do Grupo" value="{{ $grupo->nrGrupo }}"/>
                    <label for="nrGrupo">Numero do Grupo:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" min="1" type="number" id="nrPrazo" name="nrPrazo" placeholder="Prazo do Consórcio" value="{{ $grupo->nrPrazo }}"/>
                    <label for="nrPrazo">Prazo do Consórcio:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="vlCarta" name="vlCarta" placeholder="Valor da Carta" onkeypress="return(MascaraMoeda(this,'.',',',event))" value="{{ valorDbForm($grupo->vlCarta) }}"/>
                    <label for="vlCarta">Valor da Carta:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="txAdmin" name="txAdmin" placeholder="Taxa Administração" value="{{ $grupo->txAdmin }}"/>
                    <label for="txAdmin">Taxa Administração:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="date" id="dtInicio" name="dtInicio" placeholder="Início" value="{{ $grupo->dtInicio }}"/>
                    <label for="dtInicio">Início:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <select required id="stGrupo" name='stGrupo' class="select2 form-select">
                      <option value="">Opções</option>
                      <option @php if($grupo->stGrupo == "Ativo"){ echo "selected"; } @endphp value="Ativo">Ativo</option>
                      <option @php if($grupo->stGrupo == "Inativo"){ echo "selected"; } @endphp value="Inativo">Inativo</option>
                    </select>
                    <label for="type">Situação:</label>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                  <button type="submit" class="btn btn-primary me-2">Salvar</button>
              </div>
            </form>
        </div>
    </div>
</div>
<script>
document.getElementById('txAdmin').addEventListener('blur', (e)=>{
    valor = e.target.value;
    valor = valor.replace(',','.');

    if(isNaN(valor)){
        alert('Taxa inválida');
        document.getElementById('txAdmin').value = "";
        document.getElementById('txAdmin').focus();
    }

})
</script>
@endsection
