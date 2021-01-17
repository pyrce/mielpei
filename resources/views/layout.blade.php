<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--meta name="csrf-token" content="{{ csrf_token() }}"-->
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body class="antialiased">
    <ul class="nav">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/">Accueil</a>
  </li>

  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/panier">Panier</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/commandes">Commandes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/producteur">Mes produits</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/producteur/2">Mes infos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/admin">Admin</a>
  </li>
</ul>
@yield("content")
<script src="https://kit.fontawesome.com/c1f6020dab.js" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    </body>
</html>