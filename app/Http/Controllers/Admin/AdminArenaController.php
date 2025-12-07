<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Arena;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminArenaController extends Controller
{
    public function index(Request $request)
    {
        $query = Arena::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $arenas = $query->latest()->paginate(10);
        return view('admin.arenas.index', compact('arenas'));
    }

    public function create()
    {
        return view('admin.arenas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'capacity' => 'required|integer',
            'price_per_hour' => 'required|numeric',
            'facilities' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('arenas', 'public');
        }

        Arena::create($data);
        return redirect()->route('admin.arenas.index')->with('success', 'Arena Added');
    }

    public function edit(Arena $arena)
    {
        return view('admin.arenas.edit', compact('arena'));
    }

    public function update(Request $request, Arena $arena)
    {
        $data = $request->validate([
            'name' => 'required',
            'capacity' => 'required|integer',
            'price_per_hour' => 'required|numeric',
            'facilities' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($arena->image_path)
                Storage::disk('public')->delete($arena->image_path);
            $data['image_path'] = $request->file('image')->store('arenas', 'public');
        }

        $arena->update($data);
        return redirect()->route('admin.arenas.index')->with('success', 'Arena Updated');
    }

    public function destroy(Arena $arena)
    {
        if ($arena->image_path)
            Storage::disk('public')->delete($arena->image_path);
        $arena->delete();
        return back()->with('success', 'Arena Deleted');
    }
}