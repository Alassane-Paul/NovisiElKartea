@extends('layouts.admin')

@section('title', 'Paramètres du Site')

@section('content')
    <style>
        /* Custom toggle switch styles */
        .toggle-checkbox:checked {
            right: 0;
            background-color: #0d9488;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #0d9488;
        }
        .toggle-label {
            transition: background-color 0.3s;
        }
    </style>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Configuration Générale</h2>
            </div>
            
            <form action="{{ route('admin.settings.update') }}" method="POST" class="p-6" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                @foreach($settings as $group => $groupSettings)
                    <div class="mb-8 bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-bold text-teal-700 mb-4 border-b border-gray-200 pb-2 capitalize flex items-center">
                            @if($group === 'social') <i class="fas fa-share-alt mr-2"></i> @endif
                            @if($group === 'contact') <i class="fas fa-address-card mr-2"></i> @endif
                            {{ $group }}
                        </h3>
                        
                        <div class="grid grid-cols-1 gap-6">
                            @foreach($groupSettings as $setting)
                                <div class="flex items-start {{ $setting->type === 'boolean' ? 'bg-white p-3 rounded border border-gray-200' : '' }}">
                                    <div class="flex-1">
                                        <label class="block text-gray-700 font-bold mb-1" for="{{ $setting->key }}">
                                            {{ $setting->label }}
                                        </label>
                                        
                                        @if($setting->type === 'text' || $setting->type === 'email' || $setting->type === 'url')
                                            <input type="{{ $setting->type === 'url' ? 'url' : 'text' }}" 
                                                   id="{{ $setting->key }}"
                                                   name="{{ $setting->key }}" 
                                                   value="{{ $setting->value }}" 
                                                   class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                                        
                                        @elseif($setting->type === 'textarea')
                                            <textarea id="{{ $setting->key }}" 
                                                      name="{{ $setting->key }}" 
                                                      rows="3"
                                                      class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">{{ $setting->value }}</textarea>
                                        
                                        @elseif($setting->type === 'boolean')
                                            <div class="flex items-center mt-3">
                                                <div class="relative inline-block w-14 mr-2 align-middle select-none">
                                                    <input type="checkbox" 
                                                           id="{{ $setting->key }}" 
                                                           name="{{ $setting->key }}" 
                                                           value="1"
                                                           {{ $setting->boolean_value ? 'checked' : '' }}
                                                           class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-2 appearance-none cursor-pointer transition-all duration-300"
                                                           style="top: 1px; left: 2px; {{ $setting->boolean_value ? 'transform: translateX(28px);' : '' }}">
                                                    <label for="{{ $setting->key }}" 
                                                           class="toggle-label block overflow-hidden h-7 rounded-full bg-gray-300 cursor-pointer"
                                                           style="{{ $setting->boolean_value ? 'background-color: #0d9488;' : '' }}"></label>
                                                </div>
                                                <label for="{{ $setting->key }}" class="text-sm font-semibold cursor-pointer" style="color: {{ $setting->boolean_value ? '#0d9488' : '#4b5563' }}">
                                                    {{ $setting->boolean_value ? 'Activé' : 'Désactivé' }}
                                                </label>
                                            </div>
                                        
                                        @elseif($setting->type === 'file')
                                            <div class="mt-2">
                                                @if($setting->value)
                                                    <div class="mb-3 p-3 bg-gray-50 rounded border border-gray-200">
                                                        <img src="{{ asset('storage/' . $setting->value) }}" alt="Logo actuel" class="h-16 object-contain mb-2">
                                                        <p class="text-xs text-gray-500">Logo actuel</p>
                                                    </div>
                                                @endif
                                                <input type="file" 
                                                       id="{{ $setting->key }}" 
                                                       name="{{ $setting->key }}" 
                                                       accept="image/*"
                                                       class="w-full px-3 py-2 border rounded border-gray-300 focus:outline-none focus:border-teal-500">
                                                <p class="text-xs text-gray-500 mt-1">Formats acceptés : PNG, JPG, SVG (max 2MB)</p>
                                            </div>
                                        @endif
                                        
                                        @if($setting->description)
                                            <p class="text-gray-500 text-xs mt-1">{{ $setting->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="flex items-center justify-end mt-6">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                        Enregistrer les paramètres
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle switch animation
        document.querySelectorAll('.toggle-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const label = this.nextElementSibling;
                const textLabel = label.nextElementSibling;
                
                if (this.checked) {
                    this.style.transform = 'translateX(28px)';
                    this.style.backgroundColor = '#0d9488';
                    label.style.backgroundColor = '#0d9488';
                    textLabel.style.color = '#0d9488';
                    textLabel.textContent = 'Activé';
                } else {
                    this.style.transform = 'translateX(0)';
                    this.style.backgroundColor = '#fff';
                    label.style.backgroundColor = '#d1d5db';
                    textLabel.style.color = '#4b5563';
                    textLabel.textContent = 'Désactivé';
                }
            });
        });
    </script>
@endsection
