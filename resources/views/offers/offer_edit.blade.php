@extends('layouts.custom')

@section('title')
    <title>METsoft - Edytuj ofertę</title>
@endsection

@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/redmond/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: ["Ni.", "Pn.", "Wt.", "Śr.", "Cz.", "Pt.", "So."]
            });
        });
    </script>
    <form action="{{ route('offers.update', ['offer' => $offer->id]) }}" method="post" id="detail" class="fieldset">
        <input name="_method" type="hidden" value="patch">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset>
            <legend>Edytuj ofertę</legend>
            <ul>
                <li><label>Nr zapytania:</label> <input name="offer_no" type="text" size="35" value="{{ $offer->offer_no }}" required><br></li>
                <li><label>Klient:</label> <input name="client" type="text" size="35" value="{{ $offer->client }}" required><br></li>
                <li><label>Marketingowiec:</label>
                    <select name="user_mark_id">
                        @foreach($mark_members as $mark_member)
                            <option value={{ $mark_member->id }} @if($offer->user_mark_id == $mark_member->id) selected @endif >{{ $mark_member->first_name }}</option>
                        @endforeach
                    </select><br></li>
                <li><label>Technolog:</label>
                    <select name="user_tech_id">
                        @foreach($tech_members as $tech_member)
                            <option value={{ $tech_member->id }} @if($offer->user_tech_id == $tech_member->id) selected @endif >{{ $tech_member->first_name }}</option>
                        @endforeach
                    </select><br></li>
                @can('admin')
                <li><label>Data przekazania do WZT:</label><input name="date_tech_in" type="text" id="datepicker" value="{{ $offer->date_tech_in }}" size="35"><br /></li>
                @endcan
                <input type="submit" value="Zapisz">
            </ul>
        </fieldset>
    </form>
@endsection
