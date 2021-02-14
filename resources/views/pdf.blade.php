<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<style>
tr:nth-child(odd){
    background-color: #cadbef;
}
th{
    background-color: coral;
}
</style>
    <title>Document</title>
</head>
<body>
    



<div id="user" class="border border-info" style="margin:30px">
{{ $user->nomUser}} {{ $user->prenomUser}} <br>
{{ $user->adresse}} <br>
{{ $user->tel}}
</div>
<br>
<div id="info"  class="border border-info" style="margin-top:30px">

Fait le : {{ $commande->date }} <br>


</div>
<br>
<div>

<table class="table table-sm table-bordered table-responsive table-striped" id="produit" style="outline:solid 1px black;">
<thead class="table-info">
<tr>
<th scope="col">produit</th>
<th scope="col">Quantitee</th>
<th scope="col">prix</th>
</tr>
</thead>
<tbody>


@foreach($commande->produits as $c)
<tr>
<td>{{ $c-> nomProduit}}</td>
<td>{{ $c->pivot-> quantite }} </td>
<td>{{ $c->pivot-> prix}}</td>


</tr>

@endforeach
</tbody>



</table>
total : {{ $total}} €
</div>

</body>
</html>