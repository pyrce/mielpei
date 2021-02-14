@extends("layout")

@section("content")

<table class="table table-sm table-bordered table-responsive table-striped">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">role</th>
            <th>Mail</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach($users as $u)

        <tr>

            <td>{{ $u->nomUser }} </td>
            <td>{{ $u-> prenomUser}}</td>
            <td>

                <select name="" class="col-3" onchange="changerole('{{$u->id }}','role_id',this.value)" class="roles">
                    @foreach($roles as $r)
                    <option value="{{ $r->id}}" {{ ($u->role_id===$r->id )? 'selected':''  }}>{{$r->libelle}}</option>
                    @endforeach
                </select>
            </td>
<td>
<input type="text" value="{{$u->email}}" oninput="changerole('{{$u->id }}','email',this.value)"/> 
</td>
<td>  
@if($u->etat==1)
<a href="/admin/desactiver/{{$u->id}}"><i class="fas fa-lock-open text-success"></i> </a> 
@else
<a href="/admin/desactiver/{{$u->id}}"><i class="fas fa-lock text-warning"></i> </a> 
@endif
</td>
        </tr>

        @endforeach
    </tbody>



</table>

<div class="modal fade" tabindex="-1" id="adduser" aria-labelledby="stockmodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajout stock</h5>
                <button type="button" class="btn-close" id="close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column justify-content-start">

                <form action="/admin" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nom utilisateur</label>
                        <input type="text" class="form-control" id="nomUser" name="nomUser" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Prenom utilisateur</label>
                        <input type="text" class="form-control" id="nomUser" name="prenomUser" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Rôle utilisateur</label>
                        <select name="role" class="col-3">
                            @foreach($roles as $r)
                            <option value="{{ $r->id}}">{{$r->libelle}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary" id="stock">ajouter utilisateur</button>
                </form>
            </div>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script>
    function changerole(userid,champ, value) {

        $.ajax({
            url: "admin",
            type: "put",
            data: {
                userid,
                champ,
                value,
                "_token": "{{ csrf_token() }}"
            },
            success: () => {

            }

        })
    }
</script>
</div>
@endsection