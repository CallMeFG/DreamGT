@extends('layouts.app')

@section('content')
    <div class="min-h-full bg-gray-50 w-full p-8 md:p-12 flex justify-center">
        <div class="w-full max-w-3xl">

            <div class="mb-6 flex items-center gap-2 text-sm text-gray-500">
                <a href="{{ route('admin.arenas.index') }}" class="hover:text-ewc-black">Manage Arenas</a>
                <span>/</span>
                <span class="font-bold text-ewc-black">Create New</span>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-ewc-black p-6 border-b border-gray-100">
                    <h1 class="text-xl font-black text-white uppercase tracking-wider">Add New Arena</h1>
                    <p class="text-xs text-gray-400 mt-1">Set up a new competitive venue.</p>
                </div>

                <div class="p-8">
                    <form action="{{ route('admin.arenas.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Arena Name</label>
                                <input type="text" name="name" placeholder="e.g. Main Stage Arena" required
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Capacity (Pax)</label>
                                <input type="number" name="capacity" placeholder="e.g. 10" required
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Price / Hour
                                    (Rp)</label>
                                <input type="number" name="price_per_hour" placeholder="e.g. 500000" required
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Facilities</label>
                            <textarea name="facilities" rows="3" placeholder="List equipment, sound system, etc..."
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all"></textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Arena Image</label>
                            <input type="file" name="image" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-sm file:border-0 file:text-xs file:font-bold file:bg-ewc-black file:text-white hover:file:bg-gray-800 border border-gray-300 rounded-sm bg-gray-50">
                            <p class="text-[10px] text-gray-400 mt-1">Max 2MB. Format: JPG, PNG.</p>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('admin.arenas.index') }}"
                                class="px-6 py-3 border border-gray-300 text-gray-600 text-xs font-bold uppercase rounded-sm hover:bg-gray-50">Cancel</a>
                            <button type="submit"
                                class="px-6 py-3 bg-ewc-gold text-ewc-black text-xs font-bold uppercase rounded-sm hover:bg-yellow-400 shadow-md">Save
                                Arena</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection