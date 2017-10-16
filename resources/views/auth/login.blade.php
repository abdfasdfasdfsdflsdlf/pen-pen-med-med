@extends('la.layouts.auth')

@section('htmlheader_title')
    @lang('penmedia\common::common.label.sign-in')
@endsection

@section('content')
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <!-- <a href="{{ url('/home') }}"><b>{{ Common::getByKey('sitename_part1') }} </b>{{ Common::getByKey('sitename_part2') }}</a> -->
            {!! Common::getSiteLogo('site_logo') !!}
        </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            @lang('penmedia\common::common.error.input-issue')<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="login-box-body">
    <p class="login-box-msg">@lang('penmedia\common::common.label.sign-in')</p>
        {{ Former::framework('Nude') }}
        {!! Penmedia_Form::horizontal_open()->action('/login')->method('post') !!}
        {!! Former::token() !!}

        <div class="form-group has-feedback">
            {!! Former::text('email')->label(false)->id('email')->addClass('form-control')->placeholder('Email') !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            {!! Former::text('password')->type('password')->label(false)->id('password')->addClass('form-control')->placeholder('Password') !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        {!! Former::checkbox('remember') !!} &nbsp;&nbsp; @lang('penmedia\common::common.label.remember-me')
                    </label>
                </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('penmedia\common::common.label.sign-in')</button>
            </div><!-- /.col -->
        </div>
    {!! Former::close() !!}

    @include('auth.partials.social_login')

    <a href="{{ url('/password/reset') }}">@lang('penmedia\common::common.label.forgot-password')</a><br>

</div><!-- /.login-box-body -->

</div><!-- /.login-box -->

    @include('la.layouts.partials.scripts_auth')

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
