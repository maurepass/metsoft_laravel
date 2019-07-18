@extends('layouts.custom')

@section('title')
    <title>METsoft - Wpisane dane</title>
@endsection

@section('content')

<div class="table_title">Rejestr wpisanych danych podczas potwierdzania operacji</div>

<br>
    <table id="example" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>Lp</th>
                <th>ID odlewu</th>
                <th>Numer MET</th>
                <th>Klient</th>
                <th>Nazwa odlewu</th>
                <th>Numer rysunku</th>
                <th>Numer odlewu</th>
                <th>Numer wytopu</th>
                <th>Temp. zlewania</th>
                <th>Waga odlewu</th>
                <th>Korekta płaskości</th>
                <th>Uzysk</th>

            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Lp</th>
                <th>ID odlewu</th>
                <th>Numer MET</th>
                <th>Klient</th>
                <th>Nazwa odlewu</th>
                <th>Numer rysunku</th>
                <th>Numer odlewu</th>
                <th>Numer wytopu</th>
                <th>Temp. zlewania</th>
                <th>Waga odlewu</th>
                <th>Korekta płaskości</th>
                <th>Uzysk</th>
            </tr>
        </tfoot>      
        <tbody>
            @foreach( $casts as $cast)
                @if($cast->nr_odlewu <> '' or $cast->nr_wytopu <> '' or $cast->waga_odlewu <> '')
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $cast->casting_id }}</td>
                        <td>{{ $cast->numer_MET }}</td>
                        <td>{{ $cast->company }}</td>
                        <td>{{ $cast->cast_name }}</td>
                        <td>{{ $cast->picture_number }}</td>
                        <td>{{ $cast->nr_odlewu }}</td>
                        <td>{{ $cast->nr_wytopu }}</td>
                        <td>{{ $cast->temp_zalewania }}</td>
                        <td>{{ $cast->waga_odlewu }}</td>
                        @if ($cast->obr_mech == 2)
                            <td>TAK</td>
                        @else
                            <td></td>
                        @endif
                        <td>{{ number_format($cast->uzysk, 1, ',' ,' ')}}</td>
                    </tr>
                @endif
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
                $(this).html( '<input type="text" placeholder="Szukaj ' + title + '" />' );
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
        } );
    </script>
@endpush

