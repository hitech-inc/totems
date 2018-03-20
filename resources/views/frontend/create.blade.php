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

	<style>
	    .progress_outer {
	        border: 1px solid #000;
	    }
	    .progress {
	        width: 20%;
	        background: #DEDEDE;
	        height: 20px;  
	    }
    </style>
</head>
<body>
	
	<div class="limiter" style="position: relative;">
		<div class="container-login100 container-table100">
			<div class="wrap-login100" style="padding: 33px;">
				<div class="table100" style="width: 100%;">

					<div class="btn-group" role="group" aria-label="Basic example" style="margin-bottom: 33px;">
					  <button type="button" class="btn btn-secondary back-btn"><i class="fa fa-arrow-left"></i> Назад</button>
					</div>

					<div class="float-right btn-group" role="group" aria-label="Basic example" style="margin-bottom: 33px;">
					  <button type="button" class="btn btn-secondary exit-btn"><i class="fas fa-sign-out-alt"></i>Выход</button>
					</div>

					@include('flash::message')
					@include('adminlte-templates::common.errors')

					<div class="row">
						
						{!! Form::open(['route' => 'clips.store', 'files' => true]) !!}

                        	<!-- Name Field -->
							<div class="form-group col-sm-12">
							    {!! Form::label('name', 'Наименование ролика:') !!}
    							{!! Form::text('name', null, ['class' => 'form-control']) !!}
							</div>

							<!-- Path Field -->
							<div class="form-group col-sm-6">
							    {!! Form::label('path', 'Загрузите ролик:') !!}
							    {!! Form::file('path', null, ['id' => 'path', 'class' => 'form-control']) !!}
							</div>

							<!-- Submit Field -->
							<div class="form-group col-sm-12">
							    {!! Form::submit('Сохранить', ['id' => 'save-btn', 'class' => 'btn btn-primary']) !!}
							</div>

                    	{!! Form::close() !!}

					</div>
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
			$('.back-btn').click(function() {
				location.href = "/";
			})

			$('.exit-btn').click(function() {
				location.href = '/mylogout';
			})
		})
		
	</script>

</body>
</html>