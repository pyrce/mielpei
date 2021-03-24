@extends("layout")

@section("content")

<div class="container d-flex flex-column">
<div class="msg"></div>
    <div  class="row">

        <span class="row">
        <label class="col">Nom</label>
        <input type="text" name="nomUser"  class="col" value="{{$producteur->nomUser}}" id="nomUser">
        </span>

        <span class="row">
        <label class="col">Prenom</label>
        <input  class="col" type="text" name="nomUser" value="{{$producteur->prenomUser}}" id="prenomUser">
        </span>

    </div>


<div class="row">
<span class="row">
        <label  class="col">Telephone</label>
        <input class="col" type="text" name="nomUser" value="{{$producteur->tel}}" id="tel">
        </span>

        <span class="row">
        <label class="col">Adresse</label>
        <input class="col" type="text" name="nomUser" value="{{$producteur->adresse}}" id="adresse">
        </span>
</div>

<button class="btn btn-primary col-2 float-end" onclick="modifier('{{$producteur->id}}')">Modifier</button>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>

function modifier(id){
    data={}
    data["nomUser"]=$("#nomUser").val();
    data["prenomUser"]=$("#prenomUser").val();
    data["tel"]=$("#tel").val();
    data["adresse"]=$("#adresse").val();
$.ajax({
url:"/producteur",
type:"PUT",
data:{data,id, "_token": "{{ csrf_token() }}"},
success:()=>{
    $(".msg").show(100, "swing");
        $(".msg").html(
          '<button type="button"  class="btn btn-success">Le(s) information(s) a(ont) été bien changé(s)</button>'
        );
        $(".msg").delay(2250).hide(50, "swing");
}
})
}
</script>
@endsection