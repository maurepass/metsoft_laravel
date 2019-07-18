@extends('layouts.custom')

@section('title')
    <title>METsoft - Dodaj ofertę</title>
@endsection

@section('content')
    <script>
        $(function() {
            $( "#datepicker" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Ni.", "Pn.", "Wt.", "Śr.", "Cz.", "Pt.", "So." ]
            });
        });
    </script>
    <div>
        <form action="{{ route('offers.store') }}" method="post" class="fieldset"> <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <fieldset>
                <legend>Dodaj nową ofertę</legend>
                <ul>
                    <li><label>Nr zapytania:</label> <input name="offer_no" type="text" placeholder="0000/00" value="{{ $table_with_offer_no[0] }}/{{ $table_with_offer_no[1] }}" size="35" required><br></li>
                    <li><label>Klient:</label> <input name="client" type="text" size="35" required><br></li>
                    <li><label>Marketingowiec:</label>
                        <select name="user_mark_id" >
                            @foreach($mark_members as $mark_member)
                                <option value="{{ $mark_member->id }}" @if($mark_member->id == 19) selected @endif >{{ $mark_member->first_name }} </option>
                            @endforeach
                        </select><br></li>
                    <li><label>Technolog:</label>
                        <select name="user_tech_id">
                            @foreach($tech_members as $tech_member)
                                <option value="{{ $tech_member->id }}" @if($tech_member->id == 4) selected @endif >{{ $tech_member->first_name }} </option>
                            @endforeach
                        </select><br></li>
                    <li><label>Data przekazania do WZT:</label><input name="date_tech_in" type="text" id="datepicker" value="{{ date("Y-m-d") }}" size="35"></li>
                    <button>Dodaj nową ofertę</button>
                </ul>
            </fieldset>
        </form>
    </div>
@endsection
