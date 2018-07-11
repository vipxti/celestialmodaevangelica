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

Route::get('/', 'HomeController@showIndexPage')->name('index');

Route::prefix('admin')->group(function () {

    //Cadastro dos dados da Empresa
    Route::get('/dadosCadastrais', 'CompanyController@showCompanyForm')->name('company.data')->middleware('auth:admin');
    Route::post('/dadosCadastrais', 'CompanyController@registerComnpany')->name('company.register.data')->middleware('auth:admin');
    //Pedido
    Route::get('/pedido', 'OrderController@listOrder')->name('order.list')->middleware('auth:admin');



    //Cadastro e login de usuário
    Route::get('/login', 'Auth\UserLoginController@showAdminLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\UserLoginController@login')->name('admin.login.submit');
    Route::get('/register', 'Auth\UserRegisterController@showRegisterForm')->name('admin.register');
    Route::post('/register', 'Auth\UserRegisterController@create')->name('admin.register.submit');
    Route::get('/register/{cpf_cnpj}', 'Auth\UserRegisterController@verificaCpfCnpj');

    //Atualizar dados do usuário
    Route::post('/edit', 'UserController@atualizaDadosUsuario')->name('admin.edit');

    //Produto
    Route::post('/product', 'ProductController@cadastrarProduto')->name('product.save');
    Route::get('/product', 'ProductController@showProductAdminPage')->name('product.register')->middleware('auth:admin');

    //Variação do produto
    Route::post('/product/variation', 'ProductController@cadastrarVariacaoProduto')->name('product.variation.save')->middleware('auth:admin');
    Route::get('/product/variation/{cd_produto}', 'ProductController@showProductPageVariation')->middleware('auth:admin');

    //Form categoria/subcategoria e cadastro
    Route::get('/category', 'CategoryController@showCategoryForm')->name('category.register')->middleware('auth:admin');
    Route::post('/category', 'CategoryController@crudCategoria')->name('category.save');
    Route::get('/subcat/{cd_categoria}', 'CategoryController@selectSubCategory')->name('category.subcategory')->middleware('auth:admin');
    Route::post('/subcategory', 'CategoryController@crudSubCategoria')->name('subcategory.save');

    //Associa categoria/subcategoria
    Route::post('/catsubcat', 'CategoryController@associarCategoriaSubCategoria')->name('catsubcat.associate');

    //Form tamanho e cadastro
    Route::get('/size', 'SizeController@showSizeForm')->name('size.register')->middleware('auth:admin');
    Route::post('/tamanholetra', 'SizeController@cadastrarNovoTamanhoLetra')->name('lettersize.save');
    Route::post('/tamanholetra/update', 'SizeController@updateSizeLetter')->name('lettersize.update');
    Route::post('/tamanholetra/delete', 'SizeController@deleteSizeLetter')->name('lettersize.delete');
    Route::post('/tamanhonumero', 'SizeController@cadastrarNovoTamanhoNumero')->name('numbersize.save');
    Route::post('/tamanhonumero/update', 'SizeController@updateSizeNumber')->name('numbersize.update');
    Route::post('/tamanhonumero/delete', 'SizeController@deleteSizeNumber')->name('numbersize.delete');

    //Form cor e cadastro
    Route::get('/color', 'ColorController@showColorForm')->name('color.page')->middleware('auth:admin');
    Route::post('/color/save', 'ColorController@addNewColor')->name('color.save');
    Route::post('/color/update', 'ColorController@updateColor')->name('color.update');
    Route::post('/color/delete', 'ColorController@deleteColor')->name('color.delete');

    //Integração
    //Bling
    Route::get('/product/bling', 'ProductBlingController@importFromBling')->name('product.list.bling')->middleware('auth:admin');
    Route::get('api/bling/{pagina}', 'ProductBlingController@searchProds')->name('search.api.bling')->middleware('auth:admin');
    Route::get('api/bling/cat/{id}', 'ProductBlingController@searchCatFather')->name('searchCat.api.bling')->middleware('auth:admin');

    Route::get('/data', 'UserController@showUserForm')->name('admin.data')->middleware('auth:admin');

    //Edição do site
    Route::get('/hotpost', 'PageController@showHotPostPage')->name('hotpost.edit')->middleware('auth:admin');
    Route::get('/banner', 'PageController@showBannerPage')->name('banner.edit')->middleware('auth:admin');

    //Editar menus
    Route::get('/menu', 'MenuController@showEditMenuPage')->name('menu.edit')->middleware('auth:admin');
    Route::post('/menu', 'MenuController@saveMenus')->name('menu.save');

    Route::get('/productconfig', 'PageController@showConfigProductPage')->name('product.config');

    Route::get('/', 'HomeController@showIndexAdminPage')->name('admin.dashboard')->middleware('auth:admin');
    Route::get('/products/list', 'ProductController@listaProduto')->name('products.list')->middleware('auth:admin');

    //Faz o logout do usuário
    Route::get('/logout', 'Auth\UserLoginController@userLogout')->name('admin.logout');

    //Resetar senha
    Route::post('/password/email', 'Auth\UserForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\UserForgotPasswordController@showLinkRequestForm')->name('admin.password.request')->middleware('auth:admin');
    Route::post('/password/reset', 'Auth\UserResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\UserResetPasswordController@showResetForm')->name('admin.password.reset');
    //----------------
});

