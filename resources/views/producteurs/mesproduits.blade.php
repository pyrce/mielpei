@extends("producteurs.producteurs_layout")

@section("producteur")


<div class="bhoechie-tab-content" id="produits">
<button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajoutproduit">Ajouter</button>

<h2 class="info">Mes Produits</h2>

<div class="row row-cols-3 g-4">
@foreach($producteur as $p) 
<div class="col">
<div class="card" style="width: 16rem;">

  <div class="card-body">
    <h5 class="card-title">
            {{ $p->nomProduit }} </h5>
 <p> {{ $p->prix }} €</p>           
<p>En stock {{ $p->stock }}</p>

<span class="d-flex">
<i class="fas fa-minus-circle text-danger" onclick="deleteProduit('{{$p->produit_id }}')"></i> 
<button class="btn btn-primary addstock" data-bs-toggle="modal" data-produitid="{{$p->produit_id}}" data-bs-target="#stockmodal"> <i class="fas fa-pen"></i> </button></td>

   </span> 
  </div>
</div>
</div>
@endforeach

</div>
<div class="col-10">
  {{ $producteur->links('pagination::bootstrap-4') }}
</div>
</div>
  
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
        <button class="btn btn-primary" id="stock" onclick="addstock()">modifier stock</button>
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
url:"/producteurs",
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
url:"/producteurs",
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
      console.log(data);
      $.ajax({
url:"/producteurs/stock",
type:"put",
data:{data,"_token": "{{ csrf_token() }}"},
success:()=>{
//location.reload();
}

})
    }
</script>

@endsection