<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCat extends Model
{
    protected $table = 'article_cat';
	protected $guarded = ['id'];
    protected $dates = [
        'created_at', 'created_at'
    ];

    public function article() {
        return $this->hasMany('App\Models\Article', 'cat');
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'updated_by');
	}

	public function childCats() {
		return $this->hasMany('App\Models\ArticleCat', 'parent', 'id');
	}
	
	public static function getIdString($cat_id, &$id_string){
		$cats = self::find($cat_id);
		foreach($cats->childCats as $c) {
			$id_string .= ',' .$c->id;
			self::getIdString($c->id, $id_string);
		}
	}

    public function GetOptions( $active_id = 0){
        $this->_options = '<option value="0"></option>';
        $cats = self::where('parent', 0)->where('language', 'vi')->orderBy('created_at', 'desc')->get();
		foreach ($cats as $r) {
			$this->_options .= '<option value="' . $r->id . '" ' . ( ($active_id==$r->id)?'selected="selected"':'' ) . '>' . $r->name . '</option>';
		    $this->GetChildOptions($r->id, '+', $active_id);
		}
		return $this->_options;
    }

    public function GetChildOptions($id, $start, $active_id)
	{
		$cats = $this->GetChildCats($id);
		if($cats){
			foreach ($cats as $cat){
				$this->_options .= '<option value="' . $cat->id . '" ' . ( ($active_id==$cat->id)?'selected="selected"':'' ) . '>' . $start . $cat->name . '</option>';
				$this->GetChildOptions($cat->id, $start . '+', $active_id);
			}
        }
    }
    public function GetChildCats($id){
        return self::where('parent' ,$id)
                        ->orderBy('created_at' , 'DESC')
                        ->get();
    }
    
    function GetCategories($lang = ''){
		$this->_menus = '';
        $results = $this->where('parent', 0)
                        ->orderBy('created_at', 'desc')
                        ->get();
		$i = 0;
		foreach ($results as $r) {
			if($i%2 == 0){
				$classp = 'even';
			}else{
				$classp	= 'odd';
            }
			$this->_menus .= '<li catid="'.$r->id.'" id="cat_'.$r->id.'" class="cat '.$classp.'">';
			$this->_menus .= '<table class="table-sm table-hover table-bordered m-0 p-0" id="table_content" width="100%"><tbody>';
			$this->_menus .= '<tr>
								<td class="align-middle connect" style="width: 35px;" data-toggle="tooltip" title="Giữ icon này kéo thả để sắp xếp">
									<i class="material-icons">format_line_spacing</i>
								</td>
								<td class="text-center" style="width: 35px;">
									<input type="checkbox" class="checkdel" del-id="'.$r->id.'" id="delId'.$r->id.'">
									<label for="delId'.$r->id.'"></label>
								</td>
								<td class="align-middle" style="width: 50px;">'.$r->id.'</td>
								<td class="edit-name">
									<a href="/admin/articlecat/detail/'.$r->id.'">
										'.$r->name.'
									</a>
								</td>
								<td style="width: 120px;">'.$r->created_at.'</td>
								<td style="width: 120px;">'.$r->user->name.'</td>
								<td style="width: 115px;">
									<div class="btn-group">
										<a class="btn btn-success btn-sm p-1" href="/admin/articlecat/detail?parent='.$r->id.'" data-toggle="tooltip" title="Thêm mục con">
											<i class="material-icons">playlist_add</i>
										</a>
										<a class="btn btn-info btn-sm p-1" href="/admin/articlecat/detail/'.$r->id.'" data-toggle="tooltip" title="Sửa">
											<i class="material-icons">mode_edit</i>
										</a>
										<a class="btn btn-danger btn-sm p-1 delete-button" href="/admin/articlecat/delete/'.$r->id.'"
											data-toggle="tooltip" title="Xóa">
											<i class="material-icons">delete</i>
										</a>
									</div>
								</td>
							</tr>';
			$icon = '<i class="material-icons">remove</i>';
			$this->_menus .= '</tbody></table>';
			$this->GetChildCategories($r->id, $lang, 10, $icon);
			$this->_menus .= '</li>';
			$i++;
		}
		return $this->_menus;
	}
	
	function GetChildCategories($id, $lang, $start, $icon)
	{
		$cats = $this->GetChildCats($id, $lang?$lang:'vi');
		if(count($cats)){
			$this->_menus .= '<ul class="sortcat ui-sortable">';	
			foreach ($cats as $cat){
				$this->_menus .= '<li catid="'.$cat->id.'" id="cat_'.$cat->id.'" class="cat">';
				$this->_menus .= '<table class="table-sm table-hover table-bordered m-0 p-0" id="table_content" width="100%"><tbody>';
				$this->_menus .= '<tr>
									<td class="align-middle connect" style="width: 35px;" data-toggle="tooltip" title="Giữ icon này kéo thả để sắp xếp">
										<i class="material-icons">format_line_spacing</i>
									</td>
									<td class="align-middle" style="width: 35px;">
										<input type="checkbox" class="checkdel" del-id="'.$cat->id.'" id="delId'.$cat->id.'">
										<label for="delId'.$cat->id.'"></label>
									</td>
									<td class="align-middle" style="width: 50px;">'.$cat->id.'</td>
									<td class="edit-name">
										<a href="/admin/articlecat/detail/'.$cat->id.'">
											'.$icon.$cat->name.'
										</a>
									</td>
									<td style="width: 120px;">'.$cat->created_at.'</td>
									<td style="width: 120px;">'.$cat->user->name.'</td>
									<td style="width: 115px;">
										<div class="btn-group">
											<a class="btn btn-success btn-sm p-1" href="/admin/articlecat/detail?parent='.$cat->id.'" data-toggle="tooltip" title="Thêm mục con" data-placement="top">
												<i class="material-icons">playlist_add</i>
											</a>
											<a class="btn btn-info btn-sm p-1" href="/admin/articlecat/detail?id='.$cat->id.'" data-toggle="tooltip" title="Sửa" data-placement="top">
												<i class="material-icons">mode_edit</i>
											</a>
											<a class="btn btn-danger btn-sm p-1 delete-button" href="/admin/articlecat/delete/'.$cat->id.'"
												data-toggle="tooltip" title="Xóa" data-placement="top">
												<i class="material-icons">delete</i>
											</a>
										</div>
									</td>
								</tr>';
								$this->_menus .= '</tbody></table>';
				$this->GetChildCategories($cat->id, $lang, $start+10, $icon.'<i class="material-icons">remove</i>');
				$this->_menus .= '</li>';
			}
			$this->_menus .= '</ul>';
		}
	}
}
