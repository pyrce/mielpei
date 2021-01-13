@extends("layout")

@section("content")

<table class="table table-sm table-bordered table-responsive table-striped">
    <thead>
<tr>
<th  scope="col">Date</th>
<th scope="col">Nombre article</th>
<th scope="col">Adresse</th>
<th scope="col">Total</th>
<th scope="col">Etat</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>

@foreach($commandes as $c) 

<tr>
<td>{{ $c->date }}</td>
<td>{{ count($c->produits) }}</td>
<td>{{ $c->addresse }}</td>
<td>{{ $total[$c->id] }}</td>
<td>{{$c->etat}}</td>
<td>
    <a href="/commandes/{{$c->id}}">Voir</a>
    <a href="/commandes/pdf/{{$c->id}}">pdf</a>
</td>


</tr>

@endforeach
</tbody>



</table>
@endsection