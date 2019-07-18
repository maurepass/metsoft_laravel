@extends('layouts.custom')

@section('title')
    <title>METsoft - Edytuj materiał</title>
@endsection

@section('content')
    <div>
        <form action="{{ route('offers.materials.update', ['material' => $material->id]) }}" method="post" class="fieldset">
            <input name="_method" type="hidden" value="patch">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <fieldset>
                <legend>Edytuj material</legend>
                <ul>
                    <li><label>Material</label> <input name="material" type="text" size=50 value="{{ $material->material }}"><br></li>
                    <li><label>Gr. mat.:</label>
                        <select name="mat_group_id" >
                            @foreach($mat_groups as $mat_group)
                                <option value="{{ $mat_group->id }}" @if($mat_group->id == $material->mat_group_id) selected @endif>{{ $mat_group->mat_group }}</option>
                            @endforeach
                        </select><br></li>
                    <input type="submit" value="Zapisz zmiany">
                </ul>
            </fieldset>
        </form>
    </div>
@endsection