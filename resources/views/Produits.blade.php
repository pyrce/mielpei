

@section("content")



@foreach($produits as $p) 
{{ $p->nomProduit }} {{ $p->prix }} € ( {{$p->nomProducteur}} )</br>
@endforeach

@endsection