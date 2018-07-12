<script src="{{asset('js/app/popper.min.js')}}"></script>

<style>
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
    }
</style>

<header class="header_area">
    <!-- Top Header Area Start -->
    <div class="top_header_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-end">
                <div class="col-12 col-lg-12">
                    <div class="top_single_area d-flex align-items-center">
                        <!-- Logo Area -->
                        <div class="top_logo">
                            <a href="{{ route('index')}}"><img style="width: 110px" src="{{ asset('img/app/core-img/logo.png') }}" alt=""></a>
                        </div>

                        <!--Carrinho e Menu -->
                        <div class="header-cart-menu d-flex align-items-center ml-auto">
                            <div class="main-menu-area">
                                <nav class="navbar navbar-expand-lg align-items-start">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#karl-navbar" aria-controls="karl-navbar" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon">
                                            <i class="ti-menu"> </i>
                                        </span>
                                    </button>
                                    <div class="collapse navbar-collapse align-items-start collapse" id="karl-navbar">
                                        <ul class="navbar-nav animated" id="nav">
                                            <li class="nav-item active"><a class="nav-link" href="{{route('index')}}">Início</a></li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="karlDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Saúde e Beleza</a>
                                                <div class="dropdown-menu" aria-labelledby="karlDropdown">
                                                    <a class="dropdown-item" href="#">Maquiagem</a>
                                                    <a class="dropdown-item" href="#">Batom</a>
                                                    <a class="dropdown-item" href="#">Gloss</a>
                                                    <a class="dropdown-item" href="#">Blush</a>
                                                    <a class="dropdown-item" href="#">Primer</a>
                                                    <a class="dropdown-item" href="#">Pó Compacto</a>
                                                    <a class="dropdown-item" href="#">Iluminador</a>
                                                    <a class="dropdown-item" href="#">Corretivo</a>
                                                    <a class="dropdown-item" href="#">Delineador</a>
                                                    <a class="dropdown-item" href="#">Máscara</a>
                                                    <a class="dropdown-item" href="#">Glitter</a>
                                                    <a class="dropdown-item" href="#">Lápis</a>
                                                    <a class="dropdown-item" href="#">Maletas</a>
                                                    <a class="dropdown-item" href="#">Pincel</a>
                                                    <a class="dropdown-item" href="#">Esmalte</a>
                                                    <a class="dropdown-item" href="#">Acessórios</a>
                                                </div>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="karlDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Moda</a>
                                                <div class="dropdown-menu" aria-labelledby="karlDropdown">
                                                    <a class="dropdown-item" href="#">Masculino</a>
                                                    <a class="dropdown-item" href="#">Cuecas</a>
                                                    <a class="dropdown-item" href="#">Sungas</a>
                                                    <a class="dropdown-item" href="#">Feminino</a>
                                                    <a class="dropdown-item" href="#">Vestido</a>
                                                    <a class="dropdown-item" href="#">Conjunto</a>
                                                </div>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="karlDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Promoções</a>
                                                <div class="dropdown-menu" aria-labelledby="karlDropdown">
                                                    <a class="dropdown-item" href="#">Kits e Combos</a>
                                                    <a class="dropdown-item" href="#">Preços Baixos</a>
                                                    <a class="dropdown-item" href="#">Outlet</a>
                                                </div>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" href=" {{ route('products.page') }}">Produtos</a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;


                            <!-- Carrinho -->
                            <div class="cart">

                                @if(Session::get('qtCart') == 0)

                                    <a href="{{ route('cart.page') }}" id="header-cart-btn">
                                        <span class="cart_quantity">0</span>
                                        <i class="fa fa-shopping-cart"></i>Carrinho
                                    </a>

                                @else

                                    <a href="{{ route('cart.page') }}" id="header-cart-btn">
                                        <span class="cart_quantity">{{ Session::get('qtCart') }}</span>
                                        <i class="fa fa-shopping-cart"></i>Carrinho
                                    </a>

                                @endif

                                <!-- Cart List Area Start -->
                                <ul class="cart-list">
                                    <li>
                                        <a href="#" class="image">
                                            <img src="{{ asset('img/app/product-img/product-10.jpg') }}" class="cart-thumb" alt="">
                                        </a>
                                        <div class="cart-item-desc">
                                            <h6><a href="#">Womens Fashion</a></h6>
                                            <p>1x - <span class="price">R$10</span></p>
                                        </div>
                                        <span class="dropdown-product-remove">
                                            <i class="icon-cross"></i>
                                        </span>
                                    </li>
                                    <li>
                                        <a href="#" class="image">
                                            <img src="{{ asset('img/app/product-img/product-11.jpg') }}"
                                                 class="cart-thumb" alt=""></a>
                                        <div class="cart-item-desc">
                                            <h6><a href="#">Womens Fashion</a></h6>
                                            <p>1x - <span class="price">R$10</span></p>
                                        </div>
                                        <span class="dropdown-product-remove"><i class="icon-cross"></i></span>
                                    </li>
                                    <li class="total">
                                        <span class="pull-right">Total: R$20.00</span>
                                        <a href="#" class="btn btn-sm btn-cart">Carrinho</a>
                                        <a href="#" class="btn btn-sm btn-checkout">Conferir</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="header-right-side-menu ml-15">
                                <div class="dropdown show">
                                    <a href="javascript:void(0);" class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        @if(Auth::check())
                                            <span>&nbsp;{{ Auth::user()->nm_cliente }}</span>
                                        @endif
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        @if(Auth::check())

                                            <a class="dropdown-item" href="{{ route('client.dashboard') }}">Minha Conta</a>
                                            <a class="dropdown-item" href="{{ route('client.logout') }}">Sair</a>

                                        @else

                                            <a class="dropdown-item" href="{{ route('client.login') }}">Fazer login</a>
                                            <a class="dropdown-item" href="{{ route('client.register') }}">Cadastrar</a>

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    $(document).ready(function(){
        $('.dropdown-submenu a.test').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
    });
</script>
