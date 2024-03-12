<?php

namespace App\Http\Controllers;

use App\Models\Circle;
use App\Models\ViewLog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CircleController extends Controller
{
    public function ranking(): Response
    {
        $daysAgo = 7;  // 何日前からの閲覧履歴か
        $circlesLimit = 30;  // 上位何個のサークルをランキング表示するのか

        // 指定された期間における、サークル閲覧数のランキング結果を取得する
        $circleIds = ViewLog::RankingOfCircleByLogCount($daysAgo, $circlesLimit);

        // 得られたランキングデータ（`circle_id`の配列）をもとに、サークル情報を整形する
        $rankedCircleDataArr = [];  // サークルデータが格納される
        foreach ($circleIds as $circleId) {
            array_push($rankedCircleDataArr, Circle::getNameAndFreetextBy($circleId));
        }

        return response()->view('circles.ranking', compact('rankedCircleDataArr'));
    }

    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    // }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    // }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    // }
}
