@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            @if($mensagem = Session::get('mensagem'))
              <div class="alert alert-success alert-dismissible" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Configurações.</h5>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nome do Sistema</h5>
                    <form action="{{ route('configuracoes.setNome') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline">
                                    <input required class="form-control" type="text" id="nmSistema" name="nmSistema" placeholder="Nome" value="{{ $config->nmSistema }}"/>
                                    <label for="nmSistema">Nome:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input required class="form-control" type="text" id="dsTitulo" name="dsTitulo" placeholder="Nome"/ value="{{ $config->dsTitulo }}">
                                    <label for="dsTitulo">Descrição:</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating form-floating-outline">
                                    <input class="form-control" type="file" id="logo" name="logo" accept="image/png, image/jpeg, image/jpg" placeholder="Logo"/>
                                    <label for="logo">Logo:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Dados de Cobrança para o Asaas</h5>
                    <p class="mt-5 mb-5">Link de Notificações para inserção no asaas (webhoot): <b>{{ asset('/notification') }}</b></p>
                    <form action="{{ route('configuracoes.setAsaas') }}" method="post">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select required id="asaas_method" name='asaas_method' class="select2 form-select">
                                        <option @if($config->asaas_method == "sandbox") selected @endif value="sandbox">sandbox</option>
                                        <option @if($config->asaas_method == "production") selected @endif value="production">production</option>
                                    </select>
                                  <label for="asaas_method">Método:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-floating form-floating-outline">
                                    <input required class="form-control" type="text" id="asaas_client" name="asaas_client" placeholder="asaas_client"/ value="{{ $config->asaas_client }}">
                                    <label for="asaas_client">Asaas Client:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Mensagens Automáticas de Cadastro Cliente Email</h5>
                    <form action="{{ route('configuracoes.setMensagensCad') }}" method="post">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select required id="stMensagemCad" name='stMensagemCad' class="select2 form-select">
                                        <option @if($config->stMensagemCad == "Sim") selected @endif value="Sim">Sim</option>
                                        <option @if($config->stMensagemCad == "Não") selected @endif value="Não">Não</option>
                                    </select>
                                  <label for="stMensagemCad">Utilizar:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="dsMensagemCad">Mensagem:</label>
                                    <textarea class="form-control" id="dsMensagemCad" name='dsMensagemCad' placeholder="Mensagem ...">{{ $config->dsMensagemCad }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Macros</h5>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Link de acesso ao sistema pelo cliente'>%Link%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Usuário (email) do cliente de acesso ao sistema'>%User%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Senha do cliente de acesso ao sistema'>%Password%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Nome do Cliente'>%Name%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Nome do sistema'>%NameSystem%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Titulo do sistema'>%DescriptionSystem%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class='btn btn-primary'>Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Mensagens Automáticas de Recuperação de Senha</h5>
                    <form action="{{ route('configuracoes.setMensagensSenha') }}" method="post">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select required id="stMensagemSenha" name='stMensagemSenha' class="select2 form-select">
                                        <option @if($config->stMensagemSenha == "Sim") selected @endif value="Sim">Sim</option>
                                        <option @if($config->stMensagemSenha == "Não") selected @endif value="Não">Não</option>
                                    </select>
                                  <label for="stMensagemSenha">Utilizar:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="dsMensagemSenha">Mensagem:</label>
                                    <textarea class="form-control" id="dsMensagemSenha" name='dsMensagemSenha' placeholder="Mensagem ...">{{ $config->dsMensagemSenha }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Macros</h5>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Link de acesso ao sistema pelo cliente'>%Link%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Usuário (email) do cliente de acesso ao sistema'>%User%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Senha do cliente de acesso ao sistema'>%Password%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Nome do Cliente'>%Name%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Nome do sistema'>%NameSystem%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Titulo do sistema'>%DescriptionSystem%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class='btn btn-primary'>Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Mensagens Automáticas de Contemplação de Cliente</h5>
                    <form action="{{ route('configuracoes.setMensagensContemplacao') }}" method="post">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select required id="stMensagemContemplacao" name='stMensagemContemplacao' class="select2 form-select">
                                        <option @if($config->stMensagemContemplacao == "Sim") selected @endif value="Sim">Sim</option>
                                        <option @if($config->stMensagemContemplacao == "Não") selected @endif value="Não">Não</option>
                                    </select>
                                  <label for="stMensagemContemplacao">Utilizar:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="dsMensagemContemplacao">Mensagem:</label>
                                    <textarea class="form-control" id="dsMensagemContemplacao" name='dsMensagemContemplacao' placeholder="Mensagem ...">{{ $config->dsMensagemContemplacao }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Macros</h5>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Link de acesso ao sistema pelo cliente'>%Link%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Nome do Cliente'>%Name%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Numero do Grupo'>%Grupo%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Nome do Banco'>%Banco%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Data Contemplação'>%DataContemplacao%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Nome do sistema'>%NameSystem%</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12" align='center'>
                                                <span class="badge bg-label-secondary" title='Titulo do sistema'>%DescriptionSystem%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class='btn btn-primary'>Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script>

CKEDITOR.replace( 'dsMensagemCad' );
CKEDITOR.replace( 'dsMensagemSenha' );
CKEDITOR.replace( 'dsMensagemContemplacao' );



</script>

@endsection
