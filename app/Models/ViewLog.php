<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ViewLog extends Model
{
    protected $fillable = ['circle_id'];

    use HasFactory;

    public function circle()
    {
        return $this->belongsTo('App\Models\Circle');  // logが属するcircleは一つ（なのでメソッド名は単数形）
    }

    /**
     * 指定期間における閲覧ログの閲覧回数でランキング付けされた、指定件数のサークルidを返却する関数
     * @param int $daysAgo - ランキング付けを行う期間（`$daysAgo`から現在まで）
     * @param int $circlesLimit - ランキングの結果、上位`$circlesLimit`件のサークルidを取得する
     * @return array `circle_id`が格納された配列
     */
    public static function RankingOfCircleByLogCount(int $daysAgo, int $circlesLimit)
    {
        $dateSince = Carbon::now()->subDays($daysAgo);

        // キャッシュ時間は 5分 とする
        // $cacheSeconds = 1 * 60 * 5;  // 秒
        $cacheSeconds = 1 * 15 * 1;  // debug 秒

        $circleIds = Cache::remember('circle_ranking', $cacheSeconds, function () use ($dateSince, $circlesLimit) {
            return self::where('created_at', '>=', $dateSince)
                ->groupBy('circle_id')
                ->select('circle_id', DB::raw('count(*) as log_count'))
                ->orderByDesc('log_count')
                ->take($circlesLimit)
                ->get()
                ->pluck('circle_id')
                ->toArray();
        });

        return $circleIds;
    }
}
