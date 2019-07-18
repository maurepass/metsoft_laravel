@extends('layouts.custom')

@section('title')
    <title>METsoft - Menu Raporty</title>
@endsection

@section('content')
    <div class="table_title">Lista raportów</div>
    <div class="menu-raporty">
        <ul>
            <li><a href="{{ route('monitoring-in-work') }}" >Monitoring odlewów w produkcji</a></li>
            <li><a href="{{ route('monitoring-all') }}" >Monitoring odlewów (wszystkie zlecenia)</a></li>
            <li><a href="{{ route('odbiory') }}">Rejestr odbiorów</a></li>
            <li><a href="{{ route('zalania') }}">Rejestr zalań</a></li>
            <li><a href="{{ route('niezgodnosci') }}">Rejestr niezgodnych operacji</a></li>
            <li><a href="{{ route('zaformowane') }}">Rejestr zaformowań</a></li>
            <li><a href="{{ route('badania-ndt') }}">Rejestr badań</a></li>
            <li><a href="{{ route('machining') }}">Rejestr wykonanych obróbek mechanicznych</a></li>
            <li><a href="{{ route('uwagi') }}" >Rejestr uwag do zatwierdzonych operacji</a></li>
            <li><a href="{{ route('czas-wykonania') }}" >Międzyczasy wykonania odlewów</a></li>
            <li><a href="{{ route('weight-per-client') }}">Tonaż odlewów do wykonania wg klientów</a></li>
            <li><a href="{{ route('weight-per-group') }}" >Tonaż odlewów do wykonania wg grup kalkulacyjnych</a></li>
            <li><a href="{{ route('wybraki') }}">Rejestr wybraków</a></li>
            <li><a href="{{ route('wagi-odlewow') }}">Rejestr operacji ważenia</a></li>
            <li><a href="{{ route('magazyn') }}"> Stan magazynowy</a></li>
            <li><a href="{{ route('inserted-datas') }}">Rejest wpisanych danych</a></li>
            <li><a href="{{ route('uzyski') }}"> Uzyski wg KO</a></li>
        </ul>  
    </div>
@endsection
