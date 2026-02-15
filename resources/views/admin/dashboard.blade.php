@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Bienvenue dans l'administration</h1>
        <p class="text-gray-600 mt-2">Gérez facilement le contenu de votre site Novisi Elkartea</p>
    </div>

    <!-- Quick Actions -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Actions rapides</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <!-- Add Project -->
            <a href="{{ route('admin.projects.create') }}" class="bg-gradient-to-br from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white rounded-lg p-6 shadow-md hover:shadow-lg transition-all transform hover:-translate-y-1">
                <div class="flex flex-col items-center text-center">
                    <i class="fas fa-plus-circle text-3xl mb-3"></i>
                    <span class="font-semibold">Nouveau Projet</span>
                </div>
            </a>

            <!-- Add Service -->
            <a href="{{ route('admin.services.create') }}" class="bg-gradient-to-br from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white rounded-lg p-6 shadow-md hover:shadow-lg transition-all transform hover:-translate-y-1">
                <div class="flex flex-col items-center text-center">
                    <i class="fas fa-plus-circle text-3xl mb-3"></i>
                    <span class="font-semibold">Nouveau Service</span>
                </div>
            </a>

            <!-- Add Team Member -->
            <a href="{{ route('admin.team.create') }}" class="bg-gradient-to-br from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white rounded-lg p-6 shadow-md hover:shadow-lg transition-all transform hover:-translate-y-1">
                <div class="flex flex-col items-center text-center">
                    <i class="fas fa-user-plus text-3xl mb-3"></i>
                    <span class="font-semibold">Ajouter Membre</span>
                </div>
            </a>

            <!-- Settings -->
            <a href="{{ route('admin.settings.index') }}" class="bg-gradient-to-br from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white rounded-lg p-6 shadow-md hover:shadow-lg transition-all transform hover:-translate-y-1">
                <div class="flex flex-col items-center text-center">
                    <i class="fas fa-cogs text-3xl mb-3"></i>
                    <span class="font-semibold">Paramètres</span>
                </div>
            </a>

            <!-- View Site -->
            <a href="{{ route('home') }}" target="_blank" class="bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg p-6 shadow-md hover:shadow-lg transition-all transform hover:-translate-y-1">
                <div class="flex flex-col items-center text-center">
                    <i class="fas fa-external-link-alt text-3xl mb-3"></i>
                    <span class="font-semibold">Voir le Site</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Statistics -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Statistiques</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Projects Count -->
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-teal-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold uppercase">Projets</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['projects'] }}</p>
                    </div>
                    <div class="p-3 rounded-full bg-teal-100 text-teal-600">
                        <i class="fas fa-project-diagram text-2xl"></i>
                    </div>
                </div>
                <a href="{{ route('admin.projects.index') }}" class="text-teal-600 hover:text-teal-700 text-sm font-semibold mt-4 inline-block">
                    Gérer les projets →
                </a>
            </div>

            <!-- Services Count -->
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-orange-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold uppercase">Services</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['services'] }}</p>
                    </div>
                    <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                        <i class="fas fa-hands-helping text-2xl"></i>
                    </div>
                </div>
                <a href="{{ route('admin.services.index') }}" class="text-orange-600 hover:text-orange-700 text-sm font-semibold mt-4 inline-block">
                    Gérer les services →
                </a>
            </div>
            
            <!-- Team Members Count -->
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-teal-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold uppercase">Équipe</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['team'] }}</p>
                    </div>
                    <div class="p-3 rounded-full bg-teal-100 text-teal-600">
                        <i class="fas fa-user-friends text-2xl"></i>
                    </div>
                </div>
                <a href="{{ route('admin.team.index') }}" class="text-teal-600 hover:text-teal-700 text-sm font-semibold mt-4 inline-block">
                    Gérer l'équipe →
                </a>
            </div>

            <!-- Partners Count -->
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-orange-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold uppercase">Partenaires</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['partners'] }}</p>
                    </div>
                    <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                        <i class="fas fa-handshake text-2xl"></i>
                    </div>
                </div>
                <a href="{{ route('admin.partners.index') }}" class="text-orange-600 hover:text-orange-700 text-sm font-semibold mt-4 inline-block">
                    Gérer les partenaires →
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Content -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Projects -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Projets récents</h3>
                <a href="{{ route('admin.projects.index') }}" class="text-teal-600 hover:text-teal-700 text-sm font-semibold">
                    Voir tout →
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recentProjects as $project)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-project-diagram text-teal-600"></i>
                            <span class="text-gray-800 font-medium">{{ $project->getTranslated('title', 'es') }}</span>
                        </div>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="text-gray-500 hover:text-teal-600">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm text-center py-4">Aucun projet pour le moment</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Services -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Services récents</h3>
                <a href="{{ route('admin.services.index') }}" class="text-orange-600 hover:text-orange-700 text-sm font-semibold">
                    Voir tout →
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recentServices as $service)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-hands-helping text-orange-600"></i>
                            <span class="text-gray-800 font-medium">{{ $service->getTranslated('title', 'es') }}</span>
                        </div>
                        <a href="{{ route('admin.services.edit', $service) }}" class="text-gray-500 hover:text-orange-600">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm text-center py-4">Aucun service pour le moment</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
