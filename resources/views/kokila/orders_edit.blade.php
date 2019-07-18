@extends('layouts.custom')

@section('title')
    <title>METsoft - Rejestr zamówień</title>
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
     
    <form action="{{ route('orders.update', ['order' => $order->id]) }}" method="post" class="fieldset">
        <input name="_method" type="hidden" value="patch">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <fieldset>
            <legend>Edycja</legend>
            <ul>
                <li><label>Nr zlecenia</label><input name="numer_MET" type="text" size="40" value="{{$order->numer_MET}}" disabled><br></li>
                <li><label>Klient</label><input name="company" type="text" size="40" value="{{$order->company}}" disabled><br></li>
                <li><label>Nazwa odlewu</label><input name="cast_name" type="text" size="40" value="{{$order->cast_name}}" disabled><br></li>
                <li><label>Nr rysunku</label><input name="pict_number" type="text" size="40" value="{{$order->pict_number}}" disabled><br></li>
                <li><label>Il. sztuk</label><input name="cast_pcs" type="text" size="40" value="{{$order->cast_pcs}}" disabled><br></li>
                <li><label>Materiał</label><input name="cust_material" type="text" size="40" value="{{$order->cust_material}}" disabled><br></li>
                <li><label>Model</label><input name="model" type="text" size="40" value="@if($order->model == 1)TAK @endif" disabled><br></li>
                <li><label>Odlew</label><input name="rawcast" type="text" size="40" value="@if($order->rawcast == 1)TAK @endif" disabled><br></li>
                <li><label>Malowanie</label><input name="painting" type="text" size="40" value="@if($order->painting ==1)TAK @endif" disabled><br></li>
                <li><label>Obr. zgrubna</label><input name="mechrough" type="text" size="40" value="@if($order->mechrough ==1)TAK @endif" disabled><br></li>
                <li><label>Obr. na gotowo</label><input name="mechfine" type="text" size="40" value="@if($order->mechfine ==1)TAK @endif" disabled><br></li>
                <li><label>Marketing</label><input name="marketing" type="text" size="40" value="{{$order->marketing}}" disabled><br></li>
                <li><label>Data otrzymania</label><input name="ord_in" type="text" size="40" value="{{$order->ord_in}}" disabled><br></li>
                <input name="ord_in" type="hidden" value="{{ $order->ord_in }}">
                <li><label>Technolog</label>
                    <select name="tech_memb_id">
                        <option value=""></option>
                        @foreach($technolodzy as $technolog)
                            <option value="{{ $technolog->id }}" @if($order->tech_memb_id == $technolog->id) selected @endif size="40">{{ $technolog->first_name }}</option>
                        @endforeach
                    </select>
                </li>
                <li><label>Uwagi</label><input name="uwagi" type="text" size="40" value="{{ $order->uwagi }}"><br></li>

                @can('admin')
                    <li><label>Data zakończenia</label><input name="ord_out" type="date" size="40" value="{{ $order->ord_out }}"><br></li>
                @endcan

                <li><label>Status</label>
                    <select name="status_id">
                            @foreach($statuses as $status)
                                    <option value="{{ $status->id }}"  @if($status->id == $order->status_id ) selected @endif size="40">{{ $status->status }}</option>
                            @endforeach
                    </select><br>
                </li>
                <li><button type="submit" >Zapisz</button></li>
            </ul>
        </fieldset>
    </form>
@endsection

