@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Editar Usuário</h5>
                </div>
            </div>
            <form action="{{ route('usuarioUpdate') }}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="{{ $usuario->id }}">
              @csrf
              <div class="row mt-2 gy-4">
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="name" name="name" value='{{ $usuario->name }}' placeholder="Nome"/>
                    <label for="name">Nome:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="email" id="email" name="email" placeholder="john.doe@example.com" value='{{ $usuario->email }}' />
                    <label for="email">E-mail:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <select required id="type" name='type' class="select2 form-select">
                      <option value="">Opções</option>
                      <option @if( $usuario->type == 'Administrador' ) selected @endif value="Administrador">Administrador</option>
                      <option @if( $usuario->type == 'Usuário' ) selected @endif value="Usuário">Usuário</option>
                    </select>
                    <label for="type">Tipo de Usuário:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" accept="image/png, image/jpeg, image/jpg" type="file" id="imagem" name="imagem"/>
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
