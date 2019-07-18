@extends('layouts.custom')

@section('title')
    <title>METsoft - Tonaż/Gr. kalk.</title>
@endsection

@section('content')
    <div class="table_title">Waga odlewów w produkcji wg grup kalkulacyjnych</div>
    <div class="alert">Obejmuje wszystkie odlewy które mają status: Nowy, W planowaniu, Zalany</div>
    <div class="alert">Zawyżony ponieważ dużo odlewów już wysłanych nie posiada potwierdzonej operacji odbioru lub wysyłki</div>

    <div>
        <table class="table table-bordered table-striped table-hover" style="width:20%; margin:auto">
            <tr>
                <th>Grupa kalkulacyjna</th>
                <th>Łączna waga [kg]</th>
            </tr>
            @foreach( $casts as $cast)
            <tr>
                <td style="text-align: right">{{ $cast->mat_calc_group }}</td>
                <td style="text-align: right">{{ number_format($cast->tonaz, 0, ',', ' ') }}</td>
            </tr>
            @endforeach

        </table>
    </div>
@endsection