@extends("layout")

@section("content")
<div class="container-fluid col-3">
<form action="/login" method="POST">
@csrf
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Login</label>
    <input type="text" class="form-control" id="login" name="login" aria-describedby="login">
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="password">
  </div>

  <button onclick="submit()" class="btn btn-primary">Submit</button>

</div>
</form>

@endsection