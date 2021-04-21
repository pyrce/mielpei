@extends("layout")

@section("content")



Nom {{$producteur->nomUser}} </br>

Preom {{$producteur->prenomUser}} </br>

Adresse {{$producteur->adresse}} </br>

Tel {{$producteur->tel}} </br>

<div class="msg"></div>

<div class="d-flex flex-row row row-cols-1 row-cols-md-2 g-4 m-2" style="height:auto">

@foreach($produits as $p) 

<div class="card" style="width: 18rem;">

  <div class="card-body">
    <h5 class="card-title">
            {{ $p->nomProduit }} </h5>
 <p> {{ $p->users[0]->pivot->prix }} €</p>           
<p>En stock {{ $p->users[0]->pivot->stock }}</p>

<span class="d-flex">


<button class="btn btn-success" onclick="addcart('{{$p->users[0]->pivot->produit_id}}','{{$p->users[0]->pivot->user_id}}','{{$p->users[0]->pivot->stock}}')"><i class="fas fa-cart-plus"></i></button>

   </span> 
  </div>
</div>


@endforeach
</div>

<script>

function addcart(id, producteur_id, stock) {


$.ajax({
  url: "/panier",
  type: "post",
  data: {
    id,
    producteur_id,
    stock,
    "_token": "{{ csrf_token() }}"
  },
  success: (id) => {

    $(".msg").show(100, "swing");
    $(".msg").html(
      '<button type="button"  class="btn btn-success">Le produit a bien été ajouté</button>'
    );
    $(".msg").delay(2250).hide(50, "swing");
    console.log(  localStorage.user);
  }
})

}
</script>
@endsection