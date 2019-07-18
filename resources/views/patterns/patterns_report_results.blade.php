<!DOCTYPE HTML>
<html>
<head>
    <title>METsoft - Raport</title>

    <meta content="text/html" charset="utf-8">

    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            /*width: 50%; */
            border: 1px solid #0c0c0c;
            table-layout: auto;
            margin: 0 auto;
            font-size: 12px;
        }

        th, td {
            text-align: left;
            padding: 2px;
            border: 1px solid #23527c ;
        }

        h1 {
            text-align: center;
            margin: 0;
            font-size: 20px;
        }

        .text-right {
            text-align: right
        }
    </style>
</head>

<body>
    <h1>Modele firm:
        @foreach($customers as $customer)
            "{{ $customer->customer }}"
        @endforeach
    </h1>
    <table width=640px>
        <tr>
            <th>Lp</th>
            <th>Klient</th>
            <th>Nazwa rysunku</th>
            <th>Nazwa modelu</th>
            <th>Ilość m2</th>
            <th>Ostatnie zlecenie (rok)</th>
            <th>Okres nieużywania modelu (m-ce)</th>
        </tr>
        @php 
            $total_area=0;
        @endphp
        @foreach( $patterns as $pattern)
            @if($pattern->status != 'Zabrany przez klienta' && $pattern->status != 'Zezłomowany' && $pattern->status != 'Brak modelu' && $pattern->status != 'Wypożyczony przez klienta') 

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pattern->customer }}</td>
                    <td>{{ $pattern->drawing_number }}</td>
                    <td>{{ $pattern->pattern_name }}</td>
                    <td class="text-right">{{ number_format($pattern->area, 2, ',', ' ') }}</td>
                    @php
                        $total_area += $pattern->area;
                    @endphp
                    <td>{{ $pattern->last_order }}</td>
                    <td class="text-right">{{ $pattern->time }}</td>
                </tr>
            @endif
        @endforeach      
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Razem</td>
                <td class="text-right" >{{ number_format($total_area, 2, ',', ' ') }}</td>
                <td></td>
                <td></td>
            </tr>           
    </table>
</body>
</html>
