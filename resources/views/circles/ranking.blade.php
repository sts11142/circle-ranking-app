<div>circles.ranking</div>

@foreach ($rankedCircleDataArr as $circle)
    <div>{{ $circle->name }}</div>
    <div>{{ $circle->free_text }}</div>
    <div>-------</div>
@endforeach


{{-- @php
  echo '<pre>';
  var_dump($rankedCircleDataArr);
  echo '<pre>';
@endphp --}}
