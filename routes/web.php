<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\AcessoClienteController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\ExportarController;
use App\Http\Controllers\ChamadaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//rotas que são abertas
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/autenticar', [LoginController::class, 'autenticar'])->name('autenticar');
Route::get('/esqueceuSenha', [LoginController::class, 'esqueceuSenha'])->name('esqueceuSenha');
Route::post('/recuperarSenha', [LoginController::class, 'recuperarSenha'])->name('recuperarSenha');

//rotas abertas para login do cliente
Route::get('/clienteLogin', [LoginController::class, 'clienteIndex'])->name('cliente.login');
Route::post('/clienteAutenticar', [LoginController::class, 'clienteAutenticar'])->name('cliente.autenticar');
Route::get('/clienteEsqueceuSenha', [LoginController::class, 'clienteEsqueceuSenha'])->name('cliente.esqueceuSenha');
Route::post('/clienteRecuperarSenha', [LoginController::class, 'clienteRecuperarSenha'])->name('cliente.recuperarSenha');


//rotas de acesso dos cliente
Route::middleware(['verificarCliente'])->group(function () {
    Route::get('/clienteDashboard', [AcessoClienteController::class, 'dashboard'])->name('cliente.dashboard');
    Route::get('/clientePerfil', [AcessoClienteController::class, 'perfil'])->name('cliente.perfil');
    Route::get('/clienteAlterarSenha', [AcessoClienteController::class, 'alterarSenha'])->name('cliente.alterarSenha');
    Route::get('/clientelogout', [LoginController::class, 'clienteLogout'])->name('cliente.logout');
    Route::get('/clienteConsorcios', [AcessoClienteController::class, 'consorcios'])->name('cliente.consorcios');
    Route::get('/clienteFinanceiro', [AcessoClienteController::class, 'financeiro'])->name('cliente.financeiro');
    Route::get('/clienteVisualizarConsorcio/{id}', [AcessoClienteController::class, 'visualizarConsorcio'])->name('cliente.visualizarConsorcio');
    Route::get('/clienteGerarBoleto/{id}', [AcessoClienteController::class, 'gerarBoleto'])->name('cliente.gerarBoleto');

    Route::get('/clienteChamadas', [AcessoClienteController::class, 'chamadas'])->name('cliente.chamadas');
    Route::get('/clienteChamadasAdicionar', [AcessoClienteController::class, 'chamadasAdicionar'])->name('cliente.chamadas.adicionar');
    Route::post('/clienteChamadasAdicionar', [AcessoClienteController::class, 'chamadasInsert'])->name('cliente.chamadas.insert');
    Route::get('/clienteChamadasAcessar/{id}', [AcessoClienteController::class, 'chamadasAcessar'])->name('cliente.chamadas.acessar');
    Route::post('/clienteChamadasAndamento', [AcessoClienteController::class, 'chamadasAndamento'])->name('cliente.chamadas.andamento');
});

