<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


Route::get('/', 'AuthController@showLoginForm')->name('admin.login');
Route::post('admin/login/do', 'AuthController@login')->name('admin.login.do');
Route::get('admin/register', 'AuthController@registerForm')->name('admin.register');
Route::get('admin/reset', 'AuthController@resetPassword')->name('admin.reset');


Route::group(['middleware' => ['auth']], function () {

    //** Admin painel */

    Route::get('admin', 'AuthController@dashboard')->name('admin');

    //Ínicio */
    Route::get('admin/inicio', 'AuthController@inicio')->name('admin.inicio');

    //**Usuarios */
    Route::get('admin/logout', 'AuthController@logout')->name('admin.logout');
    Route::resource('admin/users', 'AdminUserController');

    //** User Painel */

    //**Internos */

    //**Busca dinâmica de municipios*/
    Route::POST('internos/cidadeBusca', 'InternosController@cidadeBusca')->name('interno.cidadeBusca');

    //**Busca de internos */
    Route::POST('internos/internoBusca', 'InternosController@internoBusca')->name('interno.internoBusca');

    Route::delete('internos/deletar/{interno}', 'InternosController@deletarInterno')->name('interno.deletar.interno');
    Route::put('internos/excluidos/update/{interno}', 'InternosController@excluidosUpdate')->name('interno.excluidos.update');
    Route::get('internos/excluidos/editar/{interno}', 'InternosController@excluidosEdit')->name('interno.excluidos.edit');
    Route::get('internos/excluidos/{interno}', 'InternosController@excluidosShow')->name('interno.excluidosShow');
    Route::get('internos/excluidos', 'InternosController@excluidos')->name('interno.excluidos');
    Route::delete('internos/{arquivo}/delete', 'InternosController@arquivoDelete')->name('interno.arquivoDelete');
    Route::get('internos/{interno}/visitas', 'InternosController@visitas')->name('interno.visitas');
    Route::resource('internos', 'InternosController');

    Route::post('entradavisitantes/entrada', 'EntradaVisitantesController@entrada')->name('entradavisitantes.entrada');
    Route::get('entradavisitantes/saida/{visita}', 'EntradaVisitantesController@saida')->name('entradavisitantes.saida');
    Route::get('entradavisitantes/listasaida', 'EntradaVisitantesController@listasaida')->name('entradavisitantes.listasaida');
    Route::resource('entradavisitantes', 'EntradaVisitantesController');


    //** Penal */
    Route::get('penal/relatorios', 'PenalController@relatorios')->name('penal.relatorios');

    Route::resource('penal', 'PenalController');

    Route::get('processos/{interno}/create', 'ProcessosController@create')->name('processos.create');
    Route::resource('processos', 'ProcessosController')->except(['create']);

    Route::resource('legislacao', 'LegislacaoController');

    Route::POST('alojamentos/buscaestagio', 'AlojamentosController@buscaestagio')->name('alojamentos.buscaestagio');
    Route::resource('alojamentos', 'AlojamentosController');

    Route::POST('visita/search', 'VisitaController@visitaSearch')->name('visita.visitaSearch');
    Route::delete('visita/{visita}/delete', 'VisitaController@arquivoDelete')->name('visita.arquivoDelete');
    Route::get('visita/{visita}/create', 'VisitaController@create')->name('visita.create');
    Route::resource('visita', 'VisitaController')->except(['create']);

    Route::get('advogados/{interno}/create', 'AdvogadosController@create')->name('advogados.create');
    Route::resource('advogados', 'AdvogadosController')->except(['create']);


    //** Jurídica */
    Route::resource('estudos', 'EstudoController');
    Route::put('estudos/interno/{interno}', 'EstudoController@internoEstudo')->name('estudos.internoEstudo');
    Route::POST('estudos/{estudo}', 'EstudoController@internoAdic')->name('estudos.internoAdic');
    Route::get('estudos/{estudo}/estudo', 'EstudoController@editarEstudo')->name('empregador.editarEstudo');


    Route::resource('empregador', 'EmpregadorController');

    Route::POST('empregador/{empregador}', 'EmpregadorController@internoAdic')->name('empregador.internoAdic');
    Route::put('empregador/interno/{interno}', 'EmpregadorController@internoTrabalho')->name('empregador.internoTrabalho');
    Route::get('empregador/{trabalho}/trabalho', 'EmpregadorController@editarTrabalho')->name('empregador.editarTrabalho');

    //** PJMD */
    Route::resource('pjmd', 'ComportamentoController')->except(['create']);
    Route::put('pjmd/comportamentoUpdate/{pjmd}', 'ComportamentoController@comportamentoUpdate')->name('pjmd.comportamentoUpdate');
    Route::get('pjmd/comportamento/{pjmd}', 'ComportamentoController@comportamentoEdit')->name('pjmd.comportamentoEdit');
    Route::delete('pjmd/{pjmd}/delete', 'ComportamentoController@arquivoDelete')->name('pjmd.arquivoDelete');
    Route::POST('pjmd/create', 'ComportamentoController@create')->name('pjmd.create');


    //** PDF */
    Route::post('pdf/interno', 'PdfController@internoPDF')->name('gerar.internoPDF');
    Route::post('pdf/guarda', 'PdfController@guardaPDF')->name('gerar.guardaPDF');
    Route::post('pdf/recolhidos', 'PdfController@recolhidosPDF')->name('gerar.recolhidosPDF');
    Route::post('pdf/trabalho', 'PdfController@trabalhoPDF')->name('gerar.trabalhoPDF');
    Route::post('pdf/internoficha', 'PdfController@internofichaPDF')->name('gerar.internofichaPDF');
    Route::post('pdf/entradavisitantes', 'PdfController@entradavisitantesPDF')->name('gerar.entradavisitantesPDF');
    Route::post('pdf/telematica', 'PdfController@telematicaPDF')->name('gerar.telematicaPDF');

    //TELEMATICA*/
    Route::get('telematica/teste', 'Telematica_suporteController@teste')->name('telematica.teste');
    Route::get('telematica/historico', 'Telematica_suporteController@historico')->name('telematica.historico');
    Route::POST('telematica/busca', 'Telematica_suporteController@busca')->name('telematica.busca');
    Route::resource('telematica', 'Telematica_suporteController');

    //REPORTAR*/
    Route::resource('reportar', 'ReportarController');
});
