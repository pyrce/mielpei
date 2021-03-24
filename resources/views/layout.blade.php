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
        <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
    </head>
    <body class="antialiased">
    <div class="jumbotron jumbotron-fluid d-flex col-12 p-0 mb-0"  style="background-color:#2d2d2d;">
        <div class="container col-4" id="header">
          <h1 class="display-5 text-white mt-5 flex align-self-center text-center">Miel Pei</h1>

        </div>
    @if(Auth::user() !=null)


           <span class="flex align-self-center text-center col-2" style="font-family:Oswald;color:chartreuse;font-size:2rem;">Bienvenue {{ Auth::user()["nomUser"] }}</span>


    <div class="  d-flex col-2 p-0 mb-0" style="background-color:#525050;" >
            <div class="align-self-center  m-auto "><a href="/logout"><i class="fas fa-user-alt" style="font-size:2em;"></i></a></div>
        </div>
        <div class=" d-flex col-2 p-0 mb-0" style="background-color:#796a5a;" >
          <div class="align-self-center  m-auto "><a href="/panier"> <i class="fas fa-shopping-cart" style="font-size:2em;""></i></a></div>
      </div>
@else
  <div class=" d-flex col-2 p-0 mb-0" style="background-color:#525050;" >
      <div class="align-self-center m-auto "><a href="/login"><i class="fas fa-user-alt" style="font-size:2em;"></i></a></div>
  </div>
  
  <div class=" d-flex col-2 p-0 mb-0" style="background-color:#796a5a;" >
      
    <div class="align-self-center m-auto "> 
      
      <i class="fas fa-shopping-cart " style="font-size:2em;display:inline-block;"></i>
</div>
  </div>
  @endif
  
    </div>
    <ul class="nav">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/">Accueil</a>
  </li>

  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/register">Créer un compte</a>
  </li>
  @if(Auth::user() !=null)
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/panier">Panier</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/commandes">Commandes</a>
  </li>
@endif
@if(Auth::user() !=null and Auth::user()["role_id"]==2)  
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/producteur">Mes produits</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/producteur/{{Auth::user()['id']}}">Mes infos</a>
  </li>
  @endif
@if(Auth::user() !=null and Auth::user()["role_id"]==1)  
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/admin">Admin</a>
  </li>
@endif

</ul>
@yield("content")

<style>
  
.card-title{
    font-family: 'Oswald', sans-serif;
}
.card{
  background-color: aquamarine;
  margin: 5px 12px;
}

#ventes li{
  font-family: 'Quicksand', sans-serif;
}


.info{
  background-color: burlywood;
  text-align: center;
  font-family: 'Montserrat', sans-serif;
}
th{
  text-align: center;
}
#map{
 
    margin-top: 10px;

    height: 27rem;
}
.error_msg{
  text-align: center;
  background: #F8D7DA;
  padding: 8px 0;
  border-radius: 5px;
  color: #8B3E46;
  border: 1px solid #F5C6CB;
  display: none;
}

.error-code{
  font-family: "Merriweather";
}
.error-msg{
  font-family:Quicksand ;
}
</style>
<script src="https://kit.fontawesome.com/c1f6020dab.js" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    </body>
</html>