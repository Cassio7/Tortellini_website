<x-guest-layout>
</x-guest-layout>
<!-- stile per visualizzazione di admin non utente! -->
<style> 
.center{
  text-align: center;
}
.centerimg{
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 200px;
    height: 200px;
}
</style>
<h1 class="fs-1" style="text-align: center;">Catalogo prodotti disponibili</h1>
<br>
<div class="center">
    @foreach($products as $product)
    <form action="{{url('new_order')}}" method="POST" enctype="multipart/form-data">
     @csrf   
        <input type="hidden" name="product_id" value="{{ $product['id']}}">
        <br> <h2>{{$product['id']}}</h2>
            {{$product['nome_prodotto']}}
            <br>
            {{$product['descrizione']}} 

        <img src="{{ asset('images/db/'.$product->image)}}" alt="Immagine" class="centerimg">
        @if (Route::has('login'))
        @auth
        <button type="submit" class="btn btn-primary bg-primary">Acquista</button>
        </form>
        @else
        <a class="btn btn-success" href="{{route('login')}}">Login per acquistare</a>
        @endauth
        @endif
    
    @endforeach
</div>