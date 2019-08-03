<!doctype html>
<html>
<head>
    <title>METsoft - Oferty</title>
    <meta content="text/html" charset="utf-8">
    <link rel="stylesheet" href="/css/style_print.css" type="text/css">

    <style>
        table {
            margin-left: auto;
            margin-right: auto;
        }

        table, th, td {
            border: 1px solid black
        }
    </style>
</head>
<body>
    <label>FORMULARZ NR 2.1-1.00.03</label>
    <table>
        <tr>
            <td rowspan="2" width=130px><img src="/images/MET_logo.png" alt="METALODLEW SA"></td>
            <td colspan="2" style="text-align: center; font-size: 16px">ZAŁOŻENIA TECHNOLOGICZNE DO OFERTY</td>
        </tr>
        <tr>
            <td width=150px>Nr: <b style="font-size: 18px">{{ $offer -> offer_no }}</b></td>
            <td>Klient: <b style="font-size: 18px">{{ $offer -> client }}</b></td>
        </tr>
    </table>

    <table>
        @foreach($details as $detail)
            <tr>
                <td> {{ $loop->iteration }} </td>
                <td>
                    <i>odlew: </i><b>{{ $detail->cast_name }}</b>;
                    <i>nr rys.: </i><b>{{ $detail->drawing_no }}</b>;
                    <i>materiał: </i><b>{{ $detail->material->material }}</b><br>
                    <i>ciężar[kg]: </i><b>{{ $detail->cast_weight }}</b>;
                    <i>il. szt.: </i><b>{{ $detail->pieces_amount }}</b>;
                    <i>uzysk[%]: </i><b>{{ $detail->yeld }}</b>;
                    <i>st. tr.: </i><b>{{ $detail->difficulty }}</b>;
                    <i>model: </i><b>{{ $detail->pattern }}</b>;<br>
                    <i>obr. cieplna: </i><b>{{ $detail->heat_treat }}</b>;
                    <i> odb. na: </i><b>{{ $detail->required }}</b>;
                    <i>skrzynie form.[m]: </i><b>{{ $detail->boxes }}</b>;
                    @if($detail->quality_class != '')
                        <i><br> klasa jakości: </i><b>{{ $detail->quality_class }}</b>;
                    @endif
                    @if($detail->others !='')
                        <i>inne: </i><b>{{ $detail->others }}</b>;
                    @endif
                    <i>Chromit: </i><b>{{ $detail->fr_chromite }} %</b>;
                    <br>
                </td>
            </tr>
        @endforeach
    </table>

    <table>
        <tr>
            <td>
                <i>Obr. mech.: </i>  {!! $machining_show !!}
                <i><br>Pochylenia: </i> {!! $tapers_show !!}
                <i><br> Tolerancje: </i> {!! $tolerances_show !!}
                <i><br>Atest: </i> {!! $atest_show !!}
            </td>
        </tr>
        <tr>
            <td>
                {{-- 
                    nl2br - Inserts HTML line breaks before all newlines in a string
                    e - don't interpret HTML tags, only show them
                --}}

                Uwagi:<br> {!!nl2br(e($offer->notices))!!}
            </td>
        </tr>
    </table>

    <table>
        <tr height=30px>
            <td>Opracował:
                @if($offer->date_tech_out)
                    {{ $offer -> date_tech_out }}
                @else
                    {{ date('Y-m-d') }}
                @endif
                    {{ $offer->user_tech->first_name }}
            </td>
            <td>Sprawdził:
                @if($offer->date_tech_out)
                    {{ $offer -> date_tech_out }}
                @else
                    {{ date('Y-m-d') }}
                @endif
            </td>
        </tr>
    </table>
    <div id="1"><i> Wydrukowano: {{ date('Y-m-d') }}</i></div>
</body>
</html>

