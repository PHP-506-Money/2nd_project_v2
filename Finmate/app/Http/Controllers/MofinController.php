<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : ApiController.php
 * History      : v001 0615 Choi new
 *******************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class MofinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $id = session('userno');
        $result = User::find($id);
        $result1 = DB::table('iteminfos AS info')
        ->select('info.itemname')
        ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
        ->where('tem.userno', 4)
        ->orderBy('info.itemno', 'ASC')
        ->get();
        return view('mofin')->with('data',$result)->with('data1',$result1);
        // return view('mofin');
    }

    public function point($id)
    {
        
        $result = User::find($id);

        if($result->point < 100 ){
            $errmsg = '포인트가부족합니다!';
            return view('mofin')->with('data',$result)->with('pt1',$errmsg);
        }

        else{
            $result->point -= 100;
            $randompoint = rand(1,199);
            $result->point += $randompoint;
            $result->save();
            $randompoint = $randompoint."당첨되셨습니다";
            return view('mofin')->with('data',$result)->with('pt1',$randompoint);
        }

    }

    public function item($id)
    {
        $result = User::find($id);
        $randomitem = rand(1,5);
        $data['userno'] = $id;
        $data['itemno'] = $randomitem;
        DB::table('items')->insert($data);
        $pt1 =  DB::table('iteminfos')->where('itemno', $randomitem)->value('itemname');
        $pt1 = '축하합니다. '.$pt1.' 아이템 당첨';
        return view('mofin')->with('data',$result)->with('pt1',$pt1);

        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $result = User::find($id);
        // return view('mofin')->with('data',$result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
