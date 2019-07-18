@extends('layouts.custom')

@section('title')
    <title>METsoft - Znajdź odlew</title>
@endsection

@section('content')
    <br>
    <form action="{{ route('offers.details-searching-results') }}" method="POST" class="fieldset"> <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset>
            <legend>Znajdź odlew</legend>
            <ul>
                <li><label>Wpisz nr rys.:</label><input type="text" name="drawing_no" size="50"><br></li>
                <li><label>Wpisz nazwę odlewu:</label><input type="text" name="cast_name" size="50"><br></li>
                <li><label>Wpisz nr oferty:</label><input type="text" name="offer_no" size="50"><br></li>
                <button>Szukaj</button>         
            </ul>
        </fieldset>
    </form>    
@endsection