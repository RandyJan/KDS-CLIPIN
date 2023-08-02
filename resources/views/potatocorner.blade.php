<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale = 1, user-scalable =no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <title>Product Status</title>
</head>
<style>
    html, body {
    max-width: 370px;
    overflow-x: hidden;
    overflow-y:hidden;
    margin:auto;

}
</style>
<body class="bg-dark">
    <div class="container">
        @foreach ($logincred as $logincreds )
        <center>
         <h1 style="position: absolute;top:10px;left:120px;width:200px;font-size:100%" class="bg-warning">{{$logincreds->NAME}}</h1>
        </center>
        <form action="/loginsuccessful" method="get">
            @csrf
         <input type="hidden" value="{{$logincreds->PW}}" name="pw">
         <input type="hidden" value="{{$logincreds->NUMBER}}" name="no">
         <button type="submit" class="btn btn-danger btn-sm p-2 mt-2" style="position: relative;width:100px">Back</button>

        </form>
         @endforeach
        <iframe src="{{ url('/potatocorner') }}" style="width: 100%;height:900px"></iframe>
    </div>
</body>
</html>
