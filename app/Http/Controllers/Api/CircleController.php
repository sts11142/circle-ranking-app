<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Circle;
use App\Models\ViewLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CircleController extends Controller
{
    /** 何日前からの閲覧履歴か */
    private $DAYSAGO = 7;

    /** 上位何個のサークルをランキング表示するのか */
    private $CIRCLELIMIT = 30;
    public function ranking(): JsonResponse
    {
        try {
            // 指定された期間における、サークル閲覧数のランキング結果を取得する
            $circleIds = ViewLog::RankingOfCircleByLogCount($daysAgo = $this->DAYSAGO, $circlesLimit = $this->CIRCLELIMIT);

            // 得られたランキングデータ（`circle_id`の配列）をもとに、サークル情報を整形する
            $circleModel = new Circle;
            $rankedCircles = [];  // サークルデータが格納される
            foreach ($circleIds as $circleId) {
                array_push($rankedCircles, $circleModel->getBasicCircleInfoBy($circleId));
            }

            return response()->json([
                'status' => 'success',
                'ranked_circles' => $rankedCircles
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'サークルランキングデータの取得に失敗しました',
                'errors' => [$th]
            ], 400);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $circleModel = new Circle;  // ModelオブジェクトのCollection
            $circles = $circleModel->getBasicCircleInfoAll();

            return response()->json([
                'status' => 'success',
                'circles' => $circles,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'サークル一覧情報の取得に失敗しました',
                'errors' => [$th]
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $circle = Circle::find($id);

            // 閲覧記録を保存する
            ViewLog::create(['circle_id' => $id]);

            // このサークルがランキング内に含まれるか？
            [$isRanked, $idx] = $this->searchTargetIdxInArr((int)$id, ViewLog::RankingOfCircleByLogCount($this->DAYSAGO, $this->CIRCLELIMIT));
            $circleRank = ['isRanked' => $isRanked, 'rank' => $idx + 1];

            return response()->json([
                'status' => 200,
                'circle' => $circle,
                'circle_rank' => $circleRank,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'サークル詳細情報の取得に失敗しました',
                'errors' => [$th]
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

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
}
