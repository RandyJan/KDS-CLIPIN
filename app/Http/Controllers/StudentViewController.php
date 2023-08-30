<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\ElseIf_;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\DB;

class StudentViewController extends Controller
{

    public function index(Request $request){
        $no = $request->input('no');
        $accountno = DB::select('SELECT OUTLETCODE FROM dbo.Outlets WHERE OUTLETID = ?',[$no]);
        $users = DB::select('SELECT dbo.OrderSLipDetails.*, dbo.parts.DESCRIPTION
        FROM dbo.OrderSLipDetails
        LEFT JOIN dbo.parts
        ON
        dbo.OrderSLipDetails.PRODUCT_ID=dbo.parts.PRODUCT_ID AND dbo.OrderSLipDetails.DISPLAYMONITOR = 1 AND dbo.OrderSlipDetails.OUTLETCODE = ?
        ORDER BY ORDERSLIPNO ASC',[$accountno]);

        return view('stud_view',['tdata'=>$users])->with('account', $accountno);

        }

        public function product(Request $request){

            $groupcode ='SC04';
            $users = DB::table('dbo.Partslocation')
            ->where('GROUP', $groupcode)
            ->orderBy('SHORTCODE', 'ASC')->SimplePaginate(50);


            return view ('prod_stats', ['prodstats'=>$users]);

        }
        public function product2(){
            $groupcode = 'CHA05';
            $users = DB::table('dbo.Partslocation')
            ->where('GROUP', $groupcode)
            ->orderBy('SHORTCODE', 'ASC')->simplePaginate(50);

            return view ('chatimeprod', ['prodstats'=>$users]);

        }
        public function product3(){
            $groupcode = 'SEL03';
            $users = DB::table('dbo.Partslocation')
            ->where('GROUP', $groupcode)
            ->orderBy('SHORTCODE', 'ASC')->simplePaginate(50);

            return view ('selectprod', ['prodstats'=>$users]);

        }
        public function product4(){
            $groupcode = 'PPC06';
            $users = DB::table('dbo.Partslocation')
            ->where('GROUP', $groupcode)
            ->orderBy('SHORTCODE', 'ASC')->simplePaginate(50);

            return view ('potatocornerprod', ['prodstats'=>$users]);
        }

    public function edit(Request $request)
    {
        $claim = $request->input('id');

       DB::update('UPDATE dbo.OrderSLipDetails SET DELIVEREDQTY = 1 WHERE ORDERSLIPNO = ? ', [$claim]);



        return redirect()->back();


    }
    public function prodeditn(Request $request){
        $prodeditn = $request->input('id');
        $prodeditval = $request->input('N');
        DB::update('UPDATE dbo.PartsLocation SET [STATUS] = ? WHERE PRODUCT_ID = ?', [$prodeditval,$prodeditn]);

        return redirect()->back();
    }
    public function prodedita(Request $request){
        $prodedita = $request->input('id');
        $prodeditval = $request->input('A');
        DB::update('UPDATE dbo.PartsLocation SET [STATUS] = ? WHERE PRODUCT_ID = ?', [$prodeditval,$prodedita]);
        return redirect()->back();

    }
    public function walkininput(Request $request){
    $walkinids = $request->input('walkinid');
    $walkinprod = $request->input('walkprod');
    $walkino = $request->input('walkino');
    DB::update('UPDATE dbo.OrderSLipDetails SET CLAIMED =? WHERE ORDERSLIPNO = ? and PRODUCT_ID = ?',[$walkino,$walkinids,$walkinprod]);
    return redirect()->back();
 }
 public function logincredentials(Request $request){
    $id =$request->input('no');
    $pw = $request->input('pw');

$logincreds = DB::select('SELECT PW,[NUMBER],[NAME],OUTLETID FROM dbo.UserDevices WHERE [NUMBER] = ? and PW = ?',[$id,$pw]);


  if($logincreds == null){
   echo '<script> alert("Invalid ID or password please try again."); </script>';
    return view('loginmain');

  }
  else{
    $name = DB::table('dbo.UserDevices')
    ->where('PW', $pw)
    ->where('NUMBER',$id)
    ->value('OUTLETID');

    $thecode = DB::table('dbo.Outlets')
    ->where('OUTLETID', $name)
    ->value('OUTLETCODE');

$users = DB::select('SELECT dbo.OrderSLipDetails.*, dbo.parts.DESCRIPTION
FROM dbo.OrderSLipDetails
LEFT JOIN dbo.parts
ON
dbo.OrderSLipDetails.PRODUCT_ID=dbo.parts.PRODUCT_ID
 WHERE dbo.OrderSLipDetails.LOCATIONID = ? AND  dbo.OrderSLipDetails.DISPLAYMONITOR = 1 ORDER BY ORDERSLIPNO ASC',[$thecode]);

  return view('stud_view',['loginname'=>$logincreds,'tdata'=>$users,'code'=>$thecode]);
}



 }
    public function userlogin(Request $request){
        $data = $request->input();

            $request->session()->put('id'.$data['id']);
            echo session('id');
    }

    public function back(Request $request){
        $pw = $request->input('pw');
            $no = $request->input('no');
            $outletid = $request->input('outletid');

            if($outletid==4){
                $logincreds = DB::select('SELECT PW,[NAME],[NUMBER] FROM dbo.UserDevices WHERE PW = ? AND [NUMBER] = ?',[$pw,$no]);
                return view('back',['logincred'=>$logincreds]);

            }
            elseif($outletid==6){
                $logincreds = DB::select('SELECT PW,[NAME],[NUMBER] FROM dbo.UserDevices WHERE PW = ? AND [NUMBER] = ?',[$pw,$no]);
                return view('potatocorner',['logincred'=>$logincreds]);
            }
            elseif($outletid==5){
                $logincreds = DB::select('SELECT PW,[NAME],[NUMBER] FROM dbo.UserDevices WHERE PW = ? AND [NUMBER] = ?',[$pw,$no]);
                return view('chatime',['logincred'=>$logincreds]);

            }
            elseif($no==3){
                $logincreds = DB::select('SELECT PW,[NAME],[NUMBER] FROM dbo.UserDevices WHERE PW = ? AND [NUMBER] = ?',[$pw,$no]);
                return view('select',['logincred'=>$logincreds]);
            }

    }
 public function completeinput(Request $request){
    $completeid = $request->input('completeid');
    $completeno = $request->input('completeno');
    $compprod = $request->input('compprod');
    // $composdid = $request->input('composdid');

    $status = 'C';
    $available = DB::table('dbo.OrderSLipDetails')
->where('ORDERSLIPNO', $completeid)
->where('ORDERSLIPDETAILID', $compprod)
->value('AVAILABLE');
$deliveredqty = DB::table('dbo.OrderSLipDetails')
->where('ORDERSLIPNO', $completeid)
->where('ORDERSLIPDETAILID', $compprod)
->value('DELIVEREDQTY');


if($completeno > $available){
    return response()->json([
        'status'=> 500,
        'message'=>"error C cannot be greater than QTY"
    ]);
}
else{


DB::update('UPDATE dbo.OrderSLipDetails SET DELIVEREDQTY =? WHERE ORDERSLIPNO = ? and ORDERSLIPDETAILID = ?',[$completeno,$completeid,$compprod]);
$available = DB::table('dbo.OrderSLipDetails')
->where('ORDERSLIPNO', $completeid)
->where('ORDERSLIPDETAILID', $compprod)
->value('AVAILABLE');
$deliveredqty = DB::table('dbo.OrderSLipDetails')
->where('ORDERSLIPNO', $completeid)
->where('ORDERSLIPDETAILID', $compprod)
->value('DELIVEREDQTY');



    if($available==$deliveredqty){
        DB::update('UPDATE dbo.OrderSLipDetails SET DELIVEREDQTY =?, STATUS = ? WHERE ORDERSLIPNO = ? and ORDERSLIPDETAILID = ?',[$completeno,$status,$completeid,$compprod]);

        return redirect()->back();
    }
    // elseif($deliveredqty>$available){

    //     return response()->json([
    //         'status'=> 500,
    //         'message'=>"C cannot be greater than QTY"
    //     ]);
    // }

    return redirect()->back();
}


 }
 public function completesingleinput(Request $request){
    $completeid = $request->input('completeidb');
    $completeno = $request->input('completenob');
    $compprod = $request->input('compprodb');

    $status = 'C';
    print "1";
    DB::update('UPDATE dbo.OrderSLipDetails SET DELIVEREDQTY =?,STATUS = ? WHERE ORDERSLIPNO = ? and ORDERSLIPDETAILID = ?',[$completeno,$status,$completeid,$compprod]);
    return redirect()->back();

 }
    }
