<div id="data_table">
    @if(isset($users) && count($users))
    <table class="table table-striped b-t b-light">
        <thead>
            <tr>
                <th style="width:20px;font-size:20px;">
                    <span style="color:black;" id="btn-ck-all" data-toggle="tooltip" title="Select/Deselect all">
                        <i class="fa fa-square-o"></i>
                    </span>
                </th>
                <th style="width:30px">ID</th>
                <th style="width:50%">Name</th>
                <th style="width:30px">Active</th>
                <th>Data modified</th>
                <th style="width:30px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key=>$user)
            <tr>
                <td>
                    <label class="i-checks m-b-none">
                    <input type="checkbox" name="checkdel[{{$user->id}}]" class="checkdel" del-id="{{$user->id}}"><i></i></label>
                </td>
                <td>{!! $user->id !!}</td>
                <td>
                    <a href="/admin/user/detail?id={{$user->id}}">
                        {!! $user->name !!}
                    </a>
                </td>
                <td>
                    <button type="button" class="btn btn-sm p-1 <?=$user->active==1?'btn-success':''?> editmenu" data-toggle="tooltip" title="<?=$user->active==1?'Click to turn off':'Click to turn on'?>"
                        field="active" item-id="<?=$user->id?>" currentvalue="<?=$user->active?>" cms-change-field="changfield"><i class="fa fa-{{$user->active==1?'check':'times'}}"></i>
                    </button>
                </td>
                <td>
                    {!!$user->updated_at!!}
                </td>
                <td>
                    <a href="/admin/user/detail?act=copy&&id={{$user->id}}" class="active" ui-toggle-class="" data-toggle="tooltip" data-placement="top" title="Clone">
                        <i class="fa fa-copy text-primary text-active"></i>
                    </a>
                    <a href="#" class="active delete-button" ui-toggle-class="" data-toggle="tooltip" data-placement="top" title="Delete" delete-id="{{$user->id}}">
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
    <footer class="panel-footer">
        <div class="row">

            <div class="col-sm-5 text-center">
                <small class="text-muted inline m-t-sm m-b-sm">showing {{$users->firstItem()}}-{{$users->lastItem()}} of {{$users->total()}} items</small>
            </div>
            <div class="col-sm-7 text-right text-center-xs">
                {{$users->links()}}
            </div>
        </div>
    </footer>
</div>