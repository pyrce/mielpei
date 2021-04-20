@extends("./producteurs/producteurs_layout")

@section("producteur")

<div id="commandes" class="bhoechie-tab-content">
<h2 class="info">Mes commandes</h2>
<table class="table table-sm table-bordered table-responsive table-striped">
    <thead>
<tr>
<th  scope="col">Date</th>
<th scope="col">Client</th>
<th>Etat</th>
<th>Total</th>

<th>Action</th>
</tr>
</thead>
<tbody>

@foreach($commandes as $c) 

<tr>
<td>{{ $c->date }}</td>
<td>{{ $c->nomUser }} {{$c->prenomUser}}</td>
<td>{{ $c->etat }}</td>
<td>{{ $c-> total[$c->id ] }}</td>

<td> 
<a href="/producteurs/commandes/{{$c->id}}">Voir</a>
</td>

</tr>

@endforeach
</tbody>
</table>
</div>

@endsection