@extends("layout")

@section("content")

<table class="table table-sm table-bordered table-responsive table-striped">
    <thead>
<tr>
<th  scope="col">nom Produit</th>
<th scope="col">Prix</th>
<th scope="col">Quantite</th>
</tr>
</thead>
<tbody>
Commande fait le {{$commande->date}}
@foreach($commande->produits as $c) 

<tr>
<td>{{ $c->nomProduit }}</td>
<td>{{ $c->pivot->prix }}</td>
<td>{{ $c->pivot->quantite }}</td>

</tr>

@endforeach
</tbody>



</table>
@endsection