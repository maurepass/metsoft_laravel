@extends('layouts.custom')

@section('title')
    <title>METsoft - Edytuj model</title>
@endsection

@section('content')

<script type="text/javascript">
    $(function() {
        $( "#datepicker1" ).datepicker({
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
    <form action="{{ route('patterns.update', ['pattern' => $pattern->id]) }}" method="post" class="fieldset" style="margin-top: 50px" enctype="multipart/form-data" >
        <input name="_method" type="hidden" value="patch">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset>
            <legend>Edytuj model</legend>
            <ul>
                <li><label>Nazwa firmy</label> <input name="customer" type="text" size="80" value="{{ $pattern->customer }}"><br></li>
                <li><label>Numer rysunku</label> <input name="drawing_number" type="text" size="80" value="{{ $pattern->drawing_number }}"><br></li>
                <li><label>Nazwa odlewu</label> <input name="pattern_name" type="text" size="80" value="{{ $pattern->pattern_name }}"><br></li>
                <li><label>Ostatnie zlecenie</label> <input name="last_order" type="text" id="datepicker1" value="{{ $pattern->last_order }}"><br></li>
                <li><label>Il. zleceń</label> <input name="orders_amount" type="number" value="{{ $pattern->orders_amount }}"><br></li>
                <li><label>Powierzchnia</label> <input name="area" type="number" step="0.01" min="0" value="{{ $pattern->area }}"><br></li>
                <li><label>Numer ułożenia</label> <input name="layer_number" type="text" size="80" value="{{ $pattern->layer_number }}"><br></li>
                <li><label>Miejsce ułożenia</label> <input name="layer_place" type="text" size="80" value="{{ $pattern->layer_place }}"><br></li>
                <li><label>Materiał</label> <input name="material" type="text" size="80" value="{{ $pattern->material }}"><br></li>
                <li><label>Numer kartoteki</label> <input name="cart_number" type="text" size="80" value="{{ $pattern->cart_number }}"><br></li>
                <li><label>Numer indeksu modelu</label> <input name="pattern_index" type="text" size="80" value="{{ $pattern->pattern_index }}"><br></li>
                <li><label>Weryfikacja</label> <input name="verification" type="text" size="80" value="{{ $pattern->verification }}"><br></li>
                <li><label>Uwagi</label> <input name="remarks" type="text" size="80" value="{{ $pattern->remarks }}"><br></li>
                <li><label>Data weryfikacji</label> <input name="verification_date" type="text" size="80" value="{{ $pattern->verification_date }}"><br></li>
                <li><label>Nazwisko</label> <input name="surname" type="text" size="80" value="{{ $pattern->surname }}"><br></li>
                <li><label>Status</label>   
                    <select name="status_id">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" @if($status->id == $pattern->status_id) selected @endif >{{ $status->status }}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Data zmiany statusu</label> <input name="move_in" type="text" id="datepicker3" value="{{ $pattern->move_in }}"><br></li>
             
                {{-- <li><label>Załączniki</label><input name=uploadFile type="file"></li> --}}
             
                <button>Zapisz</button>
            </ul>
        </fieldset>
    </form>
@endsection
