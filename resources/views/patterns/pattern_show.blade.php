@extends('layouts.custom')

@section('title')
    <title>METsoft - Karta modelu</title>
@endsection

@section('content')
    <div style="text-align: center;	font-size: 30px; padding: 1px; margin: 40px 1px 1px 1px;">Karta modelu</div>
    <div style="font-size: 22px; text-align: center; padding: 20px">
        <label style="padding: 20px">Nazwa firmy:<b>{{ $pattern->customer }}</b></label>
        <label style="padding: 20px">Nazwa odlewu:<b>{{ $pattern->pattern_name }}</b></label>
        <label style="padding: 20px">Numer rysunku:<b>{{ $pattern->drawing_number }}</b></label>
    </div>

    <table class="table table-bordered table-striped" style="width: 60%; margin: auto">
        <thead>
            <tr>
                <th>Lp</th>
                <th>Operacja</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($operations as $operation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @foreach($statuses as $status)
                                @if($status->id == $operation->status_id)
                                    {{ $status->status }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $operation->date }}</td>
                     </tr>
            @endforeach
        </tbody>
    </table>
@endsection
