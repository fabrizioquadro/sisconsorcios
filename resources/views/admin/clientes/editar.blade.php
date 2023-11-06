@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Editar Cliente</h5>
                </div>
            </div>
            @if($mensagem = Session::get('mensagem'))
                <div class="alert alert-success alert-dismissible mt-3" role="alert">
                  {{ $mensagem }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('clienteUpdate') }}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="{{ $cliente->id }}">
              @csrf
              <div class="row mt-2 gy-4">
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nmCliente" name="nmCliente" placeholder="Nome"/ value='{{ $cliente->nmCliente }}'>
                    <label for="nmCliente">Nome:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nrCpf" name="nrCpf" placeholder="CPF" maxlength="14" onkeypress="formatar('###.###.###-##', this)" value='{{ $cliente->nrCpf }}' />
                    <label for="nrCpf">CPF:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="nrRg" name="nrRg" placeholder="RG" maxlength="10" value='{{ $cliente->nrRg }}' />
                    <label for="nrRg">RG:</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <select required id="dsGenero" name='dsGenero' class="select2 form-select">
                      <option value="">Opções</option>
                      <option @if($cliente->dsGenero == 'Feminino') selected @endif value="Feminino">Feminino</option>
                      <option @if($cliente->dsGenero == 'Masculino') selected @endif value="Masculino">Masculino</option>
                    </select>
                    <label for="dsGenero">Genero:</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="email" id="dsEmail" name="dsEmail" placeholder="Email" value='{{ $cliente->dsEmail }}' />
                    <label for="dsEmail">Email:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="nrTel" name="nrTel" placeholder="Telefone" maxlength="15" onkeypress="mascara( this, mtel )" value='{{ $cliente->nrTel }}'/>
                    <label for="nrTel">Telefone:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nrCel" name="nrCel" placeholder="Celular" maxlength="15" onkeypress="mascara( this, mtel )" value='{{ $cliente->nrCel }}' />
                    <label for="nrCel">Celular:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nrCep" name="nrCep" placeholder="CEP" maxlength="8" value='{{ $cliente->nrCep }}' />
                    <label for="nrCep">CEP: (somente numeros)</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="dsEndereco" name="dsEndereco" placeholder="Endereço" value='{{ $cliente->dsEndereco }}' />
                    <label for="dsEndereco">Endereço:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nrEndereco" name="nrEndereco" placeholder="Numero" value='{{ $cliente->nrEndereco }}' />
                    <label for="nrEndereco">Numero:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="dsComplemento" name="dsComplemento" placeholder="Complemento" value='{{ $cliente->dsComplemento }}' />
                    <label for="dsComplemento">Complemento:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="dsBairro" name="dsBairro" placeholder="Bairro" value='{{ $cliente->dsBairro }}' />
                    <label for="dsBairro">Bairro:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nmCidade" name="nmCidade" placeholder="Cidade" value='{{ $cliente->nmCidade }}' />
                    <label for="nmCidade">Cidade:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="dsUf" name="dsUf" placeholder="UF" value='{{ $cliente->dsUf }}' />
                    <label for="dsUf">UF:</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="file" id="imagem" name="imagem"/>
                    <label for="imagem">Foto do Cliente:</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="file" id="imagens" name="imagens[]" multiple/>
                    <label for="imagens">Arquivos Diversos:</label>
                  </div>
                </div>
              </div>
              <div class="row">
                  @foreach($arquivos as $arquivo)
                      <div class="col-md-3 col-sm-6 mt-4">
                          <div class="card">
                              <div class="card-body" align='center'>
                                  <span class="avatar-initial rounded bg-label-secondary">
                                      <i class="mdi mdi-file-document-outline mdi-24px"></i>
                                  </span>
                                  <p class='text-center'>{{ $arquivo->nmArquivo }}</p>
                                  <a href='{{ asset("/public/img/clientes/arquivos/$arquivo->arquivo") }}' target='_blank' class="btn btn-sm btn-secondary waves-effect waves-light">Abrir</a>
                                  <a href='{{ route("clienteExcluirArquivo", $arquivo->id) }}' class="btn btn-sm btn-danger waves-effect waves-light">Excluir</a>
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
              <div class="mt-4">
                  <button type="submit" class="btn btn-primary me-2">Salvar</button>
              </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('nrCep').addEventListener('blur', (e)=>{
    if(e.target.value != ""){
        $.getJSON(
            "https://viacep.com.br/ws/" + e.target.value + "/json/",
            {},
            function(json){
                if(json.erro != true){
                    document.getElementById('dsEndereco').value = json.logradouro;
                    document.getElementById('dsComplemento').value = json.complemento;
                    document.getElementById('dsBairro').value = json.bairro;
                    document.getElementById('nmCidade').value = json.localidade;
                    document.getElementById('dsUf').value = json.uf;
                    document.getElementById('nrEndereco').focus();
                }
            }
        );
    }
})
</script>

@endsection
