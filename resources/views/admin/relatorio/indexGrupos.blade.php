@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Relatório de Grupos</h5>
                </div>
            </div>
            <form action="{{ route('relatorios.grupos.pesquisar') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mt-2 gy-4">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dtIncCadastro" name="dtIncCadastro" placeholder="Data início de cadastro:"/>
                            <label for="dtIncCadastro">Data início de cadastro:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dtFnCadastro" name="dtFnCadastro" placeholder="Data final de cadastro:"/>
                            <label for="dtFnCadastro">Data final de cadastro:</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 gy-4">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dtIncOperacao" name="dtIncOperacao" placeholder="Data início de operação:"/>
                            <label for="dtIncOperacao">Data início de operação:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dtFnOperacao" name="dtFnOperacao" placeholder="Data final de operação:"/>
                            <label for="dtFnOperacao">Data final de operação:</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 gy-4">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dtIncAniver" name="dtIncAniver" placeholder="Data início próximo aniversário:"/>
                            <label for="dtIncAniver">Data início próximo aniversário:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input class="form-control" type="date" id="dtFnAniver" name="dtFnAniver" placeholder="Data final próximo aniversário:"/>
                            <label for="dtFnAniver">Data final próximo aniversário:</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 gy-4">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                          <select id="stGrupo" name='stGrupo' class="select2 form-select">
                            <option value="">Opções</option>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                          </select>
                          <label for="type">Situação:</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">Pesquisar</button>
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
