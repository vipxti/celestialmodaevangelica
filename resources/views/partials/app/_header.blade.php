<script src="{{asset('js/app/popper.min.js')}}"></script>
<header class="header_area">
    <!-- Top Header Area Start -->
    <div class="top_header_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-end">
                <div class="col-12 col-lg-7">
                    <div class="top_single_area d-flex align-items-center">
                        <!-- Logo Area -->
                        <div class="top_logo">
                            <a href="{{route('index')}}"><img src="{{ asset('img/app/core-img/logo.png') }}" alt=""></a>
                        </div>
                        <!--Carrinho e Menu Area -->
                        <div class="header-cart-menu d-flex align-items-center ml-auto">
                            <!-- Cart Area -->
                            <div class="cart">
                                <a href="{{ route('checkout.page') }}" id="header-cart-btn" target="_blank"><span class="cart_quantity">0</span>
                                    <i class="fa fa-shopping-cart"></i>Carrinho R$20,00</a>
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
                                            <a class="dropdown-item" href="#">Meus Pedidos</a>
                                            <a class="dropdown-item" href="{{ route('client.logout') }}">Sair</a>

                                        @else

                                            <a class="dropdown-item" href="{{ route('client.login') }}">Fazer login</a>
                                            <a class="dropdown-item" href="{{ route('client.register') }}">Cadastrar</a>
                                            
                                        @endif
                                        </div>

                                </div>


                                <!--<ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <!--<a href="">
                                        <a href="#">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>-->
                                  <!-- <div class="dropdown show">
                                       <a class="btn btn-secondary dropdown-toggle" href="https://example.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                           Dropdown link
                                       </a>

                                       <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                           <a class="dropdown-item" href="#">Action</a>
                                           <a class="dropdown-item" href="#">Another action</a>
                                           <a class="dropdown-item" href="#">Something else here</a>
                                       </div>
                                   </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Header Area End -->
    <div class="main_header_area">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 d-md-flex justify-content-between">
                    <!-- Header Social Area -->
                    <div class="header-social-area">
                        {{--<a href="https://www.instagram.com/celestial_moda_evangelica/?hl=pt-br"><span class="karl-level">Compartilhar</span>
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                        <a href="https://www.facebook.com/Celestial-Moda-Evang%C3%A9lica-480913635394202/"><i class="fa fa-facebook" aria-hidden="true"></i></a>--}}
                    </div>

                    <!-- Menu Area -->
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
                                        <a class="nav-link dropdown-toggle" href="#" id="karlDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acessórios</a>
                                        <div class="dropdown-menu" aria-labelledby="karlDropdown">
                                            <a class="dropdown-item" href="#">Bolsas</a>
                                            <a class="dropdown-item" href="#">Carteiras</a>
                                            <a class="dropdown-item" href="#">Cintos</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="karlDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blazer</a>
                                        <div class="dropdown-menu" aria-labelledby="karlDropdown">
                                            <a class="dropdown-item" href="#">Cardigan</a>
                                            <a class="dropdown-item" href="#">Casacos</a>
                                            <a class="dropdown-item" href="#">Jaquetas</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="karlDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blusas</a>
                                        <div class="dropdown-menu" aria-labelledby="karlDropdown">
                                            <a class="dropdown-item" href="#">Body</a>
                                            <a class="dropdown-item" href="#">Camisas</a>
                                            <a class="dropdown-item" href="#">Curta</a>
                                            <a class="dropdown-item" href="#">Longa</a>
                                            <a class="dropdown-item" href="#">Maga</a>
                                            <a class="dropdown-item" href="#">Manga</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="karlDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Outlet</a>
                                        <div class="dropdown-menu" aria-labelledby="karlDropdown">
                                            <a class="dropdown-item" href="#">Queima de Estoque</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="karlDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Plus Size</a>
                                        <div class="dropdown-menu" aria-labelledby="karlDropdown">
                                            <a class="dropdown-item" href="#">Blusas</a>
                                            <a class="dropdown-item" href="#">Saias</a>
                                            <a class="dropdown-item" href="#">Vestidos</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="karlDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Saias</a>
                                        <div class="dropdown-menu" aria-labelledby="karlDropdown">
                                            <a class="dropdown-item" href="#">Evazê</a>
                                            <a class="dropdown-item" href="#">Jeans</a>
                                            <a class="dropdown-item" href="#">Lápis</a>
                                            <a class="dropdown-item" href="#">Longa</a>
                                            <a class="dropdown-item" href="#">Mid</a>
                                            <a class="dropdown-item" href="#">Secretária</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="karlDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Vestido</a>
                                        <div class="dropdown-menu" aria-labelledby="karlDropdown">
                                            <a class="dropdown-item" href="#">Longo</a>
                                            <a class="dropdown-item" href="#">Godê</a>
                                            <a class="dropdown-item" href="#">Malha</a>
                                            <a class="dropdown-item" href="#">Mid</a>
                                            <a class="dropdown-item" href="#">Jeans</a>
                                            <a class="dropdown-item" href="#">Tubinho</a>
                                        </div>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href=" {{ route('products.page') }}">Produtos</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <!-- Help Line -->
                    <div class="help-line">
                        <a href="https://api.whatsapp.com/send?phone=5513988825540&text=Olá" target="_blank"><i class="fa fa-whatsapp"></i>&nbsp &nbsp(13) 98858-6788</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</header>
