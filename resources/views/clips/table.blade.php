<table class="table table-responsive" id="clips-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Path</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($clips as $clip)
        <tr>
            <td>{!! $clip->name !!}</td>
            <td>{!! $clip->path !!}</td>
            <td>
                {!! Form::open(['route' => ['clips.destroy', $clip->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('clips.show', [$clip->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('clips.edit', [$clip->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>