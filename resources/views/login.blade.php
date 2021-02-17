@extends("layout")

@section("content")
<div class="container-fluid col-3">

@csrf
<div class="msg"></div>
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


<script>
function submit(){


  $.ajax({
    url:"/login",
    type:"post",
    data:{login:$("#login").val(),password:$("#password").val(),"_token": "{{ csrf_token() }}"},
    success:(msg)=>{

      if(msg["error"]){

      $(".msg").show(100, "swing");
                $(".msg").html(
                  '<button type="button"  class="btn btn-danger">'+msg["error"]+'</button>'
                  );
                $(".msg").delay(2250).hide(50, "swing");
    }
    else
    {   
        location.reload()
        location.href="/"
    }
  
    }
  })
}

</script>
@endsection