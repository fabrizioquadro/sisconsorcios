@extends('acessoCliente.layout')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Adicionar Chamada</h5>
                </div>
            </div>
            <form action="{{ route('cliente.chamadas.insert') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row mt-2 gy-4">
                  <div class="col-md-12">
                    <div class="form-floating form-floating-outline mb-4">
                      <textarea required class="form-control h-px-100" id="dsChamada" name='dsChamada' placeholder="Descreva o problema encontrado mais detalhado possível." focus()></textarea>
                      <label for="dsChamada">Descreva o problema encontrado mais detalhado possí<vel></vel>:</label>
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