//rotas fechadas pela autenticação
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/login/alterarSenha', [LoginController::class, 'alterarSenha'])->name('login.alterarSenha');
    Route::post('/login/alterarSenha', [LoginController::class, 'updateSenha'])->name('login.updateSenha');
    Route::get('/login/perfil', [LoginController::class, 'perfil'])->name('login.perfil');
    Route::post('/login/perfil', [LoginController::class, 'update'])->name('login.update');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //rotas que controla os usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios');
    Route::get('/usuarioAdd', [UsuarioController::class, 'add'])->name('usuarioAdd');
    Route::post('/usuarioInsert', [UsuarioController::class, 'insert'])->name('usuarioInsert');
    Route::get('/usuarioEditar/{id}', [UsuarioController::class, 'editar'])->name('usuarioEditar');
    Route::get('/usuarioExcluir/{id}', [UsuarioController::class, 'excluir'])->name('usuarioExcluir');
    Route::get('/usuarioVisualizar/{id}', [UsuarioController::class, 'visualizar'])->name('usuarioVisualizar');
    Route::get('/usuarioAlterarSenha/{id}', [UsuarioController::class, 'alterarSenha'])->name('usuarioAlterarSenha');
    Route::post('/usuarioUpdate', [UsuarioController::class, 'update'])->name('usuarioUpdate');
    Route::post('/usuarioDelete', [UsuarioController::class, 'delete'])->name('usuarioDelete');
    Route::post('/usuarioAlterarSenha', [UsuarioController::class, 'alterarSenhaSql'])->name('usuarioAlterarSenhaSql');


    //rotas destinadas a os clientes
    Route::get('/clientes',[ClienteController::class, 'index'])->name('clientes');
    Route::get('/clienteAdd', [ClienteController::class, 'add'])->name('clienteAdd');
    Route::post('/clienteInsert', [ClienteController::class, 'insert'])->name('clienteInsert');
    Route::get('/clienteEditar/{id}', [ClienteController::class, 'editar'])->name('clienteEditar');
    Route::get('/clienteExcluirArquivo/{id}', [ClienteController::class, 'excluirArquivo'])->name('clienteExcluirArquivo');
    Route::post('/clienteExcluirArquivo', [ClienteController::class, 'excluirArquivoSql'])->name('clienteExcluirArquivoSql');
    Route::get('/clienteExcluir/{id}', [ClienteController::class, 'excluir'])->name('clienteExcluir');
    Route::get('/clienteVisualizar/{id}', [ClienteController::class, 'visualizar'])->name('clienteVisualizar');
    Route::get('/clienteAlterarSenha/{id}', [ClienteController::class, 'alterarSenha'])->name('clienteAlterarSenha');
    Route::post('/clienteUpdate', [ClienteController::class, 'update'])->name('clienteUpdate');
    Route::post('/clienteDelete', [ClienteController::class, 'delete'])->name('clienteDelete');
    Route::post('/clienteAlterarSenha', [ClienteController::class, 'alterarSenhaSql'])->name('clienteAlterarSenhaSql');


    //rotas destinadas aos grupos
    Route::get('/grupos', [GrupoController::class, 'index'])->name('grupos');
    Route::get('/grupoAdd', [GrupoController::class, 'add'])->name('grupoAdd');
    Route::post('/grupoAdd', [GrupoController::class, 'insert'])->name('grupoAdd');
    Route::get('/grupoEditar/{id}', [GrupoController::class, 'editar'])->name('grupoEditar');
    Route::post('/grupoEditar', [GrupoController::class, 'update'])->name('grupoUpdate');
    Route::get('/grupoExcluir/{id}', [GrupoController::class, 'excluir'])->name('grupoExcluir');
    Route::post('/grupoExcluir', [GrupoController::class, 'delete'])->name('grupoDelete');
    Route::get('/grupoCotas/{id}', [GrupoController::class, 'cotas'])->name('grupoCotas');
    Route::get('/grupoCotasContemplar/{id}', [GrupoController::class, 'contemplar'])->name('grupoCotasContemplar');
    Route::post('/grupoCotasContemplar', [GrupoController::class, 'contemplarInsert'])->name('grupoCotasContemplarInsert');
    Route::get('/grupoCotasRegatar/{id}', [GrupoController::class, 'resgatar'])->name('grupoCotasResgatar');
    Route::post('/grupoCotasRegatar', [GrupoController::class, 'resgatarInsert'])->name('grupoCotasResgatarInsert');
    Route::get('/grupoCotasReajustar/{id}', [GrupoController::class, 'reajustar'])->name('grupoCotas.reajustar');
    Route::post('/grupoCotasReajustarCalcular', [GrupoController::class, 'reajusteCalcular'])->name('grupoCotas.reajustar.calcular');
    Route::post('/grupoCotasReajustarInsert', [GrupoController::class, 'reajusteInsert'])->name('grupoCotas.reajustar.insert');
    Route::get('/grupoVisualizar/{id}', [GrupoController::class, 'visualizar'])->name('grupoVisualizar');


    //rotas destinadas a parte de vendas
    Route::get('/vendas', [VendaController::class, 'index'])->name('vendas');
    Route::get('/vendaAdd', [VendaController::class, 'add'])->name('vendaAdd');
    Route::post('/vendaAdd', [VendaController::class, 'calculaDadosVenda'])->name('vendaAdd');
    Route::post('/vendaInsert', [VendaController::class, 'insert'])->name('vendaInsert');
    Route::get('/vendaExcluir/{id}', [VendaController::class, 'excluir'])->name('vendaExcluir');
    Route::post('/vendaDeletar', [VendaController::class, 'delete'])->name('vendaDeletar');
    Route::get('/vendaVisualizar/{id}', [VendaController::class, 'visualizar'])->name('vendaVisualizar');
    Route::get('/vendaParcelas/{id}', [VendaController::class, 'listarParcelas'])->name('vendaParcelas');
    Route::get('/vendaAddParcela/{id}', [VendaController::class, 'addParcela'])->name('vendaAddParcela');
    Route::post('/vendaAddParcela', [VendaController::class, 'insertParcela'])->name('vendaInsertParcela');
    Route::get('/vendaExcluirParcela/{id}', [VendaController::class, 'excluirParcela'])->name('vendaExcluirParcela');
    Route::post('/vendaExcluirParcela', [VendaController::class, 'deleteParcela'])->name('vendaDeleteParcela');
    Route::get('/vendaPagarParcela/{id}', [VendaController::class, 'pagarParcela'])->name('vendaPagarParcela');
    Route::post('/vendaPagarParcela', [VendaController::class, 'setPagarParcela'])->name('vendaSetPagarParcela');
    Route::get('/vendaDesfazerPgtParcela/{id}', [VendaController::class, 'desfazerPgtParcela'])->name('vendaDesfazerPgtParcela');
    Route::post('/vendaDesfazerPgtParcela', [VendaController::class, 'setDesfazerPgtParcela'])->name('vendaSetDesfazerPgtParcela');

    //aqui entra as rotas de configuraçãoptimize
    Route::get('/configuracoes', [ConfiguracaoController::class, 'index'])->name('configuracoes');
    Route::post('/configuracoesSetNome', [ConfiguracaoController::class, 'setNome'])->name('configuracoes.setNome');
    Route::post('/configuracoesSetMensagensCad', [ConfiguracaoController::class, 'setMensagensCad'])->name('configuracoes.setMensagensCad');
    Route::post('/configuracoesSetMensagensSenha', [ConfiguracaoController::class, 'setMensagensSenha'])->name('configuracoes.setMensagensSenha');
    Route::post('/configuracoesSetMensagensContemplacao', [ConfiguracaoController::class, 'setMensagensContemplacao'])->name('configuracoes.setMensagensContemplacao');
    Route::post('/configuracoesSetAsaas', [ConfiguracaoController::class, 'setAsaas'])->name('configuracoes.setAsaas');


    //aqui entra as rotas das chamadas
    Route::get('/chamadas', [ChamadaController::class, 'index'])->name('chamadas');
    Route::get('/chamadasAcessar/{id}', [ChamadaController::class, 'acessar'])->name('chamadas.acessar');
    Route::post('/chamadasAndamento', [ChamadaController::class, 'andamento'])->name('chamadas.andamento');

    //aqui entra as rotas dos relatorios
    Route::get('/relClientes', [RelatorioController::class, 'indexClientes'])->name('relatorios.cliente');
    Route::post('/relClientesPesquisar', [RelatorioController::class, 'pesquisarClientes'])->name('relatorios.cliente.pesquisar');
    Route::get('/relGrupos', [RelatorioController::class, 'indexGrupos'])->name('relatorios.grupos');
    Route::post('/relGruposPesquisar', [RelatorioController::class, 'pesquisarGrupos'])->name('relatorios.grupos.pesquisar');
    Route::get('/relVendas', [RelatorioController::class, 'indexVendas'])->name('relatorios.vendas');
    Route::post('/relVendasPesquisar', [RelatorioController::class, 'pesquisarVendas'])->name('relatorios.vendas.pesquisar');
    Route::get('/relParcelas', [RelatorioController::class, 'indexParcelas'])->name('relatorios.parcelas');
    Route::post('/relParcelasPesquisar', [RelatorioController::class, 'pesquisarParcelas'])->name('relatorios.parcelas.pesquisar');
    Route::get('/relContemplacoes', [RelatorioController::class, 'indexContemplacoes'])->name('relatorios.contemplacoes');
    Route::post('/relContemplacoesPesquisar', [RelatorioController::class, 'pesquisarContemplacoes'])->name('relatorios.contemplacoes.pesquisar');
    Route::get('/relResgates', [RelatorioController::class, 'indexResgates'])->name('relatorios.resgates');
    Route::post('/relResgatesPesquisar', [RelatorioController::class, 'pesquisarResgates'])->name('relatorios.resgates.pesquisar');

    //rota para as exportações dos relatorios
    Route::post('/exportar', [ExportarController::class, 'exportar'])->name('exportar');

});
