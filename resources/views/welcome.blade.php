@extends("layout")

@section("content")

@if(session("success"))
<div class="alert-modal">
  {{session("success")}}
</div>
@endif

<div class="container-fluid col-12">
<div class="d-flex flex-row row row-cols-1 row-cols-md-2 g-4" style="height:auto">
@foreach($produits as $p) 

<div class="card" style="width: 18rem;">

  <div class="card-body">
    <h5 class="card-title">
            {{ $p->nomProduit }} </h5>
 <p> {{ $p->prix }} €</p>           
<p>En stock {{ $p->stock }}</p>

<span class="d-flex">
<button class="btn btn-success" onclick="addcart('{{$p->produit_id}}','{{$p->user_id}}','{{$p->stock}}')"><i class="fas fa-cart-plus"></i></button>
    <a href="/producteurs/{{$p->user_id }}" class="btn btn-primary">{{$p->nomUser}} {{$p->prenomUser}} </a>
   </span> 
  </div>
</div>


@endforeach

</div>

</div>

<div class="col-10">
{{ $produits->onEachSide(5)->links() }}
</div>
<script>
function addcart(id,producteur_id,stock){

$.ajax({
  url:"/panier",
  type:"post",
  data:{id,producteur_id,stock,"_token": "{{ csrf_token() }}"},
  success:()=>{
    alert("ok")
  }
})

}
</script>
@endsection