@extends('layouts.custom')

@section('title')
    <title>METsoft - Materiały</title>
@endsection

@section('content')
    <div class="table_title">Rejestr materiałów</div>
    <div>
        <form method="get" action="{{ route('offers.materials.create') }}">
            <button type=submit style="font-size: 24px">Dodaj nowy materiał</button>
        </form>
        <br>
        <table id="example" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Lp.</th>
                    <th>Materiał</th>
                    <th>Gr. kal.</th>
                    <th>Opis</th>
                    <th>Edytuj</th>
                </tr>                
            </thead>
            <tfoot>
                <tr>
                    <th>Lp.</th>
                    <th>Materiał</th>
                    <th>Gr. kal.</th>
                    <th>Opis</th>
                    <th>Edytuj</th>
                </tr> 
            </tfoot>
            <tbody>
                @foreach($materials as $material)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $material->material }}</td>
                        <td>{{ $material->rel_mat_group->mat_group }}</td>
                        <td>{{ $material->rel_mat_group->description }}</td>
                        <td><a href="{{ route('offers.materials.edit', ['material' => $material->id]) }}">Edytuj</a></td>
                    </tr>
                @endforeach  
            </tbody>
        </table>
    </div>
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