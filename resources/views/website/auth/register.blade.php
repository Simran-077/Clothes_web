@extends('website.master')

@section('content')

  @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        
<div class="main-container container">

		<div class="row">
			<div id="content" class="col-sm-12">
				<h2 class="title">Register Account</h2>
				<p>If you already have an account with us, please login at the <a href="{{route('website.login')}}">login page</a>.</p>
				<form action="{{ route('website.register') }}" method="post" enctype="multipart/form-data" class="form-horizontal account-register clearfix">
    @csrf
    <fieldset id="account">
        <legend>Your Personal Details</legend>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-name">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" placeholder="Name" id="input-name" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
            <div class="col-sm-10">
                <input type="email" name="email" placeholder="E-Mail" id="input-email" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-phone">Phone</label>
            <div class="col-sm-10">
                <input type="text" name="phone" placeholder="Phone" id="input-phone" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-password">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" placeholder="Password" id="input-password" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-password-confirmation">Confirm Password</label>
            <div class="col-sm-10">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" id="input-password-confirmation" class="form-control" required>
            </div>
        </div>

        <div class="buttons">
            <input type="submit" value="Continue" class="btn btn-primary">
        </div>
    </fieldset>
</form>

			</div>
		</div>
	</div>

@endsection