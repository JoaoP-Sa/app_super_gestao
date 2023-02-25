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

/*
Route::get('/', function () {
    return 'Olá, seja bem vindo ao curso!';
});
*/



/*
Route::get('/sobre-nos', function () {
    return 'Sobre nós';
});
*/



/*
Route::get('/contato', function () {
    return 'Contato';
});
*/



// nome, contato, categoria, mensagem

// Route::get('/contato/{nome}/{categoria_id}',
//     function(string $nome = 'Desconhecido',
//              int $categoria_id = 1) {
//         echo "Estamos aqui, $nome - $categoria_id";
//     })->where('categoria_id', '[0-9]+')->where('nome', '[a-zA-Z]+');
//         // com esse tratamento a rota deixa de retornar um
//         // erro e passa a retornar uma mensagem de controle do laravel




// Route::middleware(LogAcessoMiddleware::class)
//        ->get('/', 'PrincipalController@principal')
//        ->name('site.index');
// Route::get('/', 'PrincipalController@principal')->name('site.index')->middleware('log.acesso');

Route::get('/', 'PrincipalController@principal')->name('site.index');
Route::get('/sobre-nos', 'SobreNosController@sobreNos')->name('site.sobre-nos');

Route::get('/contato', 'ContatoController@contato')->name('site.contato');
Route::post('/contato', 'ContatoController@salvar')->name('site.contato');

Route::get('/login/{erro?}', 'LoginController@index')->name('site.login');
Route::post('/login', 'LoginController@autenticar')->name('site.login');


// app
Route::middleware('autenticacao:ldap,visitante')->prefix('/app')->group(function() {
    Route::get('/home', 'HomeController@index')->name('app.home');  // o name nas
    // rotas serve para que não precisemos usar a referência absoluta delas, em um href
    // podemos colocar "app.produtos" ao invés de "/produtos", por exemplo

    Route::get('/sair', 'LoginController@sair')->name('app.sair');

    // Route::get('/cliente', 'ClienteController@index')->name('app.cliente');

    Route::get('/fornecedor', 'FornecedorController@index')->name('app.fornecedor');
    Route::post('/fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');
    Route::get('/fornecedor/editar/{id}/{msg?}', 'FornecedorController@editar')->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', 'FornecedorController@excluir')->name('app.fornecedor.excluir');

    Route::get('/fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');

    // Route::get('/produto', 'ProdutoController@index')->name('app.produto');
    // Route::get('/produto/create', 'ProdutoController@create')->name('app.produto.create');

    // produtos
    Route::resource('produto', 'ProdutoController');

    // produtos detalhes
    Route::resource('produto-detalhe', 'ProdutoDetalheController');

    Route::resource('cliente', 'ClienteController');
    Route::resource('pedido', 'PedidoController');

    //Route::resource('pedido-produto', 'PedidoProdutoController');

    Route::get('pedido-produto/create/{pedido}', 'PedidoProdutoController@create')->name('pedido-produto.create');
    Route::post('pedido-produto/store/{pedido}', 'PedidoProdutoController@store')->name('pedido-produto.store');
    //Route::delete('pedido-produto.destroy/{pedido}/{produto}', 'PedidoProdutoController@destroy')->name('pedido-produto.destroy');
    Route::delete('pedido-produto.destroy/{pedidoProduto}/{pedido_id}', 'PedidoProdutoController@destroy')->name('pedido-produto.destroy');
});


// Route::get('/rota1', function() { echo 'rota 1'; })->name('site.rota1');

// Route::get('/rota2', function() {
//     return redirect()->route('site.rota1'); // outra forma de usar redirect no laravel
//  })->name('site.rota2');

//Route::redirect('/rota2', '/rota1'); uma das formas de usar o redirect no laravel


Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('site.teste');


Route::fallback(function() {
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">Clique aqui</a> para retornar à página inicial.';
    // o fallback é usado para dar algum retorno ao acessarmos alguma rota inexistente
});
