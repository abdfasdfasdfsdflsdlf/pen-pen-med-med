@extends('penmedia.layouts.auth')

@section('htmlheader_title')
    @lang('penmedia\common::common.label.register')
@endsection

@section('content')

    <body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
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

        <div class="register-box-body">
            <p class="login-box-msg">@lang('penmedia\common::common.label.register-super-admin')</p>
            {{ Former::framework('Nude') }}
            {!! Penmedia_Form::horizontal_open()->action('/register')->method('post') !!}
            {!! Former::token() !!}
                <div class="form-group has-feedback">
                    {!! Former::text('name')->label(false)->id('name')->addClass('form-control')->placeholder('Full name') !!}
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {!! Former::text('email')->label(false)->id('email')->addClass('form-control')->placeholder('Email') !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {!! Former::text('password')->type('password')->label(false)->id('password')->addClass('form-control')->placeholder('Password') !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {!! Former::text('password_confirmation')->type('password')->label(false)->id('password')->addClass('form-control')->placeholder('Retype password') !!}
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                {!! Former::checkbox('terms_condition') !!} &nbsp;&nbsp; @lang('penmedia\common::common.label.terms-condition')
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('penmedia\common::common.label.register')</button>
                    </div><!-- /.col -->
                </div>
            </form>

            @include('auth.partials.social_login')
            <hr>
            <center><a href="{{ url('/login') }}" class="text-center">@lang('penmedia\common::common.label.sign-in')</a></center>
        </div><!-- /.form-box -->
    </div><!-- /.register-box -->

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
