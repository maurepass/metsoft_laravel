@extends('layouts.custom')

@section('title')
    <title>METsoft - Nowy model</title>
@endsection

@section('content')
    <script>
        
        $(function() {
            $( "#datepicker1" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Ni.", "Pn.", "Wt.", "Śr.", "Cz.", "Pt.", "So." ]
            });
        });

        $(function() {
            $( "#datepicker2" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Ni.", "Pn.", "Wt.", "Śr.", "Cz.", "Pt.", "So." ]
            });
        });
        $(function() {
            $( "#datepicker3" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Ni.", "Pn.", "Wt.", "Śr.", "Cz.", "Pt.", "So." ]
            });
        });
        
    </script>

    <form action="{{ route('patterns.store') }}" method="post" class="fieldset">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset >
            <legend>Dodaj nowy model</legend>
            <ul>
                <li><label>Nazwa firmy</label> <input name="customer" type="text" size="50"><br></li>
                <li><label>Numer rysunku</label> <input name="drawing_number" type="text" size="50"><br></li>
                <li><label>Nazwa odlewu</label> <input name="pattern_name" type="text" size="50"><br></li>
                <li><label>Ostatnie zlecenie</label> <input name="last_order" type="text" id="datepicker2" value="{{ date('Y-m-d') }}"><br></li>
                <li><label>Il. zleceń</label> <input name="orders_amount" type="number" step="1" value="1" min="0"><br></li> 
                <li><label>Powierzchnia</label> <input name="area" type="number" step="any" min="0"><br></li>
                <li><label>Numer ułożenia</label> <input name="layer_number" type="text" size="50"><br></li>
                <li><label>Miejsce ułożenia</label> <input name="layer_place" type="text" size="50"><br></li>
                <li><label>Materiał</label>         
                    <select name="material">
                        <option selected></option>
                        <option value="staliwo">staliwo</option>
                        <option value="żeliwo">żeliwo</option>
                        <option value="kolorki">kolorki</option>
                    </select>
                </li>
                <li><label>Numer kartoteki</label> <input name="cart_number" type="text" size="50"><br></li>
                <li><label>Numer indeksu modelu</label> <input name="pattern_index" type="text" size="50"><br></li>
                <li><label>Weryfikacja</label> <input name="verification" type="text" size="50"><br></li>
                <li><label>Uwagi</label> <input name="remarks" type="text" size="50"><br></li>
                <li><label>Data weryfikacji</label> <input name="verification_date" type="text" id="datepicker3" value="{{ date('Y-m-d') }}"> <br></li>
                <li><label>Nazwisko</label> <input name="surname" type="text" size="50"><br></li>
                <li><label>Status</label>
                    <select name="status_id" >
                        @foreach($statuses as $status)
                            @if($status->id != 8)
                                <option value="{{ $status->id }}" @if($status->id == 1) selected @endif>{{ $status->status }}</option>
                            @endif
                        @endforeach
                    </select><br>
                </li>
                <li><label>Data</label> <input name="move_in" type="text" id="datepicker1" value="{{ date('Y-m-d') }}"><br></li>
                <button>Zapisz</button>
            </ul>
        </fieldset>
    </form>
@endsection
