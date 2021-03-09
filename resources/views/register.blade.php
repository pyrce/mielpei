@extends("layout")

@section("content")
<div class="container-fluid col-3">
<form action="/register" method="POST">
    @csrf
    <div class="msg"></div>

    <div class="row mb-3">
        <div class="col">
            <label for="exampleInputEmail1" class="form-label row">Nom</label>
            <input type="text" class="form-control row" id="nom" name="nom" aria-describedby="nom" required>
        </div>
        <div class="col">
            <label for="exampleInputEmail1" class="form-label row">Prénom</label>
            <input type="text" class="form-control row" id="prenom" name="prenom" aria-describedby="prenom"  required>
        </div>
    </div>

    <div class="row">
        <label for="exampleInputPassword1" class="form-label col">Role</label>
        <select name="role_id" class="col" id="role_id">
        <option value="2">Producteur</option>
        <option value="3">Client</option>
        </select>
    </div>

    <div class="row mb-3">
            <label for="email" class="form-label ">Email</label>
            <input type="text" class="form-control" id="email" name="email" aria-describedby="email"  required>
    </div>

    <div class="row mb-3">
            <label for="exampleInloginputEmail1" class="form-label ">Login</label>
            <input type="text" class="form-control" id="login" name="login" aria-describedby="login"  required>
    </div>

    <div class="row mb-3">
            <label for="password" class="form-label ">Password</label>
            <span class="error_password"></span>
            <input type="password" class="form-control" id="password" name="password"  required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" aria-describedby="password">
    </div>

    <div class="row mb-3">
            <label for="confirm_password" class="form-label ">Confirm password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" oninput="checkPassword()" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" aria-describedby="password">
    </div>

    <button type="submit" class="btn btn-primary">Créer un compte</button>
</form>
</div>


<script>
function checkPassword(){
    let password=$("#password").val();
    let confirm=$("#confirm_password").val();

    if(confirm.length>=password.length){
        if(password!=confirm){
           console.log("different") 
            $(".error_password").html("<p>Les mots de passe de correspondent pas</p>")
            $(".error_password").addClass("error_msg")
            $(".error_password").css({'display':"block"})
        }else{
            $(".error_password").html("")
            $(".error_password").css({'display':"none"})
        }

    }
}
</script>
@endsection