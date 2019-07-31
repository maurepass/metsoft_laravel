@extends('layouts.custom')

@section('title')
    <title>METsoft - Oferta</title>
@endsection

@section('content')
    <div>
        <div id="offers_info">
                <a>Oferta nr: {{ $offer->offer_no }}</a>
                <a>Klient: {{ $offer->client }} </a>
                <a>Marketing: {{ $offer->user_mark->first_name }} </a>
                <a>Technologia: {{ $offer->user_tech->first_name }}</a>
        </div>
        <br>
        @if($offer->status_id == 1)
            <form action="{{ route('offers.details.create', ['id' => $offer->id]) }}" method="get">
                <button type="submit" name="add_detail" value="steel">---[ Dodaj detal z STALIWA ] ---</button>
                <button type="submit" name="add_detail" value="iron">---[ Dodaj detal z ŻELIWA ] ---</button>
            </form>
        @endif

        <table id="example" class="table table-bordered table-condensed table-striped table-hover">    
            <tr>
                <th>Lp.</th>
                <th>Nazwa</th>
                <th>Nr rysunku</th>
                <th>Materiał</th>
                <th>Ciężar [kg]</th>
                <th>Il. szt.</th>
                <th>Uzysk[%]</th>
                <th>St. tr.</th>
                <th>Model</th>
                <th>Obr cieplna</th>
                <th>Obr. mech.</th>
                <th>Tolerancje</th>
                <th>Pochylenia</th>
                <th>Atest</th>
                <th>Odb. odlewu</th>
                <th>Klasa jakości</th>
                <th>Skrzynie [m]</th>
                <th>Inne</th>
                <th>Chromit</th>                
                <th>Edytuj</th>
                <th>Usuń</th>
            </tr>
            @foreach($details as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->cast_name }}</td>
                    <td>{{ $detail->drawing_no }}</td>
                    <td>{{ $detail->material->material }}</td>
                    <td>{{ $detail->cast_weight }}</td>
                    <td>{{ $detail->pieces_amount }}</td>
                    <td>{{ $detail->yeld }}</td>
                    <td>{{ $detail->difficulty }}</td>
                    <td>{{ $detail->pattern }}</td>
                    <td>{{ $detail->heat_treat }}</td>
                    <td>{{ $detail->machining->machining }}</td>
                    <td>{{ $detail->tolerances }}</td>
                    <td>{{ $detail->tapers }}</td>
                    <td>{{ $detail->atest }}</td>
                    <td>{{ $detail->required }}</td>
                    <td>{{ $detail->quality_class }}</td>
                    <td>{{ $detail->boxes }}</td>
                    <td>{{ $detail->others }}</td>
                    <td>{{ $detail->fr_chromite }}</td>
                    <td>
                        <a href="{{ route('offers.details.edit', ['id' => $offer->id, 'detail' => $detail->id]) }}">Edytuj</a>
                    </td>
                    <td>
                        <form action="{{ route('offers.details.destroy', ['id' => $offer->id, 'detail' => $detail->id]) }}" method="post">
                            <input name="_method" type="hidden" value="delete">
                            <input name="_token" type="hidden"  value="{{ csrf_token() }}">
                            <input type="submit" value="Usuń" onclick=" return confirm('Czy na pewno usunąć?')">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <br>
        <div id="details_center">
            <form action="{{ route('offers.update', ['offer' => $offer->id]) }}" method="post" >
                <input name="_method" type="hidden" value="patch">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input name="notices" type="hidden" value="{{ $notices }}"/>
                <button >Wstaw domyślne uwagi</button>
            </form>

            <form action="{{ route('offers.update', ['offer' => $offer->id]) }}" method="post" >
                <input name="_method" type="hidden" value="patch">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <textarea  cols="100" rows="20" name="notices">{!! $offer->notices !!}</textarea>
                <button onclick="alert('Zapisano uwagi.')">Zapisz uwagi</button>
            </form>
            <hr/>

            <form action="{{ route('offers.update', ['offer' => $offer->id]) }}" method="post" id="detail">
                <input name="_method" type="hidden" value="patch">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <i>Status:</i>
                <select name="status_id">
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" @if($offer->status_id == $status->id) selected @endif>{{ $status->offer_status }}</option>
                    @endforeach
                </select>
                <input name="date_tech_out" type="hidden" value="{{ date('Y-m-d') }}">
                <button>Zatwierdź</button>
            </form>
       </div>
    </div>

@endsection

