<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index($name, $id)
    {
        // 사용자 이름, 아이디에 해당하는 자산 목록을 조회하는 로직 작성
        $assets = Asset::where('name', $name)
            ->where('id', $id)
            ->get();

        // 자산 목록을 뷰에 전달
        return view('assets.index', ['assets' => $assets]);
    }

    public function store(Request $request, $name, $id)
    {
        // 요청을 통해 전달된 데이터로 자산 생성 로직 작성
        // 예를 들어, $request->input('type'), $request->input('name') 등을 활용하여 자산 생성

        // 생성된 자산을 데이터베이스에 저장

        // 자산 생성 후 리다이렉션 등의 처리 작업
    }

    public function show($name, $id, $asset)
    {
        // 사용자 이름, 아이디, 자산명에 해당하는 자산 내역을 조회하는 로직 작성
        $assetDetails = Asset::where('name', $name)
            ->where('id', $id)
            ->where('name', $asset)
            ->get();

        // 자산 내역을 뷰에 전달
        return view('assets.show', ['assetDetails' => $assetDetails]);
    }

    public function update(Request $request, $name, $id, $asset)
    {
        // 요청을 통해 전달된 데이터로 카테고리 변경 로직 작성
        // 예를 들어, $request->input('category') 등을 활용하여 카테고리 변경

        // 변경된 카테고리를 데이터베이스에 저장

        // 변경 완료 후 리다이렉션 등의 처리 작업
    }
}

