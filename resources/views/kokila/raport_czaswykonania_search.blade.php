@extends('layouts.custom')

@section('title')
    <title>METsoft - Czas wykonania - szukanie</title>
@endsection

@section('content')

<div class="alert">Jak nie wpiszemy danych do wyszukiwania to pokaże pierwsze 1000 wpisów</div>


<form action="{{ route('czas-wykonania-results') }}" method="POST" class="fieldset" > <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <fieldset>
        <legend>Wyszukiwanie</legend>
        <ul>
            <!--      <i>(Wyszukiwanie pomija oferty będące obecnie w opracowaniu)</i><br><br> -->
            <li><label>Nr MET:</label><input type="text" name="met_number" size="80"><br></li>
            <li><label>Klient:</label><input type="text" name="company" size="80"><br></li>
            <li><label>Nazwa odlewu:</label><input type="text" name="cast_name" size="80"><br></li>
            <li><label>Nr rysunku:</label><input type="text" name="picture_number" size="80"><br></li>
            <input type="submit" value="Szukaj">
        </ul>
    </fieldset>
</form>
@endsection

