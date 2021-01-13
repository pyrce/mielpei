@extends("layout")

@section("content")
<button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajoutproduit">Ajouter</button>
<table class="table table-sm table-bordered table-responsive table-striped">
    <thead>
<tr>
<th  scope="col">Nom produit</th>
<th scope="col">stock</th>
<th scope="col">prix</th>
<th>Action</th>
</tr>
</thead>
<tbody>

@foreach($producteur as $p) 

<tr>
<td>{{ $p->nomProduit }}</td>
<td>{{ $p->stock }} <button class="btn btn-primary addstock" data-bs-toggle="modal" data-produitid="{{$p->produit_id}}" data-bs-target="#stockmodal"> <i class="fas fa-plus"></i> </button> </td>
<td>{{ $p-> prix}}</td>
<td> 
   
<i class="fas fa-minus-circle text-danger" onclick="deleteProduit('{{$p->produit_id }}')"></i> </td>

</tr>

@endforeach
</tbody>



</table>


<table class="table table-sm table-bordered table-responsive table-striped">
    <thead>
<tr>
<th  scope="col">Date</th>
<th scope="col">Client</th>
<th scope="col">produit</th>
<th scope="col">Quantitee</th>
<th scope="col">prix</th>
<th>Action</th>
</tr>
</thead>
<tbody>

@foreach($commandes as $c) 

<tr>
<td>{{ $c->date }}</td>
<td>{{ $c->nomUser }} {{$c->prenomUser}}</td>
<td>{{ $c-> nomProduit}}</td>
<td>{{ $c-> prix}}</td>
<td>{{ $c-> quantite}} </td>
<td> 

</td>

</tr>

@endforeach
</tbody>



</table>

<div class="modal fade" id="ajoutproduit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" id="close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex flex-column justify-content-start">
       
        <span>
            Nom produit : <input type="text" name="" id="nomProduit">
        </span>

        <span>
            stock  : <input type="number" name="" id="stock">
        </span>

        <span>
            Prix  : <input type="number" name="" id="prix">
        </span>

        <span>
       <button class="btn btn-primary" onclick="addproduit()">ajouter le produit</button>
        </span>
      </div>

    </div>
  </div>
</div>




<div class="modal fade" tabindex="-1" id="stockmodal" aria-labelledby="stockmodal" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Ajout stock</h5>
        <button type="button" class="btn-close" id="close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex flex-column justify-content-start">
       <input type="text" name="" value="" id="stockp" hidden>
        <span>
            Quantite : <input type="number" name="" id="stockval">
        </span>
        <button class="btn btn-primary" id="stock" onclick="addstock()">ajouter stock</button>
      </div>

    </div>
  </div>
</div>

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script>

$(document).on("click", ".addstock", function (e) {

e.preventDefault();

var _self = $(this);

var produitid = _self.data('produitid');
console.log(produitid)
//$("#bookId").val(myBookId);
$(".modal-body #stockp").val(produitid);
//$(this).modal('show');
});



    function addproduit(){
let data={};
data["nomProduit"]=$("#nomProduit").val();
data["stock"]=$("#stock").val();
data["prix"]=$("#prix").val();

$.ajax({
url:"/produits",
type:"POST",
data:{data,"_token": "{{ csrf_token() }}"},
success:()=>{
$("#close").click();
location.reload();
}

})
    }

    function deleteProduit(id){
        $.ajax({
url:"/produits",
type:"delete",
data:{id,"_token": "{{ csrf_token() }}"},
success:()=>{
$("#close").click();
location.reload();
}

})
    }

    function addstock(){
      data={}
      data["stock"]=$("#stockval").val()
      data["produitid"]=$("#stockp").val()
      $.ajax({
url:"/produits",
type:"put",
data:{data,"_token": "{{ csrf_token() }}"},
success:()=>{
//location.reload();
}

})
    }
</script>

@endsection