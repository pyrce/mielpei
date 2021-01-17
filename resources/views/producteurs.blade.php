@extends("layout")

@section("content")



Nom {{$producteur->nomUser}} </br>

Preom {{$producteur->prenomUser}} </br>

Adresse {{$producteur->adresse}} </br>

Tel {{$producteur->tel}} </br>



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

   </span> 
  </div>
</div>


@endforeach
</div>
@endsection