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

class MofinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $result = User::find($id);
        return view('mofin')->with('data',$result);
        // return view('mofin');
    }

    public function point()
    {
        $id = 1;
        $result = User::find($id);
        $result->point -= 100;
        $randompoint = rand(1,199);
        $result->point += $randompoint;
        
        $result->save();

        return view('mofin')->with('data',$result)->with('pt1',$randompoint);
        
    }

    public function item()
    {
        $id = 1;
        $data['userno'] = $id;
        $data['itemno'] = rand(1,5);
        DB::table('items')->insert($data);
        // $result->save();

        return view('mofin');
        
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
