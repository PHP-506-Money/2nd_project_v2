@foreach ($assetDetails as $detail)
<p>{{ $detail->expense }}</p>
<p>{{ $detail->income }}</p>
<p>{{ $detail->amount }}</p>
<p>{{ $detail->category }}</p>
<p>{{ $detail->date }}</p>
@endforeach
