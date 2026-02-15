@extends('layouts.admin')

@section('title', 'Gestion de l\'Équipe')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Équipe</h1>
        <a href="{{ route('admin.team.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus mr-2"></i> Nouveau Membre
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poste</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($members as $member)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($member->photo)
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $member->photo) }}" alt="">
                        @else
                             <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $member->name['es'] ?? 'Sans nom' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $member->position['es'] ?? '' }}
                    </td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $member->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($member->active)
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
                        <a href="{{ route('admin.team.edit', $member) }}" class="text-teal-600 hover:text-teal-900 mr-3">Modifier</a>
                        <form action="{{ route('admin.team.destroy', $member) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr ?');">
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
            {{ $members->links() }}
        </div>
    </div>
@endsection
