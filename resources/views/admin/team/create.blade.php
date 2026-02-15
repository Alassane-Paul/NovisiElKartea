@extends('layouts.admin')

@section('title', 'Nouveau Membre')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.team.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left mr-1"></i> Retour à l'équipe
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Ajouter un membre</h2>
            </div>
            
            <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Téléphone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Ordre</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Catégorie</label>
                        <select name="category" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                            <option value="">Sélectionnez une catégorie</option>
                            @foreach(App\Models\TeamMember::CATEGORIES as $key => $label)
                                <option value="{{ $key }}" {{ old('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
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
                    <label class="block text-gray-700 font-bold mb-2">Photo</label>
                    <input type="file" name="photo" class="w-full px-3 py-2 border rounded border-gray-300">
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
                        <label class="block text-gray-700 font-bold mb-2">Poste ({{ strtoupper($lang) }})</label>
                        <input type="text" name="position[{{ $lang }}]" value="{{ old('position.'.$lang) }}" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Biographie ({{ strtoupper($lang) }})</label>
                        <textarea name="bio[{{ $lang }}]" rows="5" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">{{ old('bio.'.$lang) }}</textarea>
                    </div>
                </div>
                @endforeach

                <div class="flex items-center justify-end mt-6">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                        Ajouter le membre
                    </button>
                </div>
            </form>
        </div>
    </div>

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        document.querySelectorAll('textarea[name^="bio"]').forEach(textarea => {
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
