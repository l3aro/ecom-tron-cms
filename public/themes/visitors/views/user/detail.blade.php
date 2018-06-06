<!--header start-->
@partial('header')
<!--header end-->
<!--sidebar start-->
@partial('sidebar')
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="typo-agile">
        <h2 class="w3ls_head">Profile</h2>
        <div class="grid_3 grid_5 w3ls">
        @if($saved == 1)
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> Data has been saved to the database.
            </div>
        @endif
        <form method="post" action="{{ auth()->user()->id===$info->id&&$info->id?route('admin.profile.info'):route('admin.user.detail').'?id='.$info->id }}" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="save-group-buttons">
                    <button name="submit" class="btn btn-md btn-success" data-toggle="tooltip" title="Save">
                        <i class="fa fa-save"></i>
                    </button> 
                </div>
                <div class="row">
                    <hr>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label class="control-label" for="focusedInput">Name</label>
                            <input class="form-control" {!!auth()->user()->id!==$info->id&&$info->id?'readonly':''!!} name="name" type="text" required value="{{ isset($info)?$info->name:'' }}">
                        </div>
                        <div class="form-group">
                                <label class="control-label" for="focusedInput">Email</label>
                                <input class="form-control" {!!$info->id?'readonly':''!!} name="email" type="text" value="{{ isset($info)?$info->email:'' }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="focusedInput">Position</label>
                            <input class="form-control" {!!auth()->user()->id!==$info->id&&$info->id?'readonly':''!!} name="position" type="text" value="{{ isset($info)?$info->position:'' }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="focusedInput">Phone number</label>
                            <input class="form-control" {!!auth()->user()->id!==$info->id&&$info->id?'readonly':''!!} name="mobile" type="text" value="{{ isset($info)?$info->mobile:'' }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="focusedInput">Address</label>
                            <input class="form-control" {!!auth()->user()->id!==$info->id&&$info->id?'readonly':''!!} name="address" type="text" value="{{ isset($info)?$info->address:'' }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="focusedInput">Birthday</label>
                            <input class="form-control" {!!auth()->user()->id!==$info->id&&$info->id?'readonly':''!!} name="birthday" id="birthday" type="date" value="{{ isset($info)?$info->birthday:'' }}">
                        </div>
                        @if(!$info->id)
                        <div class="form-group">
                            <label class="control-label" for="focusedInput">Password</label>
                            <input class="form-control" type="password" value="" name="password" required>
                        </div>
                        @endif
                        @if(auth()->user()->id !== $info->id)
                        <div class="form-group">
                            <label class="control-label">Admin</label>
                            <input type="checkbox" class="checkbox-toggle" value="check" name="admin" id="admin" {{ isset($info)&&$info->admin==1?'checked':'' }}/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Active</label>
                            <input type="checkbox" class="checkbox-toggle" value="check" name="active" id="active" {{ isset($info)&&$info->active==1?'checked':'' }}/>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label" for="focusedInput">Avatar</label>
                            <input class="form-control" {!!auth()->user()->id!==$info->id&&$info->id?'hidden':''!!} name="image" type="file" value="" placeholder="Ảnh đại diện">
                            <small class="form-text text-muted">User avatar. </small>
                        </div>
                        @if(!empty($info->image))
                        <div class="form-group text-center">
                            <input type="hidden" name="current_image" value="<?=$info->image?>">
                            <div class="avatar" style="background-image: url('{{ isset($info->image)?URL::asset('media/user/'.$info->image):'' }}')">
                                {{-- <img src="" width="240" height="auto" alt="" /> --}}
                            </div>
                            <button {!!auth()->user()->id!==$info->id&&$info->id?'hidden':''!!} id="btn-delete-image" class="btn btn-danger" imgdetailid="<?=$info->id?>" name="deleteimagedetail" value="<?=$info->id?> data-toggle="tooltip" title="Delete current avatar"" type="submit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
</section>
 <!-- footer -->
@partial('footer')
  <!-- / footer -->
</section>