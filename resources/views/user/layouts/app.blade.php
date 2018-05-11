<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    @include('user.layouts.head')

    <title></title>
  </head>
  <body>
      @include('user.layouts.header')
@section('main-content')

@show
<footer>
  @include('user.layouts.footer')
</footer>
</div>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="{{ asset('omelas/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('omelas/js/javascript.js') }}"></script>
<script type="text/javascript">
    Stripe.setPublishableKey('pk_test_GryUHqXe48kgNc75J2BovmeN');
</script>
<script src="{{asset('omelas/js/app.js')}}"></script>

  </body>
</html>
