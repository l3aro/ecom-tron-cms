<div id="data_table">
    @if(isset($categories) && count($categories))
    <table class="table table-striped b-t b-light">
        <thead>
            <tr>
                <th style="width:30px"></th>
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
    </table>
    <ul class="sortcat ui-sortable">
        @foreach ($categories as $key=>$value)
        <li catid="{{$value->id}}" id="cat_{{$value->id}}" class="cat">
            <table class="table table-striped b-t b-light"> 
                <tbody>
                    <tr>
                        <td style="width:30px" class="align-middle connect" style="width: 35px;" data-toggle="tooltip" title="Drag icon to sort">
                            <i class="fa fa-arrows-v"></i>
                        </td>
                        <td style="width:20px;font-size:20px;">
                            <label class="i-checks m-b-none">
                            <input type="checkbox" name="checkdel[{{$value->id}}]" class="checkdel" del-id="{{$value->id}}"><i></i></label>
                        </td>
                        <td style="width:30px">{!! $value->id !!}</td>
                        <td style="width:70%">
                            <a href="/admin/menu/detail?id={{$value->id}}">
                                {!! $value->name !!}
                            </a>
                        </td>
                        <td>
                            {!! $value->updated_at !!}
                        </td>
                        <td style="width:30px;">
                            <a href="/admin/menu/detail?parent={{$value->id}}&&cat={{$cat}}" class="active" ui-toggle-class="" data-toggle="tooltip" data-placement="top" title="Add sub category">
                                <i class="fa fa-indent text-primary text-active"></i>
                            </a>
                            <a href="#" class="active delete-button" ui-toggle-class="" data-toggle="tooltip" data-placement="top" title="Delete" delete-id="{{$value->id}}">
                                <i class="fa fa-trash text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            @php
            if ($value->sub !== null) {
                printSub($value->sub, $cat);
            }
            @endphp
        </li>
        @endforeach
    </ul>
    @else
    <div class="wrapper">
        No records found
    </div>
    @endif
</div>
<?php
    function printSub($sub, $cat, $nth=1) {
?>
    <ul class="sortcat ui-sortable">
<?php
        foreach ($sub as $key=>$value) {
?>
        <li catid="{{$value->id}}" id="cat_{{$value->id}}" class="cat">
            <table class="table table-striped b-t b-light"> 
                <tbody>
                     <tr>
                        <td style="width:30px" class="align-middle connect" style="width: 35px;" data-toggle="tooltip" title="Drag icon to sort">
                            <i class="fa fa-arrows-v"></i>
                        </td>
                        <td style="width:20px;font-size:20px;">
                            <label class="i-checks m-b-none">
                            <input type="checkbox" name="checkdel[{{$value->id}}]" class="checkdel" del-id="{{$value->id}}"><i></i></label>
                        </td>
                        <td style="width:30px">{!! $value->id !!}</td>
                        <td style="width:70%">
<?php
                    for ($i = 0; $i < $nth; $i++) {
                        echo ' <i class="fa fa-minus"></i> ';
                    }
?>
                    <a href="/admin/menu/detail?id={{$value->id}}">
                        {!! $value->name !!}
                    </a>
                        </td>
                        <td>
                            {!! $value->updated_at !!}
                        </td>
                        <td style="width:30px;">
                            <a href="/admin/menu/detail?parent={{$value->id}}&&cat={{$cat}}" class="active" ui-toggle-class="" data-toggle="tooltip" data-placement="top" title="Add sub category">
                                <i class="fa fa-indent text-primary text-active"></i>
                            </a>
                            <a href="#" class="active delete-button" ui-toggle-class="" data-toggle="tooltip" data-placement="top" title="Delete" delete-id="{{$value->id}}">
                                <i class="fa fa-trash text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
<?php
            if ($value->sub !== null) {
                printSub($value->sub, $cat, $nth+1);
            }
?>
        </li>
<?php
        }
?>
    </ul>
<?php
        return;
    }
?>