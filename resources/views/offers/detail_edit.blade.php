@extends('layouts.custom')

@section('title')
    <title>METsoft - Edytuj pozycję</title>
@endsection

@section('content')
    <form class="fieldset" action="{{ route('offers.details.update', ['id' => $offer_id, 'detail' => $detail->id]) }}" method="post" >
        <input name="_method" type="hidden" value="patch">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <fieldset>
            <legend>Edycja</legend>
            <ul>
                <li><label>Nazwa odlewu:</label>
                    <input name="cast_name" type="text" size="35" value="{{ $detail->cast_name }}"><br> </li>
                    <input name="offer_id" type="hidden" value="{{ $offer_id }}">
                <li><label>Nr rysunku:</label> <input name="drawing_no" type="text" size="35" value="{{ $detail->drawing_no }}" ><br> </li>
                <li><label>Materiał:</label>
                    <select name="mat_id">
                        @foreach($parameters['materials'] as $material)
                            <option value="{{ $material->id }}" @if($detail->mat_id==$material->id) selected @endif > 
                                {{ $material->material }}
                            </option>
                        @endforeach
                    </select><br> </li>
                <li><label>Ciężar rysunkowy [kg]:</label> <input name="draw_weight" type="number" value="{{ $detail->draw_weight }}"><br></li>
                <li><label>Ciężar surowego odlewu [kg]:</label><input name="cast_weight" type="number" value="{{ $detail->cast_weight }}"><br></li>
                <li><label>Ilość sztuk:</label><input name="pieces_amount" type="number" value="{{ $detail->pieces_amount }}"><br></li>
                <li><label>Uzysk [%]:</label> <input name="yeld" type="number" value="{{ $detail->yeld }}"><br></li>

                <li><label>Stopień trudności:</label> <select name="difficulty" >
                        <option value="1" @if($detail->difficulty == '1') selected @endif>1</option>
                        <option value="2" @if($detail->difficulty == '2') selected @endif>2</option>
                        <option value="3" @if($detail->difficulty == '3') selected @endif>3</option>
                    </select><br>
                </li>
                <li><label>Model:</label>
                    <select name="pattern">
                        @foreach($parameters['pattern_statuses'] as $pattern_status)
                            <option @if($pattern_status->status == $detail->pattern) selected @endif >{{ $pattern_status->status }}</option>
                        @endforeach
                    </select><br>
                </li>

                <li><label>Obróbka cieplna:</label>
                    <select name="heat_treat">
                        @foreach($parameters['heat_treatments'] as $heat_treatment)
                                <option @if($heat_treatment->term == $detail->heat_treat) selected @endif >{{ $heat_treatment->term }}</option>
                        @endforeach
                    </select><br>
                </li>

                <li><label>Obróka mechaniczna:</label>
                    <select name="machining_id">
                        @foreach($parameters['machinings'] as $machining)
                            <option value="{{ $machining->id }}" @if($detail->machining_id == $machining->id) selected @endif>{{ $machining->machining }}</option>
                        @endforeach
                    </select>
                    <br>
                </li>

                <li><label>Tolerancje, naddatki:</label> <input name="tolerances" type="text" value="{{$detail->tolerances}}" size="35"> <br></li>

                <li><label>Pochylenia odlewnicze: </label>
                    <select name="tapers">
                        @foreach($parameters['pattern_tapers'] as $pattern_taper)
                                <option @if($pattern_taper->taper == $detail->tapers) selected @endif >{{$pattern_taper->taper}}</option>
                        @endforeach
                    </select><br>
                </li>

                <li><label>Atest:</label>
                    <select name="atest">
                        @foreach($parameters['atest_types'] as $atest_type)
                                <option @if($atest_type->atest == $detail->atest) selected @endif >{{ $atest_type->atest }}</option>
                        @endforeach
                    </select><br>
                </li>

                <li><label>Odbiór odlewu na:</label> <input name="required" type="text" value="{{ $detail->required }}" size=70><br></li>
                <li><label>Klasa jakości:</label> <input name="quality_class" value="{{ $detail->quality_class }}" type="text" size=70><br></li>
                <li><label>Skrzynie [m]:</label> <input name="boxes" type="text" placeholder="1,0x2,0x3,0" value="{{ $detail->boxes }}"><br></li>
                <li><label>Inne:</label> <input name="others" type="text" value="{{ $detail->others }}"> <br></li>
                <li><label>Ilość chromitu [%] </label><input name="fr_chromite" type="text" value="{{ $detail->fr_chromite }}" size="35"><i> Domyślnie: staliwo 1%, żeliwo 0%</i></li>

                <button type="submit" name="action" value="save">Zapisz zmiany</button>
                <button type="submit" name="action" value="save_as_new">Zapisz jako nowy rekord</button>

            </ul>
        </fieldset>
    </form>
@endsection
