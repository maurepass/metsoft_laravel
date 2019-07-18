@extends('layouts.custom')

@section('title')
    <title>METsoft - Rejestr ofert</title>
@endsection

@section('content')
    <div class="text-center my-3">
        <h1>Rejestr ofert</h1>
    </div>
    
    <div>
        <table id="example" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nr zapytania</th>
                    <th>Klient</th>
                    <th>Marketingowiec</th>
                    <th>Technolog</th>
                    <th>Data przekazania do WZT</th>
                    <th>Data wydania z WZT</th>
                    <th>Ilość pozycji</th>
                    <th>Detale</th>
                    <th>Do druku</th>
                    <th>Status</th>
                    <th>Ilość dni</th>
                </tr>                
            </thead>
            <tfoot>
                <tr>
                    <th>Nr zapytania</th>
                    <th>Klient</th>
                    <th>Marketingowiec</th>
                    <th>Technolog</th>
                    <th>Data przekazania do WZT</th>
                    <th>Data wydania z WZT</th>
                    <th>Ilość pozycji</th>
                    <th>Detale</th>
                    <th>Do druku</th>
                    <th>Status</th>
                    <th>Ilość dni</th>
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
                order: [[4, 'desc']],
                ajax: "{{ route('offers.data') }}",
                columns: [
                    {data: 'offer_no', name: 'offer_no',
                        "fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
                                 $(nTd).html('<a href="/offers/' + oData.id + '/edit" >' + sData +'</a>');
                         }
                    },
                    {data: 'client' },
                    {data: 'user_mark.first_name' },
                    {data: 'user_tech.first_name' },
                    {data: 'date_tech_in' },
                    {data: 'date_tech_out' },
                    {data: 'positions_amount' },
                    {data: 'id', name: 'id',
                    "render": function(data, type, row, meta){
                            if(type === 'display'){
                                data = '<a href="/offers/' + data +'/details">Detale</a>';
                            }
                            return data;
                        }
                    },
                    {data: 'id', name: 'id',
                    "render": function(data, type, row, meta){
                            if(type === 'display'){
                                data = '<a href="/offers/' + data + '" target="_blank">Do druku</a>';
                            }
                            return data;
                        }
                    },
                    {data: 'offer_status.offer_status' },
                    {data: 'days_amount', name: 'days_amount',
                        "fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
                            if(oData.status_id != 1 ){
                                $(nTd).html(sData);
                            }                               
                            else {
                                var start = new Date(oData.date_tech_in);
                                var end   = new Date();
                                var diff  = new Date(end - start);
                                var days  = diff/1000/60/60/24 - 0.5; // [- 0.5] => increase amount of days at 12:00 midnight instead of 12:00 noon
                                
                                $(nTd).html(days.toFixed(0));
                            }
                         }
                    },
                ],
                rowCallback : function(row, data){
                    if (data.status_id == 1 ){
                        var start = new Date(data.date_tech_in);
                        var end = new Date();
                        var diff = new Date(end - start);
                        var days = diff/1000/60/60/24;

                        if (days > 5)
                            $(row).addClass('custom-urgent');

                        if (days < 6)
                            $(row).addClass('custom-todo');            
                    }
                }
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