Route::prefix('page')->group(function () {
    
    //Produtos
    Route::prefix('product')->group(function () {
        Route::get('/shop', 'ProductController@showShopProductsPage')->name('products.page');
        Route::get('/{productsku}', 'ProductController@showProductDetails')->name('products.details');
    });

    Route::prefix('cart')->group(function () {
        Route::get('/', 'CartController@showCartPage')->name('cart.page');
        Route::post('/', 'CartController@addToCart')->name('cart.buy');
        Route::post('/store', 'CartController@store')->name('cart.store');
        Route::post('/delete', 'CartController@deleteProduct')->name('cart.product.delete');
        Route::post('/clear', 'CartController@clearCart')->name('cart.clear');
        Route::get('/minus/{idx}', 'CartController@removeQuantityCart')->name('minus.quantity');
        Route::get('/plus/{idx}', 'CartController@addQuantityCart')->name('plus.quantity');
        Route::get('/result', 'CartController@showResultPage')->name('cart.result.page');
    });

    //Compra
    Route::get('/checkout', 'PageController@showCheckout')->name('checkout.page');
    Route::get('/endereco', 'PageController@showEndereco')->name('endereco.page');
    Route::get('/cartao', 'PageController@showCartao')->name('cartao.page');
    Route::get('/boleto', 'PageController@showBoleto')->name('boleto.page');

    //Cliente
    Route::prefix('client')->group(function () {
        Route::post('/save', 'Auth\ClientRegisterController@create')->name('client.save');
        Route::get('/register', 'Auth\ClientRegisterController@showRegisterForm')->name('client.register');
        Route::get('/login', 'Auth\ClientLoginController@showClientLoginForm')->name('client.login');
        Route::post('/login', 'Auth\ClientLoginController@login')->name('client.login.submit');
        Route::get('/dashboard', 'ClientController@showClientPage')->name('client.dashboard')/*->middleware('auth:web')*/;
        Route::get('/logout', 'Auth\ClientLoginController@clientLogout')->name('client.logout');
        Route::get('/register/{cpf_cnpj}', 'Auth\ClientRegisterController@verificaCpfCnpj');
    });
    
    Route::get('/calculaFrete/{cep},{altura},{largura},{peso},{comprimento}', 'CartController@calcFrete');
    Route::post('/pagseguro/redirect', 'CartController@finalizarCompra')->name('finalizar.compra');
    Route::get('/calculaFreteOffline/{cep},{peso}', 'CartController@calcFreteOffline');

    Route::post('/client/address', 'ClientController@saveClientAddress')->name('client.address.save');
});

Route::get('/alteraremailcliente', 'ProductController@paginaAlteraremailcliente')->name('alteraremailcliente.page');
Route::get('/alterarsenhacliente', 'ProductController@paginaAlterarsenhacliente')->name('alterarsenhacliente.page');
Route::get('/descproduto', 'ProductController@paginaDescproduto')->name('descproduto.page');
