@extends('layouts.custom')

@section('title')
    <title>METsoft - Znalezione odlewy</title>
@endsection

@section('content')
    <div class="table_title">Rejestr detali z ofert</div>

    <div>
        <table id="example" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Nr oferty</th>
                    <th>Nazwa</th>
                    <th>Nr rysunku</th>
                    <th>Materiał</th>
                    <th>Ciężar [kg]</th>
                    <th>Il. szt.</th>
                    <th>Uzysk[%]</th>
                    <th>St. tr.</th>
                    <th>Model</th>
                    <th>Obr cieplna</th>
                    <th>Obr. mech.</th>
                    <th>Tolerancje</th>
                    <th>Pochylenia</th>
                    <th>Atest</th>
                    <th>Odb. odlewu</th>
                    <th>Klasa jakości</th>
                </tr> 
            </thead>
            <tfoot>
                <tr>
                    <th>Nr oferty</th>
                    <th>Nazwa</th>
                    <th>Nr rysunku</th>
                    <th>Materiał</th>
                    <th>Ciężar [kg]</th>
                    <th>Il. szt.</th>
                    <th>Uzysk[%]</th>
                    <th>St. tr.</th>
                    <th>Model</th>
                    <th>Obr cieplna</th>
                    <th>Obr. mech.</th>
                    <th>Tolerancje</th>
                    <th>Pochylenia</th>
                    <th>Atest</th>
                    <th>Odb. odlewu</th>
                    <th>Klasa jakości</th>
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
                order: [[0, 'desc']],
                ajax: "{{ route('offers.details-data') }}",              
                columns: [
                    {data: 'offer.offer_no',
                    "fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
                                 $(nTd).html('<a href="/offers/' + oData.offer_id + '" target="_blank" >' + sData +'</a>');
                         }
                    },
                    {data: 'cast_name' },
                    {data: 'drawing_no' },
                    {data: 'material.material' },
                    {data: 'cast_weight' },
                    {data: 'pieces_amount' },
                    {data: 'yeld' },
                    {data: 'difficulty' },
                    {data: 'pattern' },
                    {data: 'heat_treat' },
                    {data: 'machining_id' },
                    {data: 'tolerances' },
                    {data: 'tapers' },
                    {data: 'atest' },
                    {data: 'required' },
                    {data: 'quality_class' },
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