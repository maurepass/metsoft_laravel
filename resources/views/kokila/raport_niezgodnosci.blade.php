@extends('layouts.custom')

@section('title')
    <title>METsoft - Niezgodności</title>
@endsection

@section('content')
    <div class="table_title">Rejestr niezgodnych operacji</div>

    <div>
        <table id="example" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID odlewu</th>
                    <th>Numer MET</th>
                    <th>Klient</th>
                    <th>Nazwa odlewu</th>
                    <th>Numer rysunku</th>
                    <th>Materiał</th>
                    <th>Operacja</th>
                    <th>Wprowadzający</th>
                    <th>Opis niezgodności</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID odlewu</th>
                    <th>Numer MET</th>
                    <th>Klient</th>
                    <th>Nazwa odlewu</th>
                    <th>Numer rysunku</th>
                    <th>Materiał</th>
                    <th>Operacja</th>
                    <th>Wprowadzający</th>
                    <th>Opis niezgodności</th>
                    <th>Data</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                lengthMenu: [ [50, 100, 200, 500], [50, 100, 200, 500] ],
                pageLength: 50,
                serverSide: true,
                autoWidth: false,
                order: [[9, 'desc']],
                ajax: "{{ route('niezgodnosci-data') }}",              
                columns: [
                    {data: 'id_cast' },
                    {data: 'cast.porder.numer_MET' },
                    {data: 'cast.porder.customer.company' },
                    {data: 'cast.cast_name' },
                    {data: 'cast.picture_number' },
                    {data: 'cast.material.materialname' },
                    {data: 'operation_dict.operationname'},
                    {data: 'confirmed_by1'},
                    {data: 'notes' },
                    {data: 'completion_date1' },
                ]
            });

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