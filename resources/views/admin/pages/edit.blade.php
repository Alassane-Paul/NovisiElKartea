@extends('layouts.admin')

@section('title', 'Modifier la Page')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.pages.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left mr-1"></i> Retour aux pages
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Modifier : {{ $page->title['es'] ?? 'Page' }}</h2>
            </div>
            
            <form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Type de Page (Slug)</label>
                        <select name="slug" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                            @foreach(App\Models\Page::PAGES as $slug => $label)
                                <option value="{{ $slug }}" {{ old('slug', $page->slug) === $slug ? 'selected' : '' }}>{{ $label }} ({{ $slug }})</option>
                            @endforeach
                        </select>
                        @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Statut</label>
                         <label class="flex items-center mt-2">
                            <input type="checkbox" name="active" value="1" {{ old('active', $page->active) ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-teal-600">
                            <span class="ml-2 text-gray-700">Active</span>
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Image de mise en avant</label>
                    @if($page->featured_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $page->featured_image) }}" alt="Image actuelle" class="h-32 rounded object-cover">
                        </div>
                    @endif
                    <input type="file" name="featured_image" class="w-full px-3 py-2 border rounded border-gray-300">
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
                        <label class="block text-gray-700 font-bold mb-2">Titre ({{ strtoupper($lang) }})</label>
                        <input type="text" name="title[{{ $lang }}]" value="{{ old('title.'.$lang, $page->title[$lang] ?? '') }}" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Contenu ({{ strtoupper($lang) }})</label>
                        <textarea name="content[{{ $lang }}]" rows="15" class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">{{ old('content.'.$lang, $page->content[$lang] ?? '') }}</textarea>
                    </div>
                </div>
                @endforeach

                <div class="flex items-center justify-end mt-6">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        document.querySelectorAll('textarea[name^="content"]').forEach(textarea => {
            ClassicEditor
                .create(textarea, {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
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
