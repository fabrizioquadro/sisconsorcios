@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Excluir Arquivo do Cliente</h5>
                </div>
            </div>
            <form action="{{ route('clienteExcluirArquivoSql') }}" method="post">
              <input type="hidden" name="id" value="{{ $arquivo->id }}">
              @csrf
              <div class="row mt-2 gy-4">
                <p>Tem certeza que deseja excluir o arquivo {{ $arquivo->nmArquivo }}?</p>
              </div>
              <div class="mt-4">
                  <button type="submit" class="btn btn-danger me-2">Excluir</button>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
