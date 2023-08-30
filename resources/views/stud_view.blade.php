<!DOCTPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale = 1">
     <title>Clipin</title>

    {{-- PWA --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <meta name="theme-color" content="#000000" />
    <link rel="apple-touch-icon" href="{{ asset('clip.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}"> @laravelPWA
</head>

<style>
    .square {
        height: 20px;
        width: 20px;
        background-color: darkseagreen;
       // position: absolute;
        left: 100px;
        top: 10px;
    }

    .squareb {
        height: 20px;
        width: 20px;
        background-color: pink;
      //  position: absolute;
        left: 200px;
        top: 20px;
    }

    .squarec {
        height: 20px;
        width: 20px;
        background-color: white;
      //  position: absolute;
        left: 275px;
        top: 70px;
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
    html, body {
    max-width: 370px;
    overflow-x: hidden;
    overflow-y: hidden;
    margin:auto;
}
div.scroll {
  background-color: black;
  width: 100%;
  height: 650px;
  overflow-x: hidden;
  overflow-y: auto;
  text-align: center;
  padding: 0,0,0,0;
  border-style: solid;

  margin-top: 120px;
  margin-bottom: 10%;

}

.tableheads{
    position: sticky;
    top: 0;
    /* background-color: hsla(1%, 0%, 100%,0.3); */
    background-color: white;

}


</style>

<form action="/products" method="get">
   @csrf {{csrf_field()}}

    @foreach($loginname as $logins)
    <div>
   <center><label class="bg-warning text-dark  text-centers" style="position: fixed;font-weight:500;left:1%;width:100%;text-align:center">{{$logins->NAME}}</label></center>

   <input type="hidden" value="{{$logins->PW}}" id = "pw" name="pw">
    <input type="hidden" value="{{$logins->NUMBER}}" id = "number" name="no">
    <input type="hidden" value="{{$logins->OUTLETID}}" name="outletid">

    {{-- <input type="text" value="{{$logins->OUTLETCODE}}"> --}}

    </div>
    @endforeach




    <body class="bg-dark" style="width:100%">

        <div id="loader"></div>


            <div class="class" style="border-style:none; float:left; width: 180px; text-align:center; margin-top:5%; ">
                <button type="button" class="btn btn-warning mt-3 p-3 btn-lg text-white" style="position: relative; left:-5px;top:0px;font-size:10px; height:64px; width: 67px;">Sales</button>
                <button type="submit" class="btn btn-danger  mt-3 p-3 btn-lg  text-white" style="position: relative; right;top:0px;font-size:10px;">Product<br>Status</button>
            </div>
</form>
<div style="border-style:none; float:right; width: 180px; height:80px; margin-top:5%; ">
    <div style="border-style:none; border-width: 1px;width: 24px; float:left;">
        <div class="square mt-3"></div>
        <div class="squareb mt-3"></div>
    </div>
    <div style="border-style:none; border-width:1px; width:70px; float:left;">
    <div>
        <label class="text-white" id="label" style="font-size: 10px;  margin-top: 20px;">Complete</label>
    </div>
    <div>
        <label class="text-white" id="label" style="font-size: 10px;  margin-top: 20px;">Confirmed</label>
    </div>
</div>
<div style="border-style:none; border-width: 1px;width: 24px; float:left;">
    <div class="squarec mt-3"></div>
</div>
<div style="border-style:none; border-width:1px; width:40px; float:left;">
    <label class="text-white" id="label" style="font-size: 10px; margin-top: 20px;">Added</label>
</div>


</div>

<!--walkin  Modal -->

<div class="modal fade" id="walkinmodal" data-bs-backdrop="static" style="">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Walk-in</h1>
                <button type="button" class="btn-close btn-lg" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="/walkinput" method="post">
                @csrf {{ csrf_field() }}
                <input type="hidden" name="walkinid" id="walkinid" value="" required>
                <input type="hidden" name="walkprod" id="walkprod" value="">

                <span class="input-group-text" id="inputGroup-sizing-default">Input number:</span>
                <input type="number" name="walkino" class="form-control" value="" min="0" placeholder="type here..." required>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
            </form>
            </div>
        </div>
    </div>
</div>

{{-- end of modal walk in --}}
 {{-- order recieved modal --}}
<div class="modal fade" tabindex="-1" id="recievedmodal">
    <div class="modal-dialog" style="text-align:center;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>New order recieved.</p>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
{{-- complete modal --}}
<div class="modal fade" id="completemodal" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="1" style="">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Complete</h1>
                <button type="button" class="btn-close btn-lg" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="/completeinput" method="post">
                @csrf {{ csrf_field() }}
                <input type="hidden" name="completeid" id="completeid" value="" required>
                <input type="hidden" name="compprod" id="compprod" value="">
                {{-- <input type="hidden" name="composdid" id="composdid" value=""> --}}

                <span class="input-group-text" id="inputGroup-sizing-default">Input number:</span>
                <input type="number" name="completeno" class="form-control" value="" min="0" placeholder="type here..." required>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
            </form>
            </div>
        </div>
    </div>
</div>
{{-- Main Table --}}


<div class="scroll" id="my-div">
<div id="refreshthis" class="mydiv" style="" >
    <div class="row">
        <div class="col">
            <table class="table table-hover bg-light w-95 table-bordered border-black table" style="position: inherit;width:370px;top:13%; left:-5px;" border="4" id="thtable">
                <thead class=" ">
                    <tr class="tableheads">
                        <th scope="col" style="font-weight: bold;font-size:10px;">OS#</th>
                        <th scope="col" style="font-weight: bold;font-size:10px;">Description</th>
                        <th scope="col" style="font-weight: bold;font-size:10px">QTY</th>
                        <th scope="col" style="font-weight: bold;font-size:10px">W</th>
                        <th scope="col" style="font-weight: bold;font-size:10px">C</th>
                        <th scope="col" style="font-weight: bold;font-size:10px">SC</th>
                        <th scope="col" style="font-weight: bold;font-size:10px">OPERATIONS</th>



                    </tr>
                </thead>
                <tbody id="table" >

                    {{-- change color according to table values --}} @foreach ($tdata as $user)
                    @if ($user->AVAILABLE > $user->DELIVEREDQTY)


                    <tr>

                        <td style="font-weight: bold;font-size:10px;background-color:pink" id="tdid">{{ $user->ORDERSLIPNO }}</td>

                        <td style="font-weight: bold;font-size:10px;background-color:pink">{{$user->DESCRIPTION}}<br> <p class="text-primary">{{$user->REMARKS}}</p></td>
                        <td style="font-weight: bold;font-size:10px;background-color:pink ">{{$user->AVAILABLE}}</td>


                        <td style="font-weight: bold;font-size:10px;background-color:pink">{{ $user->CLAIMED}}</td>
                        <td style="font-weight: bold;font-size:10px;background-color:pink">{{ $user->DELIVEREDQTY}}</td>
                        <td style="font-weight: bold;font-size:10px;;background-color:pink">{{ $user->SC_COUNT}}</td>


                        <td class="text-center" style="background-color:pink">

                            <button type="submit" class='btn btn-primary btn-hover p-3 btn-sm' style="width:60px;font-size:8px" id="walkinbtn" onclick="walkinfetchid({{$user->ORDERSLIPNO}},{{$user->PRODUCT_ID}})">Walk-in</button>


                            @if($user->AVAILABLE != 1)
                            <button type="submit" class='btn btn-success btn-sm p-3 btn-hover ' style="width:60px;font-size:8px" onclick="completefetchid({{$user->ORDERSLIPNO}},{{$user->ORDERSLIPDETAILID}})" >Complete</button>

                            @else
                          <form action="/completesingle" method="POST">
                                @csrf {{ csrf_field() }}
                                <input type="hidden" name="completenob" id="completenob" value="1">
                                <input type="hidden" name = "completeidb" id="completeidb" value="{{$user->ORDERSLIPNO}}">

                                <input type="hidden" name="compprodb" id="compprodb" value="{{$user->ORDERSLIPDETAILID}}">
                                <button type="submit" class='btn btn-success btn-sm p-3 btn-hover ' style="width:60px;font-size:8px" >Complete</button>
                            </form>

                        @endif

                    </tr>
                @elseif ($user->DELIVEREDQTY == $user->AVAILABLE && $user->AVAILABLE > 0)
                    <tr>
                        <td style="font-weight: bold;font-size:10px;background-color:darkseagreen" id="tdid">{{ $user->ORDERSLIPNO }}</td>
                        <td style="font-weight: bold;font-size:10px;width:39%;background-color:darkseagreen">{{$user->DESCRIPTION}}<br><p class="text-primary">{{$user->REMARKS}}</p></td>
                        <td style="font-weight: bold;font-size:10px;width:12%;background-color:darkseagreen " class="qty">{{$user->AVAILABLE}}</td>
                        <td style="font-weight: bold;font-size:10px;background-color:darkseagreen">{{ $user->CLAIMED}}</td>
                        <td style="font-weight: bold;font-size:10px;background-color:darkseagreen">{{ $user->DELIVEREDQTY}}</td>
                        <td style="font-weight: bold;font-size:10px;background-color:darkseagreen">{{ $user->SC_COUNT}}</td>
                        <td class="text-center" style="width: 23.5%;background-color:darkseagreen">
                            <button type="submit" class='btn btn-primary btn-hover p-3 btn-sm' style="width:60px;font-size:8px" id="walkinbtn" onclick="walkinfetchid({{$user->ORDERSLIPNO}},{{$user->PRODUCT_ID}})">Walk-in</button>

                        <button type="submit" class='btn btn-success btn-sm p-3 btn-hover text-center' style="width:60px;font-size:8px" onclick="completefetchid({{$user->ORDERSLIPNO}},{{$user->PRODUCT_ID}})" disabled>Complete</button></td>

                        </td>
                    </tr>

                    @elseif($user->AVAILABLE ==null && $user->DELIVEREDQTY ==null || $user->AVAILABLE < 1 && $user->DELIVEREDQTY < 1 )


                    <tr>
                        <td style="font-weight: bold;font-size:10px;background-color:white" id="tdid">{{ $user->ORDERSLIPNO }}</td>
                        <td style="font-weight: bold;font-size:10px;width:39%;background-color:white">{{$user->DESCRIPTION}}<br><p class="text-primary">{{$user->REMARKS}}</p></td>
                        <td style="font-weight: bold;font-size:10px;width:12%;background-color:white " class="qty">{{$user->AVAILABLE}}</td>
                        <td style="font-weight: bold;font-size:10px;background-color:white">{{ $user->CLAIMED}}</td>
                        <td style="font-weight: bold;font-size:10px;background-color:white">{{ $user->DELIVEREDQTY}}</td>
                        <td style="font-weight: bold;font-size:10px;background-color:white">{{ $user->SC_COUNT}}</td>
                        <td class="text-center" style="width: 23.5%;background-color:white">
                            <button type="submit" class='btn btn-primary btn-hover p-3 btn-sm' style="width:60px;font-size:8px" id="walkinbtn" onclick="walkinfetchid({{$user->ORDERSLIPNO}},{{$user->PRODUCT_ID}})" disabled>Walk-in</button>


                            <button type="submit" class='btn btn-success btn-sm p-3 btn-hover ' style="width:60px;font-size:8px" onclick="completefetchid({{$user->ORDERSLIPNO}},{{$user->PRODUCT_ID}})" disabled>Complete</button>

                        </td>
                    </tr>

                            @endif @endforeach




                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
{{-- automatically refreshes the table every 2 secs --}}
<script type="text/javascript">
    const myinterval = setInterval(refressh, 2000);


    function refressh() {
        $('#refreshthis').load(document.URL + " #refreshthis");

    }

    function walkinfetchid(id,prod) {
        $('#walkinmodal').modal('show');
        $('#walkinid').val(id);
        $('#walkprod').val(prod);

    }

    function completefetchid(id,prod) {
        $('#completemodal').modal('show');
        $('#completeid').val(id);
        $('#compprod').val(prod);



    }

    $(window).on('load', function() {
        $('#loader').hide();
    })

    // let previousRowCount = document.getElementById('thtable').rows.length;
    var table = document.getElementById("thtable"); // replace "table-id" with the ID of your table
var count = 0;
for (var i = 0; i < table.rows.length; i++) {
  var row = table.rows[i];
  var cell = row.cells[2];   // replace "0" with the index of the cell you want to check
  var cellb = row.cells[4]
  if (cell.innerHTML > 0 && cellb.innerHTML ==="") { // replace "value-to-check" with the value you want to count
    count++;

  }
}

var previousRowCount = count;
console.log(previousRowCount);

    function checkRowCount() {

        var table = document.getElementById("thtable"); // replace "table-id" with the ID of your table
var count = 0;
for (var i = 0; i < table.rows.length; i++) {
  var row = table.rows[i];
  var cell = row.cells[2];   // replace "0" with the index of the cell you want to check
  var cellb = row.cells[4]
  if (cell.innerHTML > 0 && cellb.innerHTML ==="") { // replace "value-to-check" with the value you want to count
    count++;

  }
}

var currentRowCount = count;
console.log(currentRowCount);
        //this
        // const currentRowCount = document.getElementById('thtable').rows.length;
        if (currentRowCount > previousRowCount) {
            const audio = new Audio('Audio/notification.mp3');
            audio.play();

            $('#recievedmodal').modal('show');
        }
        previousRowCount = currentRowCount;
    }

    // Call the checkRowCount function every 2 seconds
    setInterval(checkRowCount, 2000);

    const myDiv = document.getElementById('my-div');
myDiv.addEventListener('scroll', () => {
  localStorage.setItem('scrollPosition', myDiv.scrollTop);
});
const savedScrollPosition = localStorage.getItem('scrollPosition');
if (savedScrollPosition) {
  myDiv.scrollTop = savedScrollPosition;
}
</script>
{{-- end of the table --}}

</body>

</html>
