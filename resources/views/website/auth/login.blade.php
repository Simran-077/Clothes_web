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
				<div class="page-login">
				
					<div class="account-border">
						<div class="row">
							
							<form action="{{ route('website.login') }}" method="post" enctype="multipart/form-data">
                             @csrf
                            <div class="customer-login">
                                <div class="well">
                                    <h2><i class="fa fa-file-text-o" aria-hidden="true"></i> Customer</h2>
                                    <div class="form-group">
                                        <label class="control-label" for="input-email">E-Mail Address</label>
                                        <input type="text" name="email" id="input-email" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="input-password">Password</label>
                                        <input type="password" name="password" id="input-password" class="form-control" />
                                    </div>
                                </div>
                                <div class="bottom-form">
                                    <input type="submit" value="Login" class="btn btn-default pull-right" />
                                </div>
                            </div>
                        </form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>

@endsection