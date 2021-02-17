@extends("layout")

@section("content")

@if(session("success"))
<div class="alert-modal">
  {{session("success")}}
</div>
@endif
<div class="msg"></div>
<div class="container-fluid col-12 d-flex flex-row">

<div class="row row-cols-4 clearfix" style="height:auto">
@foreach($produits as $p) 

<div class="card shadow" style="width: 15rem;">

  <div class="card-body">
    <h5 class="card-title titre">
            {{ $p->nomProduit }} 

            </h5>
 <p> {{ $p->prix }} €</p>   

 <img src="{{ url('honey-156826_640.png') }}" style="width:6rem;" alt="tag">    
<p>En stock : {{ $p->stock }}</p>

<span class="d-flex justify-content-between">

    <a href="/producteurs/{{$p->user_id }}" class="btn btn-primary">{{$p->nomUser}} {{$p->prenomUser}} </a>

@if(Auth::user()!="")
<button class="btn btn-success" onclick="addcart('{{$p->produit_id}}','{{$p->user_id}}','{{$p->stock}}')"><i class="fas fa-cart-plus"></i></button>
@endif

   </span> 
  </div>
</div>


@endforeach

</div>

<div class="border border-primary col-4" id="best">
<h3 class="text-center bg-info">Meilleur ventes</h3>
<ul id="ventes"  class="list-group">
@foreach($ventes as $v)
<li class="list-group-item">{{$v->nomProduit}} </li>

@endforeach
</ul>
</div>

</div>

<div class="col-10">
{{ $produits->links('pagination::bootstrap-4') }}
</div>
<script>
function addcart(id,producteur_id,stock){

$.ajax({
  url:"/panier",
  type:"post",
  data:{id,producteur_id,stock,"_token": "{{ csrf_token() }}"},
  success:()=>{
  
    $(".msg").show(100, "swing");
                $(".msg").html(
                  '<button type="button"  class="btn btn-success">Le produit a bien été ajouté</button>'
                  );
                $(".msg").delay(2250).hide(50, "swing");
  }
})

}
</script>
@endsection