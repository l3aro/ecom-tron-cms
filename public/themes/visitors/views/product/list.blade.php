<div id="data_table">
    @if(isset($products) && count($products))
    <table class="table table-striped b-t b-light">
        <thead>
            <tr>
                <th style="width:20px;font-size:20px;">
                    <span style="color:black;" id="btn-ck-all" data-toggle="tooltip" title="Select/Deselect all">
                        <i class="fa fa-square-o"></i>
                    </span>
                </th>
                <th style="width:30px">ID</th>
                <th style="width:50%">Title</th>
                <th>Category</th>
                <th style="width:30px">Public</th>
                <th style="width:30px">Highlight</th>
                <th style="width:30px">New</th>
                <th style="width:30px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key=>$product)
            <tr>
                <td>
                    <label class="i-checks m-b-none">
                    <input type="checkbox" name="checkdel[{{$product->id}}]" class="checkdel" del-id="{{$product->id}}"><i></i></label>
                </td>
                <td>{!! $product->id !!}</td>
                <td>
                    <a href="/admin/product/detail?id={{$product->id}}">
                        {!! $product->name !!}
                    </a>
                </td>
                <td></td>
                <td>
                    <button type="button" class="btn btn-sm p-1 <?=$product->public==1?'btn-success':''?> editmenu" data-toggle="tooltip" title="<?=$product->public==1?'Click to turn off':'Click to turn on'?>"
                        field="public" item-id="<?=$product->id?>" currentvalue="<?=$product->public?>" cms-change-field="changfield"><i class="fa fa-{{$product->public==1?'check':'times'}}"></i>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-sm p-1 <?=$product->highlight==1?'btn-success':''?> editmenu" data-toggle="tooltip" title="<?=$product->highlight==1?'Click to turn off':'Click to turn on'?>"
                        field="highlight" item-id="<?=$product->id?>" currentvalue="<?=$product->highlight?>" cms-change-field="changfield"><i class="fa fa-{{$product->highlight==1?'check':'times'}}"></i>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-sm p-1 <?=$product->new==1?'btn-success':''?> editmenu" data-toggle="tooltip" title="<?=$product->new==1?'Click to turn off':'Click to turn on'?>"
                        field="new" item-id="<?=$product->id?>" currentvalue="<?=$product->new?>" cms-change-field="changfield"><i class="fa fa-{{$product->new==1?'check':'times'}}"></i>
                    </button>
                </td>
                <td>
                    <a href="/admin/product/detail?act=copy&&id={{$product->id}}" class="active" ui-toggle-class="" data-toggle="tooltip" data-placement="top" title="Clone">
                        <i class="fa fa-copy text-primary text-active"></i>
                    </a>
                    <a href="#" class="active delete-button" ui-toggle-class="" data-toggle="tooltip" data-placement="top" title="Delete" delete-id="{{$product->id}}">
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
                <small class="text-muted inline m-t-sm m-b-sm">showing {{$products->firstItem()}}-{{$products->lastItem()}} of {{$products->total()}} items</small>
            </div>
            <div class="col-sm-7 text-right text-center-xs">
                {{$products->links()}}
            </div>
        </div>
    </footer>
</div>