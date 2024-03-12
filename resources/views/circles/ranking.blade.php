<div>circles.ranking</div>

@foreach ($rankedCircles as $circle)
    <div>{{ $circle->name }}</div>
    <div>{{ $circle->free_text }}</div>
    <div>-------</div>
@endforeach


{{-- @php
  echo '<pre>';
  var_dump($rankedCircles);
  echo '<pre>';
@endphp --}}
