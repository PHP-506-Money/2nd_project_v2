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
        $current_user_id = auth()->user()->userid;
        if ($current_user_id != $id) {
            return redirect('/unauthorized-access'); // 잘못된 접근 페이지로 리다이렉트
        }
        //유저의 포인트를 조회
        $result  = DB::table('users')
        ->where('userid', $id)
        ->first();

        //유저가 가진 아이템을 조회
        $item_name = DB::table('iteminfos AS info')
        ->select('info.itemname')
        ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
        ->where('tem.userid', $id)
        ->orderBy('info.itemno', 'ASC')
        ->pluck('itemname')//아이템 이름반환(컬렉션 객체)
        ->toArray();// 컬렉션 객체를 다시 배열로 바꿔줌

        $itemonly = array_unique($item_name);// 유저가 가진 아이템이 중복값이 많아서 출력할때 중복값 제거하기위해서 unique써서 $itemonly에 담아줌
        return view('mofin')->with('data',$result)->with('itemname', $itemonly);

    }

    public function point($id)
    {
        // 유저의 포인트 조회
        $result  = DB::table('users')
        ->where('userid', $id)
        ->first();
        //포인트가 100미만일경우
        if($result->point < 100 ){

            $pt1 = '포인트가부족합니다!';
            session()->flash('pt1', $pt1);
            $item_name = DB::table('iteminfos AS info')
            ->select('info.itemname')
            ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
            ->where('tem.userid', $id)
            ->orderBy('info.itemno', 'ASC')
            ->pluck('itemname')
            ->toArray();
            
            $itemonly = array_unique($item_name);
            return redirect()->route('mofin.index', ['userid' => $id])->with('data', $result)->with('itemname', $itemonly);
        }
        //포인트가 100 이상일경우
        else{
        // 1~199 사이의 랜덤숫자를 $randompoint 에 담아줌
        $randompoint = rand(1, 199);
        // 회원의 포인트에서 100을 뺀 후 $randompoint 를 더해서 $newpoint에 담아줌
        $newPoint = $result->point - 100 + $randompoint;
        
        //$newpoint 를 회원의 point 에 대입
        DB::table('users')
            ->where('userid', $id)
            ->update(['point' =>$newPoint, 'point_draw_count' => $result->point_draw_count + 1]);

        $randompoint = $randompoint . " 당첨되셨습니다";
        
        // 일회성으로 세션에 $randompoint 를 담아줌
        session()->flash('pt1', $randompoint);

            $item_name = DB::table('iteminfos AS info')
            ->select('info.itemname')
            ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
            ->where('tem.userid', $id)
            ->orderBy('info.itemno', 'ASC')
            ->pluck('itemname')
            ->toArray();
        
            $itemonly = array_unique($item_name);
            return redirect()->route('mofin.index', ['userid' => $id])->with('data', $result)->with('itemname', $itemonly);
        }

    }

    public function item($id)
    {
        $result  = DB::table('users')
        ->where('userid', $id)
        ->first();

        //포인트가 500 이상일때
        if($result->point >= 500)
        {
        $newPoint = $result->point -= 500;
        //회원포인트에서 500을빼서 newpoint 에 담고 회원포인트에 대입해줌
        DB::table('users')
        ->where('userid', $id)
        ->update(['point' =>$newPoint, 'item_draw_count' => $result->item_draw_count + 1]);

        $randomitem = rand(1,13); // 랜덤으로 아이템번호 1~12
        $data['userno'] = $result->userno;
        $data['userid'] = $id;
        $data['itemno'] = $randomitem;
        DB::table('items')->insert($data); // 당첨된 아이템번호로 items 테이블에 추가
        $pt1 =  DB::table('iteminfos')->where('itemno', $randomitem)->value('itemname');//당첨된 아이템 번호를 기준으로 iteminfos 테이블에서 아이템명 가지고오기
        $pt1 = '축하합니다. '.$pt1.' 아이템 당첨';

        session()->flash('pt1', $pt1);// $pt 를 세션에 일회성으로 담아줌

        $item_name = DB::table('iteminfos AS info')
        ->select('info.itemname')
        ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
        ->where('tem.userid', $id)
        ->orderBy('info.itemno', 'ASC')
        ->pluck('itemname')
        ->toArray();

        $itemonly = array_unique($item_name);
        return redirect()->route('mofin.index', ['userid' => $id])->with('data', $result)->with('itemname', $itemonly);

        }
        //포인트가 500 미만일경우
        else
        {
            $pt1 = '포인트가부족합니다!';
            session()->flash('pt1', $pt1);

            $item_name = DB::table('iteminfos AS info')
            ->select('info.itemname')
            ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
            ->where('tem.userid', $id)
            ->orderBy('info.itemno', 'ASC')
            ->pluck('itemname')
            ->toArray();
            
            $itemonly = array_unique($item_name);       
            return redirect()->route('mofin.index', ['userid' => $id])->with('data', $result)->with('itemname', $itemonly);
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
