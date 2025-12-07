@extends('layouts.app')

@section('content')
    <div class="min-h-full bg-gray-50 w-full p-8 md:p-12 flex justify-center">

        <div class="w-full max-w-2xl">
            <div class="mb-6 flex items-center gap-2 text-sm text-gray-500">
                <a href="{{ route('admin.pcs.index') }}" class="hover:text-ewc-black">Manage PCs</a>
                <span>/</span>
                <span class="font-bold text-ewc-black">Create New</span>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-ewc-black p-6 border-b border-gray-100">
                    <h1 class="text-xl font-black text-white uppercase tracking-wider">Add New Unit</h1>
                    <p class="text-xs text-gray-400 mt-1">Register a new computer to inventory.</p>
                </div>

                <div class="p-8">
                    <form action="{{ route('admin.pcs.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">PC Number</label>
                            <input type="text" name="pc_number" placeholder="e.g. PC-01 or VIP-05" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">
                            @error('pc_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">PC Type</label>
                            <select name="pc_type_id" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">
                                <option value="" disabled selected>Select Type</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }} (Rp
                                        {{ number_format($type->price_per_hour) }}/hr)</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Initial Status</label>
                            <select name="status"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">
                                <option value="available">Available</option>
                                <option value="maintenance">Maintenance</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Specifications</label>
                            <textarea name="specifications" rows="3" placeholder="Processor, VGA, RAM details..."
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all"></textarea>
                        </div>

                        <div class="flex justify-end gap-3 pt-4">
                            <a href="{{ route('admin.pcs.index') }}"
                                class="px-6 py-3 border border-gray-300 text-gray-600 text-xs font-bold uppercase rounded-sm hover:bg-gray-50">Cancel</a>
                            <button type="submit"
                                class="px-6 py-3 bg-ewc-gold text-ewc-black text-xs font-bold uppercase rounded-sm hover:bg-yellow-400 shadow-md">Save
                                Unit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection