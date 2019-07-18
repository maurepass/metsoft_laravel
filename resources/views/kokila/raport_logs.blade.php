@extends('layouts.custom')

@section('title')
    <title>METsoft - Logs</title>
@endsection
    
@section('content')

    <div>
        <table id="example" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Lp</th>
                    <th>IP</th>
                    <th>Host</th>
                    <th>Raport</th>
                    <th>Crated at</th>
                </tr> 
            <thead>
            <tfoot>
                <tr>
                    <th>Lp</th>
                    <th>IP</th>
                    <th>Host</th>
                    <th>Raport</th>
                    <th>Crated at</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach( $logs as $log)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $log->IP }}</td>
                        <td>{{ $log->host }}</td>
                        <td>{{ $log->raport }}</td>
                        <td>{{ $log->created_at }}</td>
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
