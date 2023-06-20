<x-app-layout>
    <script>
    // modifica la vista e permette inserimentro tramite input
    function modProd(x) {
        let nome = document.getElementById("nome" + x);
        let i_nome = document.getElementById("i_nome" + x);
        let desc = document.getElementById("desc" + x);
        let i_desc = document.getElementById("i_desc" + x);
        let prezzo = document.getElementById("prezzo" + x);
        let i_prezzo = document.getElementById("i_prezzo" + x);
        let update = document.getElementById("update" + x);
        let button = document.getElementById("mod" + x);

        nome.style.display = "none";
        i_nome.style.display = "block";
        desc.style.display = "none";
        i_desc.style.display = "block";
        prezzo.style.display = "none";
        i_prezzo.style.display = "block";
        update.style.display = "block";
        button.style.display = "none";
    }
    </script>
    <style>
    .centerimg {
        display: block;
        width: 200px;
        height: 200px;
    }
    </style>
    @if (session('alert'))
    <div class="alert alert-danger">
        <p style="text-align: center;" class="fs-4">{{ session('alert') }}</p>
    </div>
    @endif
    @if (session('alert2'))
    <div class="alert alert-primary">
        <p style="text-align: center;" class="fs-4">{{ session('alert2') }}</p>
    </div>
    @endif
    <table class="table table-light table-striped">
        <thead>
            <tr>
                <th scope="col" style="text-align: center;">Id prodotto</th>
                <th scope="col">Immagine</th>
                <th scope="col">Prodotto</th>
                <th scope="col" style="text-align: center;">Data inserimento</th>
                <th scope="col" style="text-align: center;">Descrizione</th>
                <th scope="col">Prezzo</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prods as $prod)
            <tr>
                <form action="{{url('updateprod')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <th scope="row">{{$prod['id']}}</th>
                    <td><img src="{{ asset('images/db/'.$prod->image)}}" alt="Immagine" class="centerimg"></td>
                    <td>
                        <p id="nome{{$prod['id']}}">{{$prod['nome_prodotto']}}</p>
                        <p><input type="text" name="nome" value="{{$prod['nome_prodotto']}}"
                                class="form-control rounded" id="i_nome{{$prod['id']}}" style="display: none;"></p>
                    </td>
                    <td>
                        {{$prod['created_at']}}
                    </td>
                    <td>
                    <p id="desc{{$prod['id']}}">{{$prod['descrizione']}}</p>
                    <p><input type="text" name="desc" value="{{$prod['descrizione']}}"
                                class="form-control rounded" id="i_desc{{$prod['id']}}" style="display: none;"></p>
                    </td>
                    <td>
                    <p id="prezzo{{$prod['id']}}">{{$prod['prezzo']}}€</p>
                    <p><input type="number" name="prezzo" value="{{$prod['prezzo']}}"
                                class="form-control rounded" id="i_prezzo{{$prod['id']}}" style="display: none;"></p>
                    </td>
                    <td>
                        <!-- quando il bottone viene premuto manda una funzione js onclick e come parametro l'id del prodotto corrispondente -->
                        <button type="button" class="btn btn-outline-info" id="mod{{$prod['id']}}" value="{{$prod['id']}}"
                            onclick="modProd(value)">
                            Modifica</button>
                        <button type="submit" class="btn btn-outline-warning" name="updateprod"
                            id="update{{$prod['id']}}" value="{{$prod['id']}}" style="display: none;">
                            Mannala</button>
                    </td>
                </form>
                <td>
                    <form action="{{url('deleteprod')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger" name="deleteprod" value="{{$prod['id']}}"
                            onclick="return confirm('Sicuro di eliminare prodotto, eliminerai pure tutti prodotti nei carrelli');">
                            Cancella</button>
                    </form><br>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>