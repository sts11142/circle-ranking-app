<div>circles.show</div>

<div>
  @if ($circleRank["isRanked"])
    <p>ランキング順位：{{$circleRank["rank"]}}位</p>
  @endif

  <p class="">サークル名：{{$circle->name}}</p>
  <p class="">活動内容：{{$circle->activity_content}}</p>
  <p class="">メンバー数：{{$circle->member_count}} 人</p>
  <p>活動費：{{$circle->activity_fee}}</p>
  <p>活動日時：{{$circle->activity_time}}</p>
  <p>活動場所：{{$circle->activity_location}}</p>
  <p>参加方法：{{$circle->how_to_join}}</p>
  <p>SNS：{{$circle->sns}}</p>
  <p>自由掲載欄：{{$circle->free_text}}</p>
</div>
