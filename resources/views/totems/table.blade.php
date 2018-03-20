<table class="table table-responsive" id="totems-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Ip Addr</th>
            <th>Last Seen At</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($totems as $totem)
        <tr>
            <td>{!! $totem->name !!}</td>
            <td>
                <span class="{{ $totem->status }}">{!! $totem->status !!}</span>
            </td>
            <td>{!! $totem->ip_addr !!}</td>
            <td>
                @if (!is_null($totem->last_seen_at))
                    {!! $totem->last_seen_at->diffForHumans() !!}
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['totems.destroy', $totem->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('totems.show', [$totem->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('totems.edit', [$totem->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>