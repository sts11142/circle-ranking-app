<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    use HasFactory;

    public function viewLogs() {
        return $this->hasMany('App\Models\ViewLog');  // circleは複数のlogを有する（のでメソッド名も複数形）
    }
}
