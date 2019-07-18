@extends('layouts.custom')

@section('title')
    <title>METsoft - Baza modeli</title>
@endsection

@section('content')

<div class="table_title">Wyszukane modele</div>
{{--
<div class="alert">Pokazuje wszyskie pozycje w których odlewów wysłanych jest mniej niż zamówionych</div>
--}}
    <table id="example" class="table table-striped table-bordered table-hover table-condensed" style="font-size:12px; width:100%">
        <thead>
            <tr>
                {{-- <th>Lp</th> --}}
                <th>Nazwa firmy</th>
                <th>Numer rysunku</th>
                <th>Nazwa odlewu</th>
                <th>Ostatnie zlecenie</th>
                <th>Il. zleceń</th>
                <th>Powierz- chnia</th>
                <th>Numer ułożenia</th>
                <th>Miejsce ułożenia</th>
                <th>Materiał</th>
                <th>Numer kartoteki</th>
                <th>Numer indeksu modelu</th>
                <th>Weryfikacja</th>
                <th>Uwagi</th>
                <th>Data weryfikacji</th>
                <th>Nazwisko</th>
                <th>Status</th>
                <th>Data zmiany statusu</th>
                <th>Czas nieużywania modelu</th>
                {{--
                <th>Data wywozu</th>
                <th>Model pobrano</th>
                <th>Model oddano</th>
                --}}
                <th>Operacje</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
            {{--    <th>Lp</th> --}}
                <th>Nazwa firmy</th>
                <th>Numer rysunku</th>
                <th>Nazwa odlewu</th>
                <th>Ostatnie zlecenie</th>
                <th>Il. zleceń</th>
                <th>Powierz- chnia</th>
                <th>Numer ułożenia</th>
                <th>Miejsce ułożenia</th>
                <th>Materiał</th>
                <th>Numer kartoteki</th>
                <th>Numer indeksu modelu</th>
                <th>Weryfikacja</th>
                <th>Uwagi</th>
                <th>Data weryfikacji</th>
                <th>Nazwisko</th>
                <th>Status</th>
                <th>Data zmiany statusu</th>
                <th>Czas nieużywania modelu</th>
                {{--
                <th>Data wywozu</th>
                <th>Model pobrano</th>
                <th>Model oddano</th>
                --}}
                <th>Operacje</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach( $patterns as $pattern)
                    <tr>
                       {{-- <td>{{ $loop->iteration }}</td> --}}
                        <td>{{ $pattern->customer }}</td>
                        <td>{{ $pattern->drawing_number }}</td>
                        <td>{{ $pattern->pattern_name }}</td>
                        <td>{{ $pattern->last_order }}</td>
                        <td>{{ $pattern->orders_amount }}</td>
                        <td>{{ number_format($pattern->area, 2) }}</td>
                        <td>{{ $pattern->layer_number }}</td>
                        <td>{{ $pattern->layer_place }}</td>
                        <td>{{ $pattern->material }}</td>
                        <td>{{ $pattern->cart_number }}</td>
                        <td>{{ $pattern->pattern_index }}</td>
                        <td>{{ $pattern->verification }}</td>
                        <td>{{ $pattern->remarks }}</td>
                        <td>{{ $pattern->verification_date }}</td>
                        <td>{{ $pattern->surname }}</td>
                        <td>
                            @foreach($statuses as $status)
                                @if($status->id == $pattern->status)
                                    {{ $status->operation }}
                                @endif 
                            @endforeach
                        </td>
                        <td>{{ $pattern->move_in }}</td>
                        <td>{{ $pattern->time }}</td>
                        {{--
                        <td>{{ $pattern -> move_out }}</td>
                        <td>{{ $pattern -> take_date }}</td>
                        <td>{{ $pattern -> return_date }}</td>
                        --}}
                        <td>
                            @can('modelarnia')
                                <a class="iframe" href="{{ route('patterns.edit'), ['pattern' => $pattern->id] }}">Edytuj</a><br>
                                <a class="iframe" href="{{ route('patterns.change_status', ['pattern' => $pattern->id]) }}">Status</a><br>
                            @endcan
                            <a class="iframe" href="{{ route('patterns.show', ['pattern' => $pattern->id]) }}">Karta</a>
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            //Opcje wyglądu nie związane z wyszukiwaniem po kolumnach
            $('#example').DataTable( {
                "lengthMenu": [ [50, 100, 200, -1], [50, 100, 200, "All"] ],
                "pageLength": 100
             } );

            //Kod do wyszukiwania po kolumnach

            // Setup - add a text input to each footer cell
            $('#example tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Szukaj '+title+'" />' );
            } );
         
            // DataTable
            var table = $('#example').DataTable();
         
            // Apply the search
            table.columns().every( function () {
                var that = this;
         
                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );

            $(".iframe").colorbox({iframe:true, width:"90%", height:"90%", });
        } );
    </script>
@endpush

