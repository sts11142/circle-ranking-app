<div>circles.ranking</div>

@foreach ($rankedCircles as $i => $circle)
    <p>{{$circleIds[$i]}}</p>
    <div>{{ $circle->name }}</div>
    <div>{{ $circle->free_text }}</div>
    <div>-------</div>
@endforeach


{{-- @php
  echo '<pre>';
  var_dump($rankedCircles);
  echo '<pre>';
@endphp --}}
