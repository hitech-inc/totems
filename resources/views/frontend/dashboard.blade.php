<!DOCTYPE html>
<html lang="en">
<head>
	<title>Личный кабинет</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}"/>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">

	<link href="http://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>
<body>
	
	<div class="limiter" style="position: relative;">
		<div class="container-login100 container-table100">
			<div class="wrap-login100" style="padding: 33px;">
				<div class="table100">

					<div class="btn-group" role="group" aria-label="Basic example" style="margin-bottom: 33px;">
					  <button type="button" class="btn btn-primary add-clip-btn"><i class="fa fa-plus"></i> Добавить ролик</button>
					</div>

					<div class="float-right btn-group" role="group" aria-label="Basic example" style="margin-bottom: 33px;">
					  <button type="button" class="btn btn-secondary exit-btn"><i class="fas fa-sign-out-alt"></i>  Выход</button>
					</div>

					@include('flash::message')

					<table>
						<thead>
							<tr class="table100-head">
								<th>#</th>
								<th class="column1">
									Наименование <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
								</th>
								<th style="width: 300px;">Ролик</th>
								<th class="column3">Действие</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($clips as $clip)
							<tr>
								<td>{{ $loop->index + 1 }}</td>
								<td class="column1">{{ $clip->name }}</td>
								<td>
									<video id="my-video" class="video-js" controls preload="auto" width="108" height="192">
									    <source src="{{ asset('uploads/clips/' . $clip->path) }}" type="video/mp4">
							  			<source src="{{ asset('uploads/clips/' . $clip->path) }}" type="video/ogg">
						  				<source src="{{ asset('uploads/clips/' . $clip->path) }}" type="video/webm">
									    <p class="vjs-no-js">
									      To view this video please enable JavaScript, and consider upgrading to a web browser that
									      <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
									    </p>
								  	</video>
								</td>
								<td class="column3">
									<!-- <a class="btn btn-success">
										<i class="fas fa-pencil-alt"></i>
									</a> -->
									{!! Form::open(['route' => ['clips.destroy', $clip->id], 'method' => 'post']) !!}
										{{ method_field( 'DELETE' ) }}
										<button type="submit" class="confirm btn btn-danger">
											<i class="fas fa-trash-alt"></i> Удалить
										</button>
									{!! Form::close() !!}
									
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
	<script src="{{ asset('vendor/tilt/tilt.jquery.min.js') }}"></script>
	<script src="{{ asset('js/main.js') }}"></script>

	<script src="http://vjs.zencdn.net/6.6.3/video.js"></script>

	<script>
		$(document).ready(function() {
			$('.js-tilt').tilt({
				scale: 1.1
			})

			$('.add-clip-btn').click(function() {
				location.href = "/clips/create";
			})

			$('.exit-btn').click(function() {
				location.href = '/mylogout';
			})

			$('.confirm').click(function(e) {
				var c = confirm('Вы уверены, что хотите удалить ролик?')

				if (c === false) {
					e.stopPropagation()
					e.preventDefault()
					return false;
				}


			})
		});
		
	</script>

</body>
</html>