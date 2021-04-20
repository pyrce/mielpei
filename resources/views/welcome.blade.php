@extends("layout")

@section("content")

@if(session("success"))
<div class="alert-modal">
  {{session("success")}}
</div>
@endif
<div class="msg"></div>

<div class="container-fuild d-flex flex-row">
    <div id="map" class="col-8"></div>

    <div class="d-flex flex-column col-4">

<div class="border border-primary" id="best">

  <h3 class="text-center bg-info">Meilleur ventes</h3>
  <ul id="ventes" class="list-group">
    @foreach($ventes as $v)
    <li class="list-group-item">{{$v->nomProduit}} 
    <button class="btn btn-success" onclick="addcart('{{$v->produit_id}}','{{$v->user_id}}','{{$v->stock}}')"><i class="fas fa-cart-plus"></i></button>

     </li>

    @endforeach
  </ul>

</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
  }

<script>
$( document ).ready(function() {
  // Handler for .ready() called.
  initMap()
});
  // Handler for .ready() called.
  function initMap() {
    var map = L.map( 'map', {
    center: [-21.136116292703512, 55.53794609004923],
    minZoom: 2,
    zoom: 10
});


L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    subdomains: ['a','b','c']
}).addTo( map ); 

var marker = L.marker([-20.879515085382998, 55.44734590158237]).addTo(map).on("click",()=>{
  location.href="/producteurs/3"
});
var marker = L.marker([-20.93374660034533, 55.33624008261506]).addTo(map).on("click",()=>{
  location.href="/producteurs/2"
});
  }
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