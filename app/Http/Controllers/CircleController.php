<?php

namespace App\Http\Controllers;

use App\Models\Circle;
use App\Models\ViewLog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CircleController extends Controller
{
    /** 何日前からの閲覧履歴か */
    protected $DAYSAGO = 7;

    /** 上位何個のサークルをランキング表示するのか */
    protected $CIRCLELIMIT = 30;

    public function ranking(): Response
    {
        // 指定された期間における、サークル閲覧数のランキング結果を取得する
        $circleIds = ViewLog::RankingOfCircleByLogCount($this->DAYSAGO, $this->CIRCLELIMIT);

        // 得られたランキングデータ（`circle_id`の配列）をもとに、サークル情報を整形する
        $rankedCircles = [];  // サークルデータが格納される
        $circleModel = new Circle;
        foreach ($circleIds as $circleId) {
            array_push($rankedCircles, $circleModel->getBasicCircleInfoBy($circleId));
        }

        return response()->view('circles.ranking', compact('rankedCircles', 'circleIds'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $circles = Circle::all();  // ModelオブジェクトのCollection

        return response()->view('circles.index', compact('circles'));
    }

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
    public function show(string $id): Response
    {
        $circle = Circle::find($id);

        // 閲覧ログを記録する
        ViewLog::create(['circle_id' => $id]);

        // このサークルがランキング内に含まれるか？
        [$isRanked, $idx] = $this->searchTargetIdxInArr((int)$id, ViewLog::RankingOfCircleByLogCount($this->DAYSAGO, $this->CIRCLELIMIT));
        $circleRank = ['isRanked' => $isRanked, 'rank' => $idx + 1];

        return response()->view('circles.show', compact('circle', 'circleRank'));
    }

    /**
     * @return array [bool: ランキングに含まれているか、int: ランキングの値(or 0)]
     */

    private function searchTargetIdxInArr(int $searchTarget, array $arr)
    {
        $idx = array_search($searchTarget, $arr);

        // ターゲットが配列中に...
        //     存在する   → true  かつ そのindex
        //     存在しない → false かつ 0
        $isRanked = $idx === false ? false : true;
        $idx = $isRanked === true ? $idx : -1;  // キャスト：配列インデックス → 順位
        return [$isRanked, $idx];
    }

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
