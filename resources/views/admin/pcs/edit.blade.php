@extends('layouts.app')

@section('content')
    <div class="min-h-full bg-gray-50 w-full p-8 md:p-12 flex justify-center">

        <div class="w-full max-w-2xl">
            <div class="mb-6 flex items-center gap-2 text-sm text-gray-500">
                <a href="{{ route('admin.pcs.index') }}" class="hover:text-ewc-black">Manage PCs</a>
                <span>/</span>
                <span class="font-bold text-ewc-black">Edit {{ $pc->pc_number }}</span>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-ewc-black p-6 border-b border-gray-100 flex justify-between items-center">
                    <div>
                        <h1 class="text-xl font-black text-white uppercase tracking-wider">Edit Unit</h1>
                        <p class="text-xs text-gray-400 mt-1">Update computer details.</p>
                    </div>
                    <div class="bg-white/10 px-3 py-1 rounded text-white text-xs font-mono">{{ $pc->pc_number }}</div>
                </div>

                <div class="p-8">
                    <form action="{{ route('admin.pcs.update', $pc->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">PC Number</label>
                            <input type="text" name="pc_number" value="{{ old('pc_number', $pc->pc_number) }}" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">PC Type</label>
                            <select name="pc_type_id" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ $pc->pc_type_id == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Current Status</label>
                            <select name="status"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">
                                <option value="available" {{ $pc->status == 'available' ? 'selected' : '' }}>Available
                                </option>
                                <option value="booked" {{ $pc->status == 'booked' ? 'selected' : '' }}>Booked</option>
                                <option value="maintenance" {{ $pc->status == 'maintenance' ? 'selected' : '' }}>Maintenance
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Specifications</label>
                            <textarea name="specifications" rows="3"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">{{ old('specifications', $pc->specifications) }}</textarea>
                        </div>

                        <div class="flex justify-end gap-3 pt-4">
                            <a href="{{ route('admin.pcs.index') }}"
                                class="px-6 py-3 border border-gray-300 text-gray-600 text-xs font-bold uppercase rounded-sm hover:bg-gray-50">Cancel</a>
                            <button type="submit"
                                class="px-6 py-3 bg-ewc-gold text-ewc-black text-xs font-bold uppercase rounded-sm hover:bg-yellow-400 shadow-md">Update
                                Unit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection