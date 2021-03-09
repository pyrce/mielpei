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

  <div class="d-flex flex-column col-6">

    <div class="border border-primary" id="best">

      <h3 class="text-center bg-info">Meilleur ventes</h3>
      <ul id="ventes" class="list-group">
        @foreach($ventes as $v)
        <li class="list-group-item">{{$v->nomProduit}} </li>

        @endforeach
      </ul>

    </div>


    <div id="map" class="col-12"></div>
  </div>


</div>

<div class="col-10">
  {{ $produits->links('pagination::bootstrap-4') }}
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
    center: [-20.879515085382998, 55.44734590158237],
    minZoom: 2,
    zoom: 9
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
      success: () => {

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