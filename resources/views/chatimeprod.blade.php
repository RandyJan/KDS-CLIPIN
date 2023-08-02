<!DOCTYPE html>
<html lang="en">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale = 1">

    <title>Product Status</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    {{-- PWA --}}
<meta name="theme-color" content="#000000"/>
<link rel="apple-touch-icon" href="{{ asset('clip.PNG') }}">
<link rel="manifest" href="{{ asset('/manifest.json') }}">
@laravelPWA
<style>
        .square {
      height: 15px;
      width: 15px;
      background-color:green;
      position: absolute;
        right:310px;
        top: 10px;
        font-size: 10px
    }
    .squareb {
      height: 15px;
      width: 15px;
      background-color:gray;
      position: absolute;
        right:310px;
        top: -8px;
        font-size: 10px
    }
    #loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 120px;
  height: 120px;
  margin: -76px 0 0 -76px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 }
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom {
  from{ bottom:-100px; opacity:0 }
  to{ bottom:0; opacity:1 }
}
#myDiv {
  display: none;
  text-align: center;
}
html, body {
    max-width: 370px;
    overflow-x: hidden;
    overflow-y:hidden;
    margin:auto;
}
div.scroll {
  background-color: black;
  width: 100%;
  height: 700px;
  overflow-x: hidden;
  overflow-y: auto;
  text-align: center;
  padding: 0;
  border-style: solid;
  border-color: white;
  margin-top: 20px;
}

</style>
</head>
@csrf
<body class = "bg-dark">
    <div id="loader"></div>
    <div>
{{--
@foreach ($logincred as $logincreds )
<input type="text" value="{{$logincreds->NUMBER}}" name="no">
<input type="text" value="{{$logincreds->PW}}" name="pw">

@endforeach --}}


    <div style="position: abosolute; right:50px">
    <div class="square mt-3 text-center text-white" id="A">A</div>
    <label for="A" style="position: absolute;font-size:10px;top:27px;right:268px" class="text-white"> Available</label>
</div>
    <div class="squareb mt-3 text-center text-white">N</div>
    <label for="A" style="position: absolute;right:250px;font-size:10px;top:9px" class="text-white"> Not available</label>






    <div style="position: relative;left:3%; font-size:10px" class="mt-3">
    <center> {{ $prodstats->links() }}</center>
    </div>
    <div class="scroll" id="my-div" style="background-color: white;">
    <div class ="bg-light" id = "prodstats" style="width:100%">
        {{-- main table --}}
    <table class="table table-hover table-bordered border-black" style="width:100%;font-size: 12px">
        <thead>
          <tr class="tableheader" style="position:sticky;top:0;background:#f3f3f3;">
            <th scope="col">Description</th>
            <th scope="col" style="width: 50px">Status</th>

        </tr>
        </thead>
        <tbody>
            @foreach ($prodstats as $prod)
          <tr>
            <th scope="row" >{{$prod->SHORTCODE}}</th>

        <td class = "operations">
            @if ($prod->STATUS == 'N')
            <form action="/notavailable" method = "post">
                @csrf {{ csrf_field() }}
             <input type="hidden" value = "{{$prod->PRODUCT_ID}}" name = "id">
             <input type="hidden" value = "A" name = "N">
            <button type = "submit" class = 'btn btn-secondary btn-hover p-2 btn-sm' style = "width: 40px" onclick="loadpagelocation()">N</button>
            </form>
            <form action="/available" method="post">
                @csrf {{csrf_field()}}
            <button type = "submit" class = 'btn btn-outline-success btn-sm p-2 btn-hover'style = "width: 40px"disabled >A</button>
        </form>
        @else
        <form action="/notavailable" method = "post">
            @csrf {{ csrf_field() }}
        <button type = "submit" class = 'btn btn-outline-secondary btn-hover p-2 btn-sm' style = "width: 40px" disabled>N</button>
        </form>
        <form action="/available" method="post">
            @csrf {{csrf_field()}}
            <input type="hidden" value="{{$prod->PRODUCT_ID}}" name="id">
            <input type="hidden" value="N" name="A">
        <button type = "submit" class = 'btn btn-success btn-sm p-2 btn-hover'style = "width: 40px">A</button>
    </form>

            @endif

        </td>
         </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div style="font-size: 10px">

</div>
</div>
</div>

    {{-- end of main table --}}
    <script type = "text/javascript">

  $(window).on('load', function () {
    $('#loader').hide();

  })



const myDiv = document.getElementById('my-div');


myDiv.addEventListener('scroll', () => {
  localStorage.setItem('scrollPosition', myDiv.scrollTop);
});
const savedScrollPosition = localStorage.getItem('scrollPosition');
if (savedScrollPosition) {
  myDiv.scrollTop = savedScrollPosition;
}
function goBack() {

}


  </script>

</body>
</html>
