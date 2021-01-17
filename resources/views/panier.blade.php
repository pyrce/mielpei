@extends("layout")

@section("content")

@if(count($panier)>0)
<div class="msg m-auto"></div>
<div class="d-flex flex-lg-row flex-sm-column-reverse justify-content-sm-center justify-content-lg-around flex-wrap-reverse flex-sm-wrap">

  <div class="d-flex flex-column">

    <input type="text" data-id="{{$panier[0]->id}}" data-user="1" id="panierId" hidden>
    @foreach($panier[0]["produits"] as $p)

    <div class="card m-auto" style="width: 90%; margin-bottom:2% !important; margin-top:2% !important;">
      <div class="row no-gutters">
        <div class="col-md-4">
          <img class="card-img-top img-fluid" src="http://placehold.it/400x400" alt="">
        </div>
        <div class="d-flex col-8 align-items-center justify-content-start">
          <div class="col-md-6 col-lg-6">
            <div class="card-body col-11 m-0" id="body">
              <h5 class="card-title">Nom (réf) :{{$p->nomProduit}}</h5>
              <p class="card-text ">Quantité en stock : {{ $p->stock }}</p>
            </div>
          </div>
          <input min="1" max="{{ $p->stock }}" type="number" value="{{ $p->pivot->quantite }}" data-id="{{ $p->produit_id }}" onchange="updateqte('{{ $p->produit_id }}',this.value)">

          <i class="fas fa-times ml-3 mr-3" onclick="remove('{{$p->pivot->panier_id}}','{{ $p->id }}')" style="color:#796a5a;"></i>
        </div>
      </div>

    </div>
    @endforeach
  </div>

  <div>
    <input type="text" name="" list="liste_adresse" id="adresse" onFocus="listeAdresse()">
    <datalist id="liste_adresse">
    </datalist>

    <div class="card ml-5" style="width: 18rem;max-height:150px;" id="montant">
      <div class="card-body">
        <h5 class="card-title">Montant total des produits</h5>
        <p id="somme" class="card-text"> {{ $total}} €</p>
      </div>
      <ul class="list-group list-group-flush" id="commande">
        <li id="paypal-button" class=" btn-success pt-2 pb-2 text-center">Passer commande</li>
      </ul>
    </div>
  </div>
</div>
@else
<div class="row alert alert-success col-10 m-auto h-50" role="alert" style="margin-top:8vh !important;">
  <div class="m-auto text-center">
    <p class="display-3 ">Votre panier est vide</p>
    <a href="/" class=""> Choisissez des produits qui vous correspondent </a>
  </div>
</div>
@endif
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>
  $("#paypal-button").on("click", function() {
    let id = $("#panierId").data("id");

    $.ajax({
      url: "/panier",
      type: "delete",
      data: {
        id,adresse:$("#adresse").val(),
        "_token": "{{ csrf_token() }}"
      },
      success: () => {
location.reload();
      }
    })

  })

  function listeAdresse() {
    console.log("adresse")
    $.ajax({
      url: "/panier/listeadresse",
      type: "get",
      success: (data) => {
        console.log(data);
        data[0].forEach(a => {
         // console.log(a.addresse)
          $("#liste_adresse").append("<option>"+a.addresse+"</option>")
        })
      }
    })

  }
  function updateqte(id,value){
    $.ajax({
      url:"/panier",
      type:"PUT",
      data:{id,value,"_token": "{{ csrf_token() }}"},
      susscess:()=>{

      }
    })
  }
  function remove(panier,id){
    $.ajax({
      url:"/panier/remove",
      type:"delete",
      data:{panier,id,"_token": "{{ csrf_token() }}"},
      susscess:()=>{
location.reload();
      }
    })

  }
</script>
@endsection