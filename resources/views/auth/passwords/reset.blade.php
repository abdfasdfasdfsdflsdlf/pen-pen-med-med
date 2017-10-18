@extends('penmedia.layouts.auth')

@section('htmlheader_title')
    @lang('penmedia\common::common.label.reset-password')
@endsection

@section('content')

    <body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <!-- <a href="{{ url('/home') }}"><b>{{ Common::getByKey('sitename_part1') }} </b>{{ Common::getByKey('sitename_part2') }}</a> -->
            {!! Common::getSiteLogo('site_logo') !!}
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                @lang('common.error.input-issue')<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="login-box-body">
            <p class="login-box-msg">@lang('penmedia\common::common.label.reset-password')</p>
            {{ Former::framework('Nude') }}
            {!! Former::horizontal_open()->action('/password/reset')->method('post') !!}
            {!! Former::token() !!}
                <div class="form-group has-feedback">
                    {!! Former::text('email')->label(false)->id('email')->addClass('form-control')->placeholder('Email') !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    {!! Former::text('password')->type('password')->label(false)->id('password')->addClass('form-control')->placeholder('Password') !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    {!! Former::text('password_confirmation')->type('password')->label(false)->id('password')->addClass('form-control')->placeholder('Password') !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('penmedia\common::common.label.reset-password')</button>
                    </div>
                </div>
            {!! Former::close() !!}

            <a href="{{ url('/login') }}">@lang('penmedia\common::common.label.sign-in')</a><br>

        </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->

    @include('penmedia.layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    </body>

@endsection
