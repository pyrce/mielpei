<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--meta name="csrf-token" content="{{ csrf_token() }}"-->
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    </head>
    <body >
    <div class="container-fuild ">

        <div class="d-flex flex-row justify-content-between col-lg-12 col-md-5 col-sm-8 col-xs-9">

    
 
              <div class="list-group bg-secondary">

<a class="list-group-item text-center" href="/logout"><i class="fas fa-user-alt" style="font-size:2em;"></i></a>

                <a href="/producteur" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-home"></h4><br/>Home
                </a>
                <a href="/producteur/mesproduits" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-road"></h4><br/>produits
                </a>
                <a href="/producteur/commandes" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-plane"></h4><br/>commandes
                </a>

              </div>
   
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab col">
     @yield("producteur")
            </div>
        </div>
 
</div>

<script src="https://kit.fontawesome.com/c1f6020dab.js" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    </body>
</html>