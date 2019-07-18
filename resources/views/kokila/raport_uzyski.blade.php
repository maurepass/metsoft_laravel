
@extends('layouts.custom')

@section('title')
    <title>METsoft - Uzyski</title>
@endsection

@section('content')

<div class="table_title">Uzyski na odlewach (wg KO)</div>
    <table id="example" class="table table-bordered table-striped table-hover" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Numer MET</th>
                <th>Klient</th>
                <th>Nazwa odlewu</th>
                <th>Numer rysunku</th>
                <th>Materiał</th>
                <th>Technolog</th>
                <th>Waga</th>
                <th>Metal</th>
                <th>Uzysk</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Numer MET</th>
                <th>Klient</th>
                <th>Nazwa odlewu</th>
                <th>Numer rysunku</th>
                <th>Materiał</th>
                <th>Technolog</th>
                <th>Waga</th>
                <th>Metal</th>
                <th>Uzysk</th>
            </tr>
        </tfoot>
    </table>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('#example').DataTable( {
                lengthMenu: [ [50, 100, 200, 500], [50, 100, 200, 500] ],
                pageLength: 50,
                serverSide: true,
                autoWidth: false,
                order: [[0, 'desc']],
                ajax: "{{ route('uzyski-data') }}",              
                columns: [
                    {data: 'id'},
                    {data: 'porder.numer_MET' },
                    {data: 'customer' },
                    {data: 'cast_name' },
                    {data: 'picture_number' },
                    {data: 'material.materialname' },
                    {data: 'tech_maker' },
                    {data: 'cast_weight' },
                    {data: 'material_need' },
                    {data: 'id',
                        "fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
                                $(nTd).html(parseFloat(oData.cast_weight * 100 / oData.material_need).toFixed(1) + ' %' );
                            }
                    }
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