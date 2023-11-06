@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Adicionar Grupo</h5>
                </div>
            </div>
            <form action="{{ route('grupoAdd') }}" method="post">
              @csrf
              <div class="row mt-2 gy-4">
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nmBanco" name="nmBanco" placeholder="Banco"/>
                    <label for="nmBanco">Banco:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nrGrupo" name="nrGrupo" placeholder="Numero do Grupo" />
                    <label for="nrGrupo">Numero do Grupo:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="number" id="nrPrazo" name="nrPrazo" placeholder="Prazo do Consórcio" />
                    <label for="nrPrazo">Prazo do Consórcio:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="vlCarta" name="vlCarta" placeholder="Valor da Carta" onkeypress="return(MascaraMoeda(this,'.',',',event))" />
                    <label for="vlCarta">Valor da Carta:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="txAdmin" name="txAdmin" placeholder="Taxa Administração" />
                    <label for="txAdmin">Taxa Administração:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="date" id="dtInicio" name="dtInicio" placeholder="Início" />
                    <label for="dtInicio">Início:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <select required id="stGrupo" name='stGrupo' class="select2 form-select">
                      <option value="">Opções</option>
                      <option value="Ativo">Ativo</option>
                      <option value="Inativo">Inativo</option>
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
@endsection
