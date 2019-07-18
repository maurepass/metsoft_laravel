<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Offers\Material;
use App\Models\Offers\MaterialGroup;

class MaterialsController extends Controller
{
    private $material;

    public function __construct(Material $material)
    {
        $this->material = $material;
        $this->middleware('auth', ['only' => ['create', 'edit']]);
    }

    public function index()
    {
        $materials = $this->material->orderBy('material')->get();
        $this->insertLog('materials');
        return view('offers.materials', compact('materials'));
    }

    public function create()
    {
        $mat_groups = MaterialGroup::all();
        return view('offers.material_create', compact('mat_groups'));
    }

    public function store(Request $request)
    {
        $this->material->create($request->all());
        $this->insertLog('material create');
        return redirect()->route('offers.materials.index');
    }

    public function edit($id)
    {
        $material = $this->material->find($id);
        $mat_groups = MaterialGroup::all();
        return view('offers.material_edit', compact('material', 'mat_groups'));
    }

    public function update(Request $request, $id)
    {
        $material = $this->material->find($id);
        $material->fill($request->input())->save();
        $this->insertLog('material update');
        return redirect()->route('offers.materials.index');
    }
}
