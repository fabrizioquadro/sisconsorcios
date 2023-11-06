@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Adicionar Venda</h5>
                </div>
            </div>
            <form action="{{ route('vendaAdd') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row mt-2 gy-4">
                <div class="col-md-4 mb-4">
                  <div class="form-floating form-floating-outline">
                    <select required id="id_grupo" name='id_grupo' class="select2 form-select form-select-lg" data-allow-clear="true">
                      <option value=""></option>
                      @foreach($grupos as $grupo)
                          <option value="{{ $grupo->id }}">{{ $grupo->nmBanco }} - {{ $grupo->nrGrupo }} - R$ {{ valorDbForm($grupo->vlCarta) }}</option>
                      @endforeach
                    </select>
                    <label for="id_grupo">Grupo do Consórcio:</label>
                  </div>
                </div>
                <div class="col-md-4 mb-4">
                  <div class="form-floating form-floating-outline">
                    <select required id="id_cliente" name='id_cliente' class="select2 form-select form-select-lg" data-allow-clear="true">
                      <option value=""></option>
                      @foreach($clientes as $cliente)
                          <option value="{{ $cliente->id }}">{{ $cliente->nmCliente }}</option>
                      @endforeach
                    </select>
                    <label for="id_cliente">Cliente:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="date" id="dtVenda" name="dtVenda" placeholder="Data da Venda"/>
                    <label for="dtVenda">Data da Venda:</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating form-floating-outline mb-4">
                    <textarea class="form-control h-px-100" id="dsObs" name='dsObs' placeholder="Alguma observação pertinente ..."></textarea>
                    <label for="dsObs">Observação:</label>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                  <button type="submit" class="btn btn-primary me-2">Próximo</button>
              </div>
            </form>
        </div>
    </div>
</div>
<script>
window.addEventListener('load',()=>{
    $(".select2").select2();
});

</script>
@endsection
