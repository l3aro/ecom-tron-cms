
<div class="log-w3">
	<div class="w3layouts-main">
		<h2>Sign In Now</h2>
			<form method="post" role="form" action="{{ route('admin.login') }}">
				{{ csrf_field() }}
				<input type="email" class="ggg" name="email" placeholder="E-MAIL" required="" value="{{old('email')}}">
				@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
				<input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">
				@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
				<h6><a href="#">Forgot Password?</a></h6>
					<div class="clearfix"></div>
					<input type="submit" value="Sign In" name="login">
			</form>
	</div>
</div>
