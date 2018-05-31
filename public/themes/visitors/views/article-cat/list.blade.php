<div id="data_table">
    @if(isset($categories) && count($categories))
    <table class="table table-striped b-t b-light">
        <thead>
            <tr>
                <th style="width:20px;font-size:20px;">
                    <span style="color:black;" id="btn-ck-all" data-toggle="tooltip" title="Select/Deselect all">
                        <i class="fa fa-square-o"></i>
                    </span>
                </th>
                <th style="width:30px">ID</th>
                <th style="width:70%">CATEGORY NAME</th>
                <th>DATE MODIFIED</th>
                <th style="width:30px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $key=>$value)
            <tr>
                <td>
                    <label class="i-checks m-b-none">
                    <input type="checkbox" name="checkdel[{{$value->id}}]" class="checkdel" del-id="{{$value->id}}"><i></i></label>
                </td>
                <td>{!! $value->id !!}</td>
                <td>
                    <a href="/admin/article-cat/detail?id={{$value->id}}">
                        {!! $value->name !!}
                    </a>
                </td>
                <td>
                    {!! $value->updated_at !!}
                </td>
                <td>
                    <a href="/admin/article-cat/detail?parent={{$value->id}}" class="active" ui-toggle-class="" data-toggle="tooltip" data-placement="top" title="Add sub category">
                        <i class="fa fa-indent text-primary text-active"></i>
                    </a>
                    <a href="#" class="active delete-button" ui-toggle-class="" data-toggle="tooltip" data-placement="top" title="Delete" delete-id="{{$value->id}}">
                        <i class="fa fa-trash text-danger text"></i>
                    </a>
                </td>
            </tr>
            @php
                if ($value->sub !== null) {
                    printSub($value->sub);
                }
            @endphp
            @endforeach
        </tbody>
    </table>
    @else
    <div class="wrapper">
        No records found
    </div>
    @endif
</div>
<?php
    function printSub($sub, $nth=1) {
        foreach ($sub as $key=>$value) {
?>
            <tr>
                <td>
                    <label class="i-checks m-b-none">
                    <input type="checkbox" name="checkdel[{{$value->id}}]" class="checkdel" del-id="{{$value->id}}"><i></i></label>
                </td>
                <td>{!! $value->id !!}</td>
                <td>
<?php
                    for ($i = 0; $i < $nth; $i++) {
                        echo ' <i class="fa fa-minus"></i> ';
                    }
?>
                    <a href="/admin/article-cat/detail?id={{$value->id}}">
                        {!! $value->name !!}
                    </a>
                </td>
                <td>
                    {!! $value->updated_at !!}
                </td>
                <td>
                    <a href="/admin/article-cat/detail?parent={{$value->id}}" class="active" ui-toggle-class="" data-toggle="tooltip" data-placement="top" title="Add sub category">
                        <i class="fa fa-indent text-primary text-active"></i>
                    </a>
                    <a href="#" class="active delete-button" ui-toggle-class="" data-toggle="tooltip" data-placement="top" title="Delete" delete-id="{{$value->id}}">
                        <i class="fa fa-trash text-danger text"></i>
                    </a>
                </td>
            </tr>
<?php
            if ($value->sub !== null) {
                printSub($value->sub, $nth+1);
            }
        }
        return;
    }
?>