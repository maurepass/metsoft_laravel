@extends('layouts.custom')

@section('title')
    <title>METsoft - Znajdź modele</title>
@endsection

@section('content')
    <br>
    <form action="/patterns_search" method="POST" class="fieldset"> 
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset>
            <legend>Znajdź modele</legend>
            <ul>
                <li><label>Nazwa firmy</label><input type="text" name="customer" size="80"><br></li>
                <li><label>Numer rysunku</label><input type="text" name="drawing_number" size="80"><br></li>
                <li><label>Nazwa odlewu</label><input type="text" name="pattern_name" size="80"><br></li>
                <li><label>Numer ułożenia</label><input type="text" name="layer_number" size="80"><br></li>
                <li><label>Miejsce ułożenia</label><input type="text" name="layer_place" size="80"><br></li>
                <li><label>Numer kartoteki</label><input type="text" name="cart_number" size="80"><br></li>
                <li><label>Numer indexu modelu</label><input type="text" name="pattern_index" size="80"><br></li>
                <li><label>Czas nieużywania modelu</label><input type="number" name="notusing_time" size="80" placeholder="ilość miesięcy"><br></li>
                <button>Szukaj</button> 
            </ul>
        </fieldset>
    </form>
@endsection
