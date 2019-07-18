@extends('layouts.custom')

@section('title')
    <title>METsoft - Baza modeli</title>
@endsection

@section('content')
    <br>
    <table id="example" class="table table-striped table-bordered table-hover table-condensed" style="font-size: 12px">
        <thead>
            <tr>
                <th>Nazwa firmy</th>
                <th>Numer rysunku</th>
                <th>Nazwa odlewu</th>
                <th>Ostatnie zlecenie</th>
                <th>Ilość zleceń.</th>
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
                <th>Operacje</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
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
                <th>Operacje</th>
            </tr>
        </tfoot>
    </table>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            //Opcje wyglądu nie związane z wyszukiwaniem po kolumnach
            $('#example').DataTable( {
                lengthMenu: [ [25, 50, 100, 200, 500], [25, 50, 100, 200, 500] ],
                pageLength: 25,
                serverSide: true,
                autoWidth: false,
                "order": [[ 18, "desc" ]],
                ajax: "{{ route('patterns.data') }}",
                
                columns: [
                    { data: 'customer', name: 'customer' },
                    { data: 'drawing_number', name: 'drawing_number' },
                    { data: 'pattern_name', name: 'pattern_name' },
                    { data: 'last_order', name: 'last_order' },
                    { data: 'orders_amount', name: 'orders_amount' },
                    { data: 'area',
                        name: 'area',
                        render: $.fn.dataTable.render.number( ' ', ',', 2) 
                    },
                    { data: 'layer_number', name: 'layer_number' },
                    { data: 'layer_place', name: 'layer_place' },
                    { data: 'material', name: 'material' },
                    { data: 'cart_number', name: 'cart_number' },
                    { data: 'pattern_index', name: 'pattern_index' },
                    { data: 'verification', name: 'verification' },
                    { data: 'remarks', name: 'remarks' },
                    { data: 'verification_date', name: 'verification_date' },
                    { data: 'surname', name:'surname'},
                    { data: 'pattern_status.status', name:'pattern_status.status'},
                    { data: 'move_in' },
                    { data: 'last_order', 

                        "fnCreatedCell":function(nTd, sData, oData, iRow, iCol){
                            if(oData.pattern_status.id == 4 || oData.pattern_status.id == 5 || oData.pattern_status.id == 6 || oData.pattern_status.id == 7) {
                                $(nTd).html('');                         
                            } else {
                                var start = new Date(sData);
                                var end   = new Date();
                                var diff  = new Date(end - start);
                                var months  = diff/1000/60/60/24/30;
                                
                                $(nTd).html(months.toFixed(0));
                            }
                        }
                    },
                    { data: "id",
                        "render": function(data, type, row, meta){
                            if(type === 'display'){
                                data = '@can('modelarnia')<a class="__iframe" href="/patterns/' + data + '/edit">Edytuj</a><br>' +
                                '<a class="__iframe" href="/patterns/patterns-status/' + data + '">Status</a><br>@endcan' +
                                '<a class="iframe" href="/patterns/' + data + '">Karta</a>';
                            }
                            return data;
                        }
                    }
                ],
                "drawCallback":function (sttings){
                    $(".iframe").colorbox({iframe:true, escKey:true, width:"90%", height:"90%", });
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
