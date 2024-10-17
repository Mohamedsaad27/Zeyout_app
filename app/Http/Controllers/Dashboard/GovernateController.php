<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Governate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GovernateController extends Controller
{
    public function index()
    {
        $governates = Governate::paginate(20);
        return view('admin.governate.index', compact('governates'));
    }
    public function create()
    {
        return view('admin.governate.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);
        Governate::create($validatedData);
        return redirect()->route('governates.index')->with('successCreate','Governate created successfully');
    }
    public function edit($id)
    {
        $governate = Governate::find($id);
        return view('admin.governate.edit', compact('governate'));
    }
    public function update(Request $request, $id)
    {
        $governate = Governate::find($id);
        $validatedData = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
        ]);
        $governate->update($validatedData);
        return redirect()->route('governates.index')->with('successUpdate','Governate updated successfully');
    }

    public function destroy($id)
    {
        $governate = Governate::find($id);
        $governate->delete();
        return redirect()->route('governates.index')->with('successDelete','Governate deleted successfully');
    }
}
