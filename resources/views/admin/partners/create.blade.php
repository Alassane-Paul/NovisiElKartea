@extends('layouts.admin')

@section('title', 'Nouveau Partenaire')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.partners.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left mr-1"></i> Retour aux partenaires
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Ajouter un partenaire</h2>
            </div>
            
            <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Type</label>
                        <select name="type" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                            @foreach(App\Models\Partner::TYPES as $key => $label)
                                <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Site Web</label>
                        <input type="url" name="website" value="{{ old('website') }}" placeholder="https://..." class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Ordre</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Statut</label>
                         <label class="flex items-center mt-2">
                            <input type="checkbox" name="active" value="1" {{ old('active', 1) ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-teal-600">
                            <span class="ml-2 text-gray-700">Actif</span>
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Logo</label>
                    <input type="file" name="logo" class="w-full px-3 py-2 border rounded border-gray-300">
                </div>

                <!-- Tabs Langues -->
                <div class="mb-6 border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="langTabs">
                        @foreach(['es', 'fr', 'eu', 'en'] as $lang)
                        <li class="mr-2">
                            <button type="button" onclick="switchLang('{{ $lang }}')" class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 {{ $lang === 'es' ? 'text-teal-600 border-teal-600' : 'border-transparent' }}" id="tab-{{ $lang }}">
                                {{ strtoupper($lang) }}
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>

                @foreach(['es', 'fr', 'eu', 'en'] as $lang)
                <div id="content-{{ $lang }}" class="{{ $lang === 'es' ? '' : 'hidden' }} lang-content">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nom ({{ strtoupper($lang) }})</label>
                        <input type="text" name="name[{{ $lang }}]" value="{{ old('name.'.$lang) }}" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Description ({{ strtoupper($lang) }})</label>
                        <textarea name="description[{{ $lang }}]" rows="5" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">{{ old('description.'.$lang) }}</textarea>
                    </div>
                </div>
                @endforeach

                <div class="flex items-center justify-end mt-6">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                        Ajouter le partenaire
                    </button>
                </div>
            </form>
        </div>
    </div>

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        document.querySelectorAll('textarea[name^="description"]').forEach(textarea => {
            ClassicEditor
                .create(textarea, {
                    toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
                })
                .catch(error => {
                    console.error(error);
                });
        });

        function switchLang(lang) {
            document.querySelectorAll('.lang-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('#langTabs button').forEach(el => {
                el.classList.remove('text-teal-600', 'border-teal-600');
                el.classList.add('border-transparent');
            });
            document.getElementById('content-' + lang).classList.remove('hidden');
            const tab = document.getElementById('tab-' + lang);
            tab.classList.remove('border-transparent');
            tab.classList.add('text-teal-600', 'border-teal-600');
        }
    </script>
@endpush
@endsection
