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
        <form method="post" action="{{ route('admin.profile.password') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="row">
                    <hr>
                    <div class="col-lg-12">
                        <div class="panel-body">
                            <div class="position-center">
                                <form class="form-horizontal" role="form">
                                <div class="form-group {!! $error==='incorrect-password'?'has-error':'' !!}">
                                    <label for="password" class="col-lg-2 col-sm-2 control-label">Old password</label>
                                    <div class="col-lg-10">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <p class="help-block">
                                        @if ($error==='incorrect-password')
                                            Your password was incorrect.
                                        @endif
                                       </p>    
                                    </div>
                                </div>
                                <div class="form-group {!! $error==='same-old-password'?'has-error':'' !!}">
                                    <label for="new-password" class="col-lg-2 col-sm-2 control-label">New password</label>
                                    <div class="col-lg-10">
                                        <input type="password" class="form-control" id="new-password" name="new-password" >
                                        <p class="help-block">
                                        @if ($error==='same-old-password')
                                            Password must differ from old password.
                                        @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group {!! $error==='invaild-confirm-password'?'has-error':'' !!}">
                                    <label for="confirm-password" class="col-lg-2 col-sm-2 control-label">Confirm password</label>
                                    <div class="col-lg-10">
                                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" >
                                        <p class="help-block">
                                        @if ($error==='invaild-confirm-password')
                                            You must enter the same password twice in order to confirm it.
                                        @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" class="btn btn-danger">Change password</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
        
                    </div>
                </div>
            </form>
		</div>
</section>
 <!-- footer -->
@partial('footer')
  <!-- / footer -->
</section>