<!DOCTYPE html>
<html lang="en">
@section('htmlheader')
	@include('common::layouts.partials.htmlheader')
@show

<body data-spy="scroll" data-offset="0" data-target="#navigation">
@section('mainheader')
	@include('common::layouts.partials.mainheader')
@show

@yield('main-content')


<div id="c">
    <div class="container">
        <p>
            <strong>Copyright &copy; 2017. Powered by <a href="https://www.technostargroup.in"><b>Technostar Group</b></a>
        </p>
    </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('/penmedia/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script>
    $('.carousel').carousel({
        interval: 3500
    })
</script>
</body>
</html>
