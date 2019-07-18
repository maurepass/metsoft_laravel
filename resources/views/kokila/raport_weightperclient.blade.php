@extends('layouts.custom')

@section('title')
    <title>METsoft - Tonaż/Klient</title>
@endsection

@section('content')

    <div class="table_title">Waga odlewów w produkcji wg klientów</div>
    <div class="alert">Zawyżony ponieważ dużo odlewów już wysłanych nie posiada potwierdzonej operacji wysyłki</div>
    <div>
        <table class="table table-bordered table-striped table-hover" style="width:60%; margin:auto">
            <tr>
                <th>Lp</th>
                <th>Klient</th>
                <th>Nowe [kg]</th>
                <th>Zaplanowane [kg]</th>
                <th>Zalane [kg]</th>
                <th>Odebrane [kg]</th>
                <th>Łączna waga [kg]</th>
            </tr>
            @php $total_weight=0; $nowe=0; $w_planowaniu=0; $zalane=0; $odebrane=0; @endphp
            @foreach( $casts as $cast)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cast->customer }}</td>
                    <td style="text-align: right">{{ number_format($cast->nowe, 0, ',',' ') }}</td>
                    <td style="text-align: right">{{ number_format($cast->w_planowaniu, 0, ',',' ') }}</td>
                    <td style="text-align: right">{{ number_format($cast->zalane, 0, ',',' ') }}</td>
                    <td style="text-align: right">{{ number_format($cast->odebrane, 0, ',',' ') }}</td>
                    <td style="text-align: right">{{ number_format($cast->tonaz, 0, ',',' ') }}</td>
                </tr>
                @php 
                    $nowe += $cast->nowe;
                    $w_planowaniu += $cast->w_planowaniu;
                    $zalane += $cast->zalane;
                    $odebrane += $cast->odebrane;
                    $total_weight += $cast->tonaz;
                @endphp
            @endforeach
            <tr>
                <td></td>
                <td>Razem:</td>
                <td style="text-align: right">{{ number_format($nowe, 0, ',',' ') }}</td>
                <td style="text-align: right">{{ number_format($w_planowaniu, 0, ',',' ') }}</td>
                <td style="text-align: right">{{ number_format($zalane, 0, ',',' ') }}</td>
                <td style="text-align: right">{{ number_format($odebrane, 0, ',',' ') }}</td>
                <td style="text-align: right">{{ number_format($total_weight, 0, ',',' ') }}</td>
            </tr>
        </table>
    </div>
@endsection