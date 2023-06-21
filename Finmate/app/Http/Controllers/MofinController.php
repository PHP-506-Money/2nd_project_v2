<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : MofinController.php
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

        // $result = User::find($id);
        // $item_name = DB::table('iteminfos AS info')
        // ->select('info.itemname')
        // ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
        // ->where('tem.userno', $id)
        // ->orderBy('info.itemno', 'ASC')
        // ->pluck('itemname')
        // ->toArray();

        $item_name = User::join('items', 'users.userid', '=', 'items.userid')
        ->join('iteminfos', 'iteminfos.itemno', '=', 'items.itemno')
        ->select('iteminfos.itemname', 'users.*')
        ->where('users.userid', $id)
        ->get();

        // $itemonly = array_unique($item_name);

        // $itemonly = implode(',', $itemonly);
        
        return view('mofin')->with('itemname', $item_name);

    }

    public function point($id)
    {
        
        $result = User::find($id);

        if($result->point < 100 ){
            $errmsg = '포인트가부족합니다!';


            $item_name = DB::table('iteminfos AS info')
            ->select('info.itemname')
            ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
            ->where('tem.userno', $id)
            ->orderBy('info.itemno', 'ASC')
            ->pluck('itemname')
            ->toArray();
        
            $itemonly = array_unique($item_name);

            // $itemonly = implode(',', $itemonly);
            
            
        
            return view('mofin')->with('data', $result)->with('itemname', $itemonly)->with('pt1',$errmsg);
        }

        else{
            $result->point -= 100;
            $randompoint = rand(1,199);
            $result->point += $randompoint;
            $result->save();
            $randompoint = $randompoint."당첨되셨습니다";



            $item_name = DB::table('iteminfos AS info')
            ->select('info.itemname')
            ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
            ->where('tem.userno', $id)
            ->orderBy('info.itemno', 'ASC')
            ->pluck('itemname')
            ->toArray();
        
            $itemonly = array_unique($item_name);

            // $itemonly = implode(',', $itemonly);
            
            return view('mofin')->with('data',$result)->with('pt1',$randompoint)->with('itemname', $itemonly);
        }

    }

    public function item($id)
    {
        $result = User::find($id);

        if($result->point >= 500)
        {
        $result->point -= 500;
        $result->save();

        $randomitem = rand(1,5);
        $data['userid'] = $id;
        $data['itemno'] = $randomitem;
        DB::table('items')->insert($data);
        $pt1 =  DB::table('iteminfos')->where('itemno', $randomitem)->value('itemname');
        $pt1 = '축하합니다. '.$pt1.' 아이템 당첨';
        
        $item_name = DB::table('iteminfos AS info')
        ->select('info.itemname')
        ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
        ->where('tem.userno', $id)
        ->orderBy('info.itemno', 'ASC')
        ->pluck('itemname')
        ->toArray();

        $itemonly = array_unique($item_name);

        // $itemonly = implode(',', $itemonly);
        
        return view('mofin')->with('data',$result)->with('pt1',$pt1)->with('itemname', $itemonly);

        }
        else
        {
            $errmsg = '포인트가부족합니다!';


            $item_name = DB::table('iteminfos AS info')
            ->select('info.itemname')
            ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
            ->where('tem.userno', $id)
            ->orderBy('info.itemno', 'ASC')
            ->pluck('itemname')
            ->toArray();
            
            $itemonly = array_unique($item_name);

            // $itemonly = implode(',', $itemonly);
        
            return view('mofin')->with('data', $result)->with('itemname', $itemonly)->with('pt1',$errmsg);
        }
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
