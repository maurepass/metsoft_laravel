@extends('layouts.custom')

@section('title')
    <title>METsoft - Dodaj materiał</title>
@endsection

@section('content')
    <div>
        <form action="{{ route('offers.materials.store') }}" method="post" class="fieldset"> <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <fieldset>
            <legend>Dodaj nowy material</legend>
            <ul>
                <li><label>Material</label> <input name="material" type="text" size=50 placeholder="LII500 wg PN-85/H-83152"><br></li>
                <li><label>Gr. mat.:</label>
                    <select name="mat_group_id" >
                        <option value="11">Wybierz</option>
                        @foreach($mat_groups as $mat_group)
                            <option value="{{ $mat_group->id }}">{{ $mat_group->mat_group }} :: {{ $mat_group->description }}</option>
                        @endforeach
                    </select><br></li>
                <button>Dodaj nowy materiał</button>
            </ul>
        </fieldset>
        </form>
    </div>
@endsection
