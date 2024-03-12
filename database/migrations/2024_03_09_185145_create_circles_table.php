<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('circles', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // サークル名
            $table->string('activity_content');  // 活動内容
            $table->integer('member_count');  // メンバー数
            $table->integer('activity_fee');  // 活動費
            $table->string('activity_time');  // 活動日時
            $table->string('activity_location');  // 活動場所
            $table->text('how_to_join');  // 参加方法
            $table->text('sns');  // SNS
            $table->text('free_text'); // 自由掲載欄
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circles');
    }
};
