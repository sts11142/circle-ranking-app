<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewLog extends Model
{
    use HasFactory;

    public function circle() {
        return $this->belongsTo('App\Models\Circle');  // logが属するcircleは一つ（なのでメソッド名は単数形）
    }
}
