@extends('layouts.admin.panel')

@section('content')


    <div class="login-box">
    @include('partials.admin._alerts')
        <link rel="stylesheet" href="{{asset('css/admin/_all.css')}}">

        <div class="login-box-body">
            <p class="login-box-msg">Entre para iniciar sua sessão</p>

            <form action="{{ route('admin.login.submit') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" placeholder="Email" required maxlength="35">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Senha" required minlength="6">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                {{--<div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" class="flat-red" style="right: 15px"  name="remember"> Lembrar de mim</label>
                        </div>
                    </div>
                </div>--}}
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                    </div>
                </div>
            </form>

            {{--<div class="social-auth-links text-center">
                <p>- OU -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i>Entre usando o Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i>Entre usando o Google+</a>
            </div>--}}

            <br>
            <a href="{{ route('admin.password.request') }}">Esqueci a minha senha</a><br>
            <a href="{{ route('admin.register' )}}" class="text-center">Registre uma nova conta</a>

        </div>
    </div>

    <script src="{{asset('js/admin/icheck.min.js')}}"></script>
    <script src="{{asset('js/admin/jquery.inputmask.js')}}"></script>
    <script>
        $(function(){
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-blue'
            })
        })
    </script>

@stop





