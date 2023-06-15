@foreach ($assets as $asset)
<p>{{ $asset->type }}</p>
<p>{{ $asset->name }}</p>
<p>{{ $asset->description }}</p>
@endforeach




