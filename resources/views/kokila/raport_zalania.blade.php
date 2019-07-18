@extends('layouts.custom')

@section('title')
    <title>METsoft - Zalane odlewy</title>
@endsection

@section('content')
    <div class="table_title">Rejestr zalań</div>
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
                    <th>Gr. kal</th>                    
                    <th>Waga odlewu</th>
                    <th>Nr wytopu</th>
                    <th>Temp. zal.</th>
                    <th>Data zalania</th>
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
                    <th>Gr. kal</th>                    
                    <th>Waga odlewu</th>
                    <th>Nr wytopu</th>
                    <th>Temp. zal.</th>
                    <th>Data zalania</th>
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
                order: [[10, 'desc']],
                ajax: "{{ route('zalania-data') }}",              
                 columns: [
                    {data: 'id_cast' },
                    {data: 'cast.porder.numer_MET' },
                    {data: 'cast.porder.customer.company' },
                    {data: 'cast.cast_name' },
                    {data: 'cast.picture_number' },
                    {data: 'cast.material.materialname' },
                    {data: 'cast.material.calcgroup' },
                    {data: 'cast.cast_weight' },
                    {data: 'parameter_value1' },
                    {data: 'parameter_value2' },
                    {data: 'completion_date1' },
                ]
            });

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