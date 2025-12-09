<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pc;
use App\Models\PcType;
use Illuminate\Http\Request;

class AdminPcController extends Controller
{
    public function index(Request $request)
    {
        $query = Pc::with('type');

        // Search
        if ($request->search) {
            $query->where('pc_number', 'like', '%' . $request->search . '%');
        }
        // Filter Status
        if ($request->status && $request->status != 'all') {    
            $query->where('status', $request->status);
        }

        $pcs = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pcs.index', compact('pcs'));
    }

    public function create()
    {
        $types = PcType::all();
        return view('admin.pcs.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pc_number' => 'required|unique:pcs,pc_number',
            'pc_type_id' => 'required',
            'status' => 'required'
        ]);

        Pc::create($request->all());
        return redirect()->route('admin.pcs.index')->with('success', 'PC Created Successfully');
    }

    public function edit(Pc $pc)
    {
        $types = PcType::all();
        return view('admin.pcs.edit', compact('pc', 'types'));
    }

    public function update(Request $request, Pc $pc)
    {
        $request->validate([
            'pc_number' => 'required|unique:pcs,pc_number,' . $pc->id,
            'pc_type_id' => 'required',
            'status' => 'required'
        ]);

        $pc->update($request->all());
        return redirect()->route('admin.pcs.index')->with('success', 'PC Updated');
    }

    public function destroy(Pc $pc)
    {
        $pc->delete();
        return back()->with('success', 'PC Deleted');
    }
}