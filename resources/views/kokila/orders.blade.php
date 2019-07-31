@extends('layouts.custom')

@section('title')
    <title>METsoft - Rejestr zamówień</title>
@endsection

@section('content')
    <div class="table_title">Rejestr zamówień</div>

<div>
     <table id="example" class="table table-bordered table-hover" >
        <thead>
            <tr>
                <th>Nr zlecenia</th>
                <th>Klient</th>
                <th>Nazwa odlewu</th>
                <th>Nr. rys.</th>
                <th>Il. szt.</th>          
                <th>Materiał</th>
                <th>Termin</th>
                <th>Mod</th>
                <th>Odl</th>
                <th>Mal</th>
                <th>Zgr.</th>
                <th>Got.</th>
                <th>Marketing</th>
                <th>Data otrzymania</th>
                <th>Data wydania</th>
                <th>Technolog</th>
                <th>Uwagi</th>
                <th>Status</th>
                <th>Dni</th>
                <th>Edytuj</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nr zlecenia</th>
                <th>Klient</th>
                <th>Nazwa odlewu</th>
                <th>Nr. rys.</th>
                <th>Il. szt.</th>          
                <th>Materiał</th>
                <th>Termin</th>
                <th>Mod</th>
                <th>Odl</th>
                <th>Mal</th>
                <th>Zgr.</th>
                <th>Got.</th>
                <th>Marketing</th>
                <th>Data otrzymania</th>
                <th>Data wydania</th>
                <th>Technolog</th>
                <th>Uwagi</th>
                <th>Status</th>
                <th>Dni</th>
                <th>Edytuj</th>
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
                order: [[19, 'desc']],
                ajax: "{{ route('orders.data') }}",
                columns: [
                    {data: 'numer_MET', name: 'numer_MET'},
                    {data: 'company', name: 'company'},
                    {data: 'cast_name', name: 'cast_name'},
                    {data: 'pict_number', name: 'pict_number'},
                    {data: 'cast_pcs', name: 'cast_pcs'},
                    {data: 'cust_material', name: 'cust_material'},
                    {data: 'termin_klienta', name: 'termin_klienta'},
                    {data: 'model', name: 'model',
                        "fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
                            if(sData == 1)
                                $(nTd).html('TAK');
                        }
                    },
                    {data: 'rawcast', name: 'rawcast',
                        "fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
                            if(sData == 1)
                                $(nTd).html('TAK');
                        }
                    },
                    {data: 'painting', name: 'painting',
                        "fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
                            if(sData == 1)
                                $(nTd).html('TAK');
                        }
                    },
                    {data: 'mechrough', name: 'mechrough',
                        "fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
                            if(sData == 1)
                                $(nTd).html('TAK');
                        }
                    },
                    {data: 'mechfine', name: 'mechfine',
                        "fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
                            if(sData == 1)
                                $(nTd).html('TAK');
                        }
                    },
                    {data: 'marketing', name: 'marketing'},
                    {data: 'ord_in', name: 'ord_in'},
                    {data: 'ord_out', name: 'ord_out'},
                    {data: 'tech_memb.first_name', defaultContent: "" },
                    {data: 'uwagi', name: 'uwagi'},
                    {data: 'ord_status.status' },
                    {data: 'working_time', name: 'working_time',
                        "fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
                            if(sData){
                                $(nTd).html(sData);
                            }                               
                            else {
                                var start = new Date(oData.ord_in);
                                var end   = new Date();
                                var diff  = new Date(end - start);
                                var days  = diff/1000/60/60/24;
                                
                                $(nTd).html(days.toFixed(0));
                            }
                        }
                    },
                    {data: 'id', name: 'id',
                    "render": function(data, type, row, meta){
                            if(type === 'display'){
                                data = '<a href="/tech/orders/' + data + '/edit">Edytuj</a>';
                            }
                            return data;
                        }
                    }
                ],  
                rowCallback : function(row, data){
                    if (data.status_id == 2){
                        var start = new Date(data.ord_in);
                        var end = new Date();
                        var diff = new Date(end - start);
                        var days = diff/1000/60/60/24;

                        if (days > 5)
                            $(row).addClass('custom-urgent');

                        if (days < 6)
                            $(row).addClass('custom-todo');            
                    }
                    
                    if (!data.tech_memb)
                        $(row).addClass('custom-empty-tech');
                }
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

