@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Clip
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($clip, ['route' => ['clips.update', $clip->id], 'method' => 'patch']) !!}

                        @include('clips.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection