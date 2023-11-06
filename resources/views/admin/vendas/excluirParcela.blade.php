@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Excluir Parcela</h5>
                </div>
            </div>
            <form action="{{ route('vendaDeleteParcela') }}" method="post">
              <input type="hidden" name="id" value="{{ $parcela->id }}">
              @csrf
              <div class="row mt-2 gy-4">
                <p>Tem certeza que deseja excluir a parcela {{ $parcela->nrParcela }} de valor R$ {{ valorDbForm($parcela->vlParcela) }} com vencimento para {{ dataDbForm($parcela->dtParcela) }}  do grupo de consórcio {{ $grupo->nrGrupo }} do cliente {{ $cliente->nmCliente }}?</p>
              </div>
              <div class="mt-4">
                  <button type="submit" class="btn btn-danger me-2">Excluir</button>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
