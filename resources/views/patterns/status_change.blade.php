@extends('layouts.custom')

@section('title')
    <title>METsoft - Zmień status modelu</title>
@endsection

@section('content')
    <div style="text-align: center;	font-size: 30px; padding: 1px; margin: 50px 1px 1px 1px;">Szybka zmiana statusu</div>

    <div style="font-size: 22px; text-align:center;padding:20px">
        <label style="padding:20px">Nazwa firmy:<b>{{ $pattern->customer }}</b></label>
        <label style="padding:20px">Nazwa odlewu:<b>{{ $pattern->pattern_name }}</b></label>
        <label style="padding:20px">Numer rysunku:<b>{{ $pattern->drawing_number }}</b></label>
    </div>

    <div style="text-align:center">
        @foreach($statuses as $status)
            <div style="display: inline-block; padding: 30px 30px">
                <form method="post" action="{{ route('patterns.status-change', ['id' => $pattern->id]) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $pattern->id }}">
                    <input type="hidden" name="status_id" value="{{ $status->id }}">
                    <input type="hidden" name="move_in" value="{{ date('Y-m-d') }}">
                    <button onclick="parent.$.fn.colorbox.close();" style="font-size:40px">{{ $status->status }}</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
