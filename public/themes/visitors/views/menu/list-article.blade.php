<div class="row">
    <div class="col-md-12">
        <hr/>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <input type="text" id="keyword" class="form-control search-input" placeholder="Search..." aria-label="Search for..." value="<?=$keyword?>">
    </div>
    <div class="col-md-3">
        <select id="cat" name="cat" class="form-control search-change">
                <?=$list_cat?>
            </select>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3">
        <table class="table table-sm table-hover" id="table_content" width="100%">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle" style="width: 50px;">ID</th>
                    <th class="align-middle">Article name</th>
                    <th class="align-middle">Category</th>
                    <th class="align-middle text-center" style="width: 160px;"></th>
                </tr>
            </thead>
            <tbody class="sort">
                @if(isset($article) && count($article)) @foreach ($article as $key=>$r)
                <tr id="item_<?=$r->id?>">
                    <td>
                        <?=$r->id?>
                    </td>
                    <td class="edit-name">
                        <a class="choose-record" href="javascript:void(0)" record-id="<?=$r->id?>" record-name="<?=$r->name?>"><?=$r->name?></a>
                    </td>
                    <td>
                        <?=$r->cat==0?'':$r->article_cat->name?>
                    </td>
                    <td style="text-align: center;">
                        <div class="btn-group">
                            <a class="btn btn-sm p-1 btn-info choose-record" href="javascript:void(0)" record-id="<?=$r->id?>" record-name="<?=$r->name?>">
                            <i class="fa fa-check"></i> &nbsp;Select
                        </a>
                        </div>
                    </td>
                </tr>
                @endforeach 
                @else 
                No records found
                @endif
            </tbody>
        </table>
    </div>
</div>
{{ $article->links() }}