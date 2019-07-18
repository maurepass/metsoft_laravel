@extends('layouts.custom')

@section('title')
    <title>METsoft - Czas wykonania - wyniki</title>
@endsection

@section('content')

<br>
<form method="get" action="{{ route('czas-wykonania') }}">
    <button type=submit style="font-size: 24px">Nowe wyszukiwanie</button>
</form>
<br>
    <table id="example" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>ID odlewu</th>
                <th>Numer MET</th>
                <th>Klient</th>
                <th>Nazwa odlewu</th>
                <th>Numer rysunku</th>
                <th>Numer sztuki</th>
                <th>KO utworzono</th>
				<th>Zaformowano</th>
                <th>Data zalania</th>
                {{--}}
                <th>Czas do zalania</th>
                --}}
                <th>Odbiór DD</th>
                {{--}}
                <th>Czas do odbioru</th>
                --}}
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID odlewu</th>
                <th>Numer MET</th>
                <th>Klient</th>
                <th>Nazwa odlewu</th>
                <th>Numer rysunku</th>
                <th>Numer sztuki</th>
                <th>KO utworzono</th>
				<th>Zaformowano</th>
                <th>Data zalania</th>
                {{--}}
                <th>Czas do zalania</th>
                --}}
                <th>Odbiór DD</th>
                {{--}}
                <th>Czas do odbioru</th>
                --}}
            </tr>
        </tfoot>
        <tbody>
            @foreach( $casts as $cast)
                <tr>
                    <td>{{ $cast->casting_id }}</td>
                    <td>{{ $cast->numer_MET }}</td>
                    <td>{{ $cast->company }}</td>
                    <td>{{ $cast->cast_name }}</td>
                    <td>{{ $cast->picture_number }}</td>
                    <td>{{ $cast->pc_number }}</td>
                    <td>{{ $cast->utworzono }}</td>
					<td>{{ $cast->formowanie}}</td>
                    <td>{{ $cast->zalanie }}</td>
                    {{--}}
                    <td>{{ $cast -> czas_do_zalania }}</td>
                    --}}
                    <td>{{ $cast->odbior }}</td>
                    {{--}}
                    <td>{{ $cast -> czas_do_odbioru }}</td>
                    --}}
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

