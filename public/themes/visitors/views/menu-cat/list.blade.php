<div id="data_table">
    @if(isset($categories) && count($categories))
    <table class="table table-striped b-t b-light">
        <thead>
            <tr>
                <th style="width:30px">ID</th>
                <th style="width:70%">MENU NAME</th>
                <th>DATE MODIFIED</th>
                <th style="width:30px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $key=>$value)
            <tr>
                <td>{!! $value->id !!}</td>
                <td>
                    <a href="/admin/menu?cat={{$value->id}}">
                        {!! $value->name !!}
                    </a>
                </td>
                <td>
                    {!! $value->updated_at !!}
                </td>
                <td>
                    <a href="/admin/menu-cat/detail?id={{$value->id}}" class="active" ui-toggle-class="" data-toggle="tooltip" data-placement="top" title="Edit menu name">
                        <i class="fa fa-pencil text-primary text-active"></i>
                    </a>
                    <a href="#" class="active delete-button" ui-toggle-class="" data-toggle="tooltip" data-placement="top" title="Delete" delete-id="{{$value->id}}">
                        <i class="fa fa-trash text-danger text"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="wrapper">
        No records found
    </div>
    @endif
</div>