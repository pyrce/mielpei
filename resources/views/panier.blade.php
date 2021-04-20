@extends("layout")

@section("content")

@if(count($panier)>0)
<div class="msg m-auto"></div>
<div class="d-flex flex-lg-row flex-sm-column-reverse justify-content-sm-center justify-content-lg-around flex-wrap-reverse flex-sm-wrap">

  <div class="d-flex flex-column">

    <input type="text" data-id="{{$panier[0]->id}}" data-user="1" id="panierId" hidden>
    @foreach($panier[0]["produits"] as $p)

    <div class="card m-auto" style="width: 40rem;height:10rem; margin-bottom:2% !important; margin-top:2% !important;">
      <div class="row no-gutters">
        <div class="col-md-4 text-center">
        <img src="{{ url('honey-156826_640.png') }}" style="width:7rem;" alt="tag">  
        </div>
        <div class="d-flex col-8 align-items-center justify-content-start">
          <div class="col-md-6 col-lg-6">
            <div class="card-body col-11 m-0" id="body">
              <h5 class="card-title">Nom (réf) :{{$p->nomProduit}}</h5>
              <h5>Prix : {{$p->pivot->prix}}</h5>
              <p class="card-text ">Quantité en stock : {{ $p->pivot->stock }}</p>
            </div>
          </div>
          <input min="1" max="{{ $p->pivot->stock  }}" type="number" value="{{ $p->pivot->quantite }}" data-id="{{ $p->produit_id }}" onchange="updateqte('{{ $p->id }}',`${this.value}`)">

          <i class="fas fa-times ml-3 mr-3" onclick="remove('{{$p->pivot->panier_id}}','{{ $p->id }}')" style="color:#796a5a;"></i>
        </div>
      </div>

    </div>
    @endforeach
  </div>

  <div>

    <div class="card m-0" style="width: 18rem;max-height:150px;" id="montant">
      <div class="card-body">
        <h5 class="card-title">Montant total des produits</h5>
        <p id="somme" class="card-text"> {{ $total}} €</p>
      </div>
      <ul class="list-group list-group-flush" id="commande">
        <li id="paypal-button" class=" btn-success pt-2 pb-2 text-center">   <a href="/macommande" class="text-light"> Passer commande</a></li>
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
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>

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