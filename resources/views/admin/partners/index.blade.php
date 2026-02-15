@extends('layouts.admin')

@section('title', 'Gestion des Partenaires')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Partenaires</h1>
        <a href="{{ route('admin.partners.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus mr-2"></i> Nouveau Partenaire
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logo</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Site Web</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($partners as $partner)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($partner->logo)
                            <img class="h-10 w-auto object-contain" src="{{ asset('storage/' . $partner->logo) }}" alt="">
                        @else
                             <div class="h-10 w-10 bg-gray-200 flex items-center justify-center text-gray-500 rounded">
                                <i class="fas fa-handshake"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $partner->name['es'] ?? 'Sans nom' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ App\Models\Partner::TYPES[$partner->type] ?? $partner->type }}
                    </td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($partner->website)
                            <a href="{{ $partner->website }}" target="_blank" class="text-teal-600 hover:underline">Visiter</a>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($partner->active)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Actif
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Inactif
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.partners.edit', $partner) }}" class="text-teal-600 hover:text-teal-900 mr-3">Modifier</a>
                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $partners->links() }}
        </div>
    </div>
@endsection
