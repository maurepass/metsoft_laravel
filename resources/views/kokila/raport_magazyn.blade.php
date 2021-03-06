@extends('layouts.custom')

@section('title')
    <title>METsoft - Magazyn</title>
@endsection

@section('content')

    <div class="table_title">Odlewy na magazynie</div>
    <div class="alert">Obejmuje wszystkie odlewy które mają status: Odebrane</div>

    <table id="example" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>Lp</th>
                <th>ID odlewu</th>
                <th>Numer MET</th>
                <th>Klient</th>
                <th>Nazwa odlewu</th>
                <th>Numer rysunku</th>
                <th>Materiał</th>
                <th>Waga odlewu</th>

                <th>KO utworzono</th>
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
                <th>Materiał</th>
                <th>Waga odlewu</th>
                <th>KO utworzono</th>
            </tr> 
        </tfoot>
        <tbody>
            @foreach( $casts as $cast)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $cast->id }}</td>
                <td>{{ $cast->porder->numer_MET }}</td>
                <td>{{ $cast->porder->customer->company }}</td>
                <td>{{ $cast->cast_name }}</td>
                <td>{{ $cast->picture_number }}</td>
                <td>{{ $cast->material->materialname }}</td>
                <td>{{ $cast->cast_weight }}</td>
                <td>{{ $cast->updated_at }}</td>
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
