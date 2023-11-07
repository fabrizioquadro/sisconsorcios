@extends('admin.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Adicionar Cliente</h5>
                </div>
            </div>
            <form action="{{ route('clienteInsert') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row mt-2 gy-4">
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nmCliente" name="nmCliente" placeholder="Nome"/>
                    <label for="nmCliente">Nome:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nrCpf" name="nrCpf" placeholder="CPF" maxlength="14" onkeypress="formatar('###.###.###-##', this)" />
                    <label for="nrCpf">CPF:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="nrRg" name="nrRg" placeholder="RG" maxlength="10" />
                    <label for="nrRg">RG:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <select required id="dsGenero" name='dsGenero' class="select2 form-select">
                      <option value="">Opções</option>
                      <option value="Feminino">Feminino</option>
                      <option value="Masculino">Masculino</option>
                    </select>
                    <label for="dsGenero">Genero:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="email" id="dsEmail" name="dsEmail" placeholder="Email" />
                    <label for="dsEmail">Email:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="password" id="password" name="password" placeholder="********" />
                    <label for="password">Senha:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="nrTel" name="nrTel" placeholder="Telefone" maxlength="15" onkeypress="mascara( this, mtel )" />
                    <label for="nrTel">Telefone:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nrCel" name="nrCel" placeholder="Celular" maxlength="15" onkeypress="mascara( this, mtel )" />
                    <label for="nrCel">Celular:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nrCep" name="nrCep" placeholder="CEP" maxlength="8" />
                    <label for="nrCep">CEP: (somente numeros)</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="dsEndereco" name="dsEndereco" placeholder="Endereço" />
                    <label for="dsEndereco">Endereço:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nrEndereco" name="nrEndereco" placeholder="Numero" />
                    <label for="nrEndereco">Numero:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="dsComplemento" name="dsComplemento" placeholder="Complemento" />
                    <label for="dsComplemento">Complemento:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="dsBairro" name="dsBairro" placeholder="Bairro" />
                    <label for="dsBairro">Bairro:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nmCidade" name="nmCidade" placeholder="Cidade" />
                    <label for="nmCidade">Cidade:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input required maxlength="2" class="form-control" type="text" id="dsUf" name="dsUf" placeholder="UF" />
                    <label for="dsUf">UF:</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="file" accept="image/png, image/jpeg, image/jpg" id="imagem" name="imagem"/>
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
              <div class="mt-4">
                  <button type="submit" class="btn btn-primary me-2">Salvar</button>
              </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('nrCep').addEventListener('blur', (e)=>{
    if(!isNaN(e.target.value)){
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
    }
    else{
        alert('CEP somente pode conter numeros');
        document.getElementById('nrCep').value = "";
        document.getElementById('nrCep').focus();
    }
})

document.getElementById('nrCpf').addEventListener('blur', (elem)=>{
    if(elem.target.value != ""){
        //vamos ver se é um cpf valido
        cpf = elem.target.value;
        if(cpf[3] != '.' || cpf[7] != '.' || cpf[11] != '-'){
            alert('É necessário o cpf estar na formatação XXX.XXX.XXX-XX');
            document.getElementById('nrCpf').value = "";
            document.getElementById('nrCpf').focus();
        }
        else{
            cpf = cpf.replaceAll('.','');
            cpf = cpf.replace('-','');

            if(TestaCPF(cpf)){
                console.log('ok')
            }
            else{
                alert('Cpf Inválido');
                document.getElementById('nrCpf').value = '';
                document.getElementById('nrCpf').focus();
            }
        }
    }
})
</script>

@endsection
