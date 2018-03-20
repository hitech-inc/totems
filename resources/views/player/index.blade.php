@extends('player.layouts.master')


@section('content')

<video id="player" autoplay>
  	<source src="{{ asset('uploads/clips/borte-milk-totem.mp4') }}" type="video/mp4">
	Your browser does not support the video tag.
</video>

@endsection



@section('scripts_body')

video = document.getElementById('player')

video.addEventListener('ended', function(e) {
	console.log(e)

	console.log('load next video')
})

@endsection