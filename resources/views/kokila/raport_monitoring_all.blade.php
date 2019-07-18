
@extends('layouts.custom')

@section('title')
    <title>METsoft - Monitoring (wszystkie zlecenia)</title>
@endsection

@section('content')

<div class="table_title">Monitoring zleceń (wszystkie zlecenia)</div>
<div class="alert">Pokazuje wszyskie zlecenia wprowadzone do kokili</div>

    <table id="example" class="table table-bordered table-striped table-hover" >
        <thead>
            <tr>
                <th>Lp</th>
                <th>Numer MET</th>
                <th>Klient</th>
                <th>Nazwa odlewu</th>
                <th>Numer rysunku</th>
                <th>Materiał</th>
                <th>Waga</th>
                <th>Technolog</th>
                <th>Ilość zamówiona</th>
                <th>Nowe</th>
                <th>W planowaniu</th>
                <th>Zalane</th>
                <th>Odebrane</th>
                <th>Wysłane</th>
                <th>WB</th>
                <th>Anulowane</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Lp</th>
                <th>Numer MET</th>
                <th>Klient</th>
                <th>Nazwa odlewu</th>
                <th>Numer rysunku</th>
                <th>Materiał</th>
                <th>Waga</th>
                <th>Technolog</th>
                <th>Ilość zamówiona</th>
                <th>Nowe</th>
                <th>W planowaniu</th>
                <th>Zalane</th>
                <th>Odebrane</th>
                <th>Wysłane</th>
                <th>WB</th>
                <th>Anulowane</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach( $casts as $cast)
                @if($cast->cast_pcs <= ($cast->wyslane+$cast->anulowane))
                    <tr style="font-style:italic">
                @else
                    <tr>
                @endif
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cast->numer_MET }}</td>
                    <td>{{ $cast->company }}</td>
                    <td>{{ $cast->nazwa }}</td>
                    <td>{{ $cast->picture_number }}</td>
                    <td>{{ $cast->materialname }}</td>
                    <td>{{ $cast->cast_weight }}</td>
                    <td>{{ $cast->username }}</td>
                    <td>{{ $cast->cast_pcs }}</td>
                    <td>{{ $cast->nowy }}</td>
                    <td>{{ $cast->w_planowaniu }}</td>
                    <td>{{ $cast->zalane }}</td>                    
                    <td>{{ $cast->odebrane }}</td>
                    <td>{{ $cast->wyslane }}</td>
                    <td>{{ $cast->wb }}</td>
                    <td>{{ $cast->anulowane }}</td>
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
        } );
    </script>
@endpush