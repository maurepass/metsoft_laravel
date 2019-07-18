@extends('layouts.custom')

@section('title')
    <title>METsoft - Dodaj pozycję</title>
@endsection

@section('content')
    <form class="fieldset" action="{{ route('offers.details.create', ['id' => $offer_id]) }}" method="post" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset>
            <legend>Dodaj nowy odlew</legend>
            <ul>
                <li><label>Nazwa odlewu:</label><input name="cast_name" type="text" size="35"><br> </li>
                <input name="offer_id" type="hidden" value="{{ $offer_id }}">
                <li><label>Nr rysunku:</label> <input name="drawing_no" type="text" size="35"><br> </li>

                <li><label>Materiał:</label>
                    <select name="mat_id">
                        @foreach($parameters['materials'] as $material)
                            <option value="{{ $material->id }}">{{ $material->material }}</option>
                        @endforeach
                    </select><br>
                </li>

                <li><label>Ciężar rysunkowy [kg]:</label> <input name="draw_weight" type="number"><br></li>
                <li><label>Ciężar surowego odlewu [kg]:</label><input name="cast_weight" type="number"><br></li>
                <li><label>Ilość sztuk:</label><input name="pieces_amount" value="1" type="number"><br></li>
                <li><label>Uzysk [%]:</label> <input name="yeld" @if($mat_type == 'steel') value="50" @else value="75" @endif type="number"><br></li>
          
                <li><label>Stopień trudności:</label>
                    <select name="difficulty" >
                        <option value="1">1</option>
                        <option value="2" selected>2</option>
                        <option value="3">3</option>
                    </select><br>
                </li>    

                <li><label>Model:</label>
                    <select name="pattern">
                        @foreach($parameters['pattern_statuses'] as $pattern_status)
                            <option value="{{ $pattern_status->status }}" >{{ $pattern_status->status }}</option>
                        @endforeach
                    </select><br>
                </li>

                <li><label>Obróbka cieplna:</label>
                    <select name="heat_treat">
                        @foreach($parameters['heat_treatments'] as $heat_treatment)
                                @if($mat_type == "steel")
                                    <option value="{{ $heat_treatment->term }}" @if($heat_treatment->term == "normalizacja") selected @endif >{{$heat_treatment->term }}</option>
                                @else
                                    <option value="{{ $heat_treatment->term }}" @if( $heat_treatment->term == "brak") selected @endif>{{ $heat_treatment->term }}</option>
                                @endif
                        @endforeach
                    </select><br>
                </li>

                <li><label>Obróbka mechaniczna:</label>
                    <select name="machining_id">
                        @foreach($parameters['machinings'] as $machining)
                            <option value="{{ $machining->id }}" @if($machining->id == 4) selected @endif>{{ $machining->machining }}</option>
                        @endforeach
                    </select><br>
                </li>

                <li><label>Tolerancje, naddatki:</label> <input name="tolerances" type="text" value="ISO 8062-DCTG13 RMAG H" size="35"> <br></li>

                <li><label>Pochylenia odlewnicze: </label>
                    <select name="tapers">
                        @foreach($parameters['pattern_tapers'] as $pattern_taper)
                            <option>{{ $pattern_taper->taper }}</option>
                        @endforeach
                    </select><br>
                </li>

                <li><label>Atest:</label>
                    <select name="atest">
                        @foreach($parameters['atest_types'] as $atest)
                            <option value="{{ $atest->atest }}" @if($atest->atest == "3.1 wg PN-EN 10204") selected @endif>{{ $atest->atest }}</option>
                        @endforeach
                    </select><br>
                </li>

                <li><label>Odbiór odlewu na:</label> <input name="required" type="text" value="wł. wytrz., skł. chem." size=70><br></li>
                <li><label>Klasa jakości:</label> <input name="quality_class" value="VT – poziom 4 wg ISO 11971:2008" type="text" size=70><br></li>
                <li><label>Skrzynie [m]:</label> <input name="boxes" type="text" placeholder="1,0x2,0x3,0"><br></li>
                <li><label>Inne:</label> <input name="others" type="text"> <br></li>
                <li><label>Ilość chromitu [%] </label><input name="fr_chromite" type="text" @if($mat_type == 'steel') value="1" @else value="0" @endif size="35"></li>
                              
                <input type="submit" value="Dodaj do bazy">
            </ul>
        </fieldset>
    </form>
@endsection
