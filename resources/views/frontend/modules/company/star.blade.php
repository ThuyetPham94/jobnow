<p class="number">{!! $start = ($data->review->count() != 0)?round($data->review()->sum('OverallRating') / $data->review->count()):0 !!}.0</p>
<p class="list-start">
    @for($i = 1 ; $i <= 5 ; $i++)
    @if($i <= $start)
    <span class="glyphicon glyphicon-star active"></span> 
    @else
    <span class="glyphicon glyphicon-star"></span> 
    @endif
    @endfor
</p>
<p class="view">
    ( {!! $data->review->count() !!} Đánh giá )
</p>