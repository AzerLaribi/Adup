<!doctype html>
<html lang="en">
  <head>
  	<title>Add Tags</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{asset('css/style.css')}}">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img"style="background-image: url({{ asset('/img/adup5.png')}});">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Add your Tags</h3>
			      		</div>
			      	</div>

                    @if(\Session::has('message'))
                        <p class="alert alert-info">
                            {{ \Session::get('message') }}
                        </p>
                    @endif
							<form method="POST" action="/AddTag" class="signin-form">
                            {{ csrf_field() }}
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">New Tag</label>
			      			<input name="name" type="text" class="form-control" required autofocus placeholder="Tag" value="">
			      		</div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
		            </div>

		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>


	</body>
</html>
