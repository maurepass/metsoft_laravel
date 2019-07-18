@extends('layouts.custom')

@section('title')
    <title>METsoft - Stwórz raport</title>
@endsection

@section('content')
    <br>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action='{{ route('patterns.report-results') }}' method="POST" class="fieldset">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset>
            <legend>Dane do raportu</legend>
            <ul>
                <li><label>Nazwa firmy nr 1</label><input type="text" name="customer1" size="80" placeholder="pole wymagane"><br></li>
                {{-- <li><label>Nazwa firmy</label><input type="text" name="customer1" size="80"><br></li> --}}
                <li><label>Nazwa firmy nr 2</label><input type="text" name="customer2" size="80"><br></li>
                <li><label>Nazwa firmy nr 3</label><input type="text" name="customer3" size="80"><br></li>
                {{-- <li><label>Czas nieużywania modelu</label><input type="number" name="notusing_time" placeholder="ilość miesięcy"><br></li> --}}
                <button>Generuj</button>
            </ul>  
        </fieldset>
    </form>
@endsection
