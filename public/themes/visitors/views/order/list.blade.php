<div id="data_table">
    @if(isset($orders) && count($orders))
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
                <th style="width:30px">Email</th>
                <th style="width:30px">Phone</th>
                <th>Address</th>
                <th style="width:30px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $key=>$order)
            <tr>
                <td>
                    <label class="i-checks m-b-none">
                    <input type="checkbox" name="checkdel[{{$order->id}}]" class="checkdel" del-id="{{$order->id}}"><i></i></label>
                </td>
                <td>{!! $order->id !!}</td>
                <td>
                    <a href="/admin/order/detail?id={{$order->id}}">
                        {!! $order->name !!}
                    </a>
                </td>
                <td>
                    {!!$order->email!!}
                </td>
                <td>
                    {{$order->phone}}
                </td>
                <td>
                    {{$order->address}}
                </td>
                <td>
                    <a href="#" class="active delete-button" ui-toggle-class="" data-toggle="tooltip" data-placement="top" title="Delete" delete-id="{{$order->id}}">
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
                <small class="text-muted inline m-t-sm m-b-sm">showing {{$orders->firstItem()}}-{{$orders->lastItem()}} of {{$orders->total()}} items</small>
            </div>
            <div class="col-sm-7 text-right text-center-xs">
                {{$orders->links()}}
            </div>
        </div>
    </footer>
</div>