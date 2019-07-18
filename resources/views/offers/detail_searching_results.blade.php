@extends('layouts.custom')

@section('title')
    <title>METsoft - Znalezione odlewy</title>
@endsection

@section('content')

    <div class="text-center my-3">
        <h1>Znalezione odlewy</h1>
    </div>

    <div>
        <table id="example" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Lp</th>
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
                    <th>Lp</th>
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
            <tbody>
                @foreach($details as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('offers.show', ['offer' => $detail->id_offer]) }} " target="_blank">{{ $detail->offer->offer_no }}</a></td>
                        <td>{{ $detail->cast_name }}</td>
                        <td>{{ $detail->drawing_no }}</td>
                        <td>{{ $detail->material->material }}</td>
                        <td>{{ $detail->cast_weight }}</td>
                        <td>{{ $detail->pieces_amount }}</td>
                        <td>{{ $detail->yeld }}</td>
                        <td>{{ $detail->difficulty }}</td>
                        <td>{{ $detail->pattern }}</td>
                        <td>{{ $detail->heat_treat }}</td>
                        <td>{{ $detail->machining->machining ?? "" }}</td>
                        <td>{{ $detail->tolerances }}</td>
                        <td>{{ $detail->tapers }}</td>
                        <td>{{ $detail->atest }}</td>
                        <td>{{ $detail->required }}</td>
                        <td>{{ $detail->quality_class }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            lengthMenu: [ [50, 100, 200, 500], [50, 100, 200, 500] ],
            pageLength: 50,
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