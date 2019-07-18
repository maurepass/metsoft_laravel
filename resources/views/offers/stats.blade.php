@extends('layouts.custom')

@section('title')
    <title>METsoft - Statystyki</title>
@endsection

@section('content')
    <script>
        $(function () {
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: ["Ni.", "Pn.", "Wt.", "Śr.", "Cz.", "Pt.", "So."]
            });
        });

        $(function () {
            $("#datepicker2").datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: ["Ni.", "Pn.", "Wt.", "Śr.", "Cz.", "Pt.", "So."]
            });
        });
    </script>

    <form action="stats" method="GET" class="fieldset" > <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset >
            <legend>Wybierz okres</legend>
                <ul>
                    <li>
                        <label>Okres statystyk <i>od</i><input type="date" name="date_stats_from" size="20" id="datepicker" value="{{$date_stats_from}}">
                        <i>do</i><input type="date" name="date_stats_to" size="20" id="datepicker2"  value="{{$date_stats_to}}"><br>
                    </li><br>
                    <input type="submit" value="Policz">
                </ul>
        </fieldset>
    </form>
    <table class="table table-bordered table-stirped table-hover" style="width:40%; margin:auto">
        <tr>
            <th>Technolog</th>
            <th>Il. ofert</th>
            <th>Śr. dni / oferta</th>
            <th>W terminie</th>
            <th>Ilość odlewów</th>
        </tr>
        @php 
            $of_amt = 0;
            $in_time_amt = 0;
            $det_amt = 0;
        @endphp
        @foreach($tech_stats as $tech_stat )
            <tr>
                <td>{{ $tech_stat['tech'] }}</td>
                <td>{{ $tech_stat['amount'] }}</td>
                @php $of_amt += $tech_stat['amount'] @endphp
                <td>{{ $tech_stat['avg_days'] }}</td>
                <td>
                    {{ $tech_stat['in_time'] }}
                    @if ($tech_stat['amount'] <> 0)
                        ({{ round($tech_stat['in_time'] * 100 / $tech_stat['amount']), 1 }} %)
                    @endif
                </td>
                @php $in_time_amt += $tech_stat['in_time'] @endphp
                <td>{{ $tech_stat['det_amt'] }}</td>
                @php $det_amt += $tech_stat['det_amt'] @endphp
            </tr>
        @endforeach
        <tr>
            <td>RAZEM:</td>
            <td>{{ $of_amt }}</td>
            <td>----</td>
            <td>
                {{ $in_time_amt }}
                @if ($of_amt <> 0)
                    ({{ round($in_time_amt * 100 / $of_amt, 1) }} %)
                @endif
            </td>
            <td>{{ $det_amt }}</td>
        </tr>
    </table>
    <br>

    <table class="table table-bordered table-striped table-hover" style="width:40%; margin:auto">
        <tr>
            <th>Gr. kalk.</th>
            <th>Il. detali</th>
        </tr>
        @php $det_sum = 0 @endphp
        @foreach($detail_stats as $detail_item)
            <tr>
                <td>{{ $detail_item['mat_group'] }}</td>
                <td>{{ $detail_item['amount'] }}</td>
                @php $det_sum += $detail_item['amount'] @endphp
            </tr>
        @endforeach
        <tr>
            <td>RAZEM:</td>
            <td>{{ $det_sum }}</td>
        </tr>
    </table>
    <br>

    <table class="table table-bordered table-striped table-hover" style="width:40%; margin:auto">
        <tr>
            <th>Status</th>
            <th>Il. ofert</th>
        </tr>

        @php $of_sum = 0 @endphp
        @foreach($statuses_stats as $item)
            <tr>
                <td>{{ $item['status'] }}</td>
                <td>{{ $item['amount'] }}</td>
                @php $of_sum += $item['amount'] @endphp
            </tr>
        @endforeach
        <tr>
            <td>RAZEM:</td>
            <td>{{ $of_sum }}</td>
        </td>
    </table>
@endsection

