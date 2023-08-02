<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="ScreenOrientation" content="autoRotate:disabled">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable = no, maximum-scale = 1">

    <title>Log in</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>{{-- PWA --}}
<meta name="theme-color" content="#000000"/>
<link rel="apple-touch-icon" href="{{ asset('clip.PNG') }}">
<link rel="manifest" href="{{ asset('/manifest.json') }}">
@laravelPWA

<style>
    html, body {
    max-width: 100%;
    overflow-x: hidden;
}
</style>
</head>
  <body  style="background-color: gray">



 <div class="row justify-content-center mt-5" style="background-color: gray;position:relative;top:50px">
    <div class="col-sm-6 mb-3 mb-sm-0 justify-content-center" style="background-color: gray">
      <div class="card justify-content-center">

        <div class="card-body bg-dark text-white">
          <h5 class="card-title text-center text-dark bg-warning">Login</h5>
          <div class = "container mt-5 ">

        <div class="container mt-2">
         <div class="mb-3 ">
            <form action="/loginsuccessful" method="get">
                @csrf {{{ csrf_field() }}}
            <label for="id" class="form-label" style="position: relative; left:25%">ID:</label>
                <center>
            <input type="text" id="id" class="form-control"  placeholder="Enter ID" style = "width:50%" name = "no" maxlength="2" required>
        </center>
          </div>
          <div class="mb-3">
            <label for="pw" class="form-label" style="position: relative; left:25%">Password:</label>
            <center>
            <input type="password" id = "pw" class="form-control" placeholder="Enter Password" style = "width:50%" name = "pw" required>
        </center>
          </div>
          <center>
          <button class = "btn btn-primary btn-sm" style="position: relative; left%">Confirm</button>
        </center>
        </form>
        </div>
        </div>
        </div>
      </div>
    </div>

{{-- barrier --}}

<h5 style="color: gray">rjr</h5>
{{-- <script src="{{ asset('/sw.js') }}"></script> --}}

<script src="{{ asset('/sw.js') }}">
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
</body>

</html>
