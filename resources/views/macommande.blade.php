@extends("layout")

@section("content")

<div class="container">
<form action="/panier/paiement" method="POST">
@csrf

<header class="bg bg-info border border-black">Adresse Livraison</header>

<div class="row mb-3">
        <div class="col">
            <label for="exampleInputEmail1" class="form-label row">N° voie</label>
            <input type="number" class="form-control row" id="voie_livraison" name="voie_livraison" aria-describedby="nom" required>
        </div>
        <div class="col">
            <label for="exampleInputEmail1" class="form-label row">Adresse</label>
            <input type="text" class="form-control row" id="rue_livraison" name="rue_livraison" aria-describedby="prenom"  required>
        </div>
</div>

<div class="row mb-3">
<div class="col">
            <label for="exampleInputEmail1" class="form-label row">Ville</label>
            <input type="text" class="form-control row" id="ville_livraison" name="ville_livraison" aria-describedby="prenom"  required>
        </div>
        <div class="col">
            <label for="exampleInputEmail1" class="form-label row">Pays</label>
            <input type="text" class="form-control row" id="pays_livraison" name="pays_livraison" aria-describedby="prenom"  required>
        </div>
</div>



<header class="bg bg-info border border-black">Adresse Facturation</header>
<div class="row mb-3">
        <div class="col">
            <label for="exampleInputEmail1" class="form-label row">N° voie</label>
            <input type="number" class="form-control row" id="voie_facturation" name="voie_facturation" aria-describedby="nom" required>
        </div>
        <div class="col">
            <label for="exampleInputEmail1" class="form-label row">Adresse</label>
            <input type="text" class="form-control row" id="rue_facturation" name="rue_facturation" aria-describedby="prenom"  required>
        </div>
</div>

<div class="row mb-3">
<div class="col">
            <label for="exampleInputEmail1" class="form-label row">Ville</label>
            <input type="text" class="form-control row" id="ville_facturation" name="ville_facturation" aria-describedby="prenom"  required>
        </div>
        <div class="col">
            <label for="exampleInputEmail1" class="form-label row">Pays</label>
            <input type="text" class="form-control row" id="pays_facturation" name="pays_facturation" aria-describedby="prenom"  required>
        </div>
</div>

<button type="submit" class="btn btn-primary">commander</button>
</form>
</div>
@endsection