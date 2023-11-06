@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Configuração de mensagens automáticas.</h5>
                </div>
            </div>
            <form action="{{ route('config.mensagens.update') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Mensagens de Recuperação de Senha</h5>
                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select required id="useRecuperarSenha" name='useRecuperarSenha' class="select2 form-select">
                                    <option value="Sim" @if($mensagem->useRecuperarSenha == 'Sim') selected @endif>Sim</option>
                                    <option value="Não" @if($mensagem->useRecuperarSenha == 'Não') selected @endif>Não</option>
                                </select>
                                <label for="useRecuperarSenha">Utilizar:</label>
                            </div>
                          </div>
                      </div>
                      <div class="row mt-3">
                          <div class="col-md-12">
                              <div id="editor"></div>
                          </div>
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
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@endsection
