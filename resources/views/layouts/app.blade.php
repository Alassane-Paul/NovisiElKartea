<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $settings['site_name'] ?? 'Novisi Elkartea')</title>
    
    <!-- FontAwesome pour icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('styles')
</head>
<body>
    <header class="w-full bg-white shadow-md relative z-50">
        <!-- Top Bar -->
        <div class="bg-[#e0f2f1] py-2 border-b border-gray-200">
            <div class="container mx-auto px-4 flex justify-between items-center text-xs font-semibold tracking-wide">
                <!-- Langues -->
                <div class="flex space-x-3 text-gray-600">
                    @foreach(['es' => 'ES', 'eu' => 'EUS', 'fr' => 'FR', 'en' => 'EN'] as $code => $label)
                    <a href="{{ route('lang.switch', $code) }}" 
                       class="{{ app()->getLocale() === $code ? 'text-[#009688] font-bold underline' : 'hover:text-[#009688] transition-colors' }}">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>
                <!-- Réseaux Sociaux -->
                <div class="flex space-x-4 text-gray-500">
                    @foreach(['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'tiktok', 'pinterest', 'whatsapp', 'telegram', 'snapchat'] as $key)
                        @if(($settings["social_{$key}_active"] ?? false) && ($settings["social_{$key}_url"] ?? '#') !== '#')
                            <a href="{{ $settings["social_{$key}_url"] }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#009688] transition-colors">
                                <i class="fab fa-{{ $key === 'twitter' ? 'x-twitter' : ($key === 'linkedin' ? 'linkedin-in' : $key) }}"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Main Navbar -->
        <div class="container mx-auto px-4 py-3 flex justify-between items-center bg-white">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex-shrink-0">
                @if($settings['site_logo'] ?? false)
                    <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'Novisi Elkartea' }}" class="h-12 md:h-16 w-auto object-contain">
                @else
                    <img src="{{ asset('images/logo.png') }}" alt="{{ $settings['site_name'] ?? 'Novisi Elkartea' }}" class="h-12 md:h-16 w-auto object-contain" onerror="this.src='https://via.placeholder.com/150x60?text={{ urlencode($settings['site_name'] ?? 'Novisi Elkartea') }}'">
                @endif
            </a> 

            <!-- Navigation Desktop -->
            <nav class="hidden md:flex space-x-6 lg:space-x-10 items-center font-medium text-gray-700 text-sm lg:text-base">
                
                <!-- Conocernos Dropdown -->
                <div class="relative group">
                    <button class="flex items-center hover:text-[#009688] focus:outline-none py-4 transition-colors">
                        {{ __('header.about') }} <i class="fas fa-chevron-down ml-1 text-[10px] text-gray-400 group-hover:text-[#009688]"></i>
                    </button>
                    <!-- Dropdown Menu -->
                    <div class="absolute left-0 top-full mt-0 w-56 bg-white border border-gray-100 shadow-xl rounded-b-lg hidden group-hover:block z-50 transform origin-top transition-all duration-200">
                        <div class="py-2">
                            <a href="{{ route('about.index') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]">{{ __('header.about_index') }}</a>
                            <a href="{{ route('about.what') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]">{{ __('header.about_what') }}</a>
                            <a href="{{ route('about.who') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]">{{ __('header.about_who') }}</a>
                            <a href="{{ route('about.partners') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]">{{ __('header.about_partners') }}</a>
                        </div>
                    </div>
                </div>

                <!-- Qué Hacemos Dropdown -->
                <div class="relative group">
                    <button class="flex items-center hover:text-[#009688] focus:outline-none py-4 transition-colors">
                        {{ __('header.services') }} <i class="fas fa-chevron-down ml-1 text-[10px] text-gray-400 group-hover:text-[#009688]"></i>
                    </button>
                    <div class="absolute left-0 top-full mt-0 w-56 bg-white border border-gray-100 shadow-xl rounded-b-lg hidden group-hover:block z-50">
                        <div class="py-2">
                            <a href="{{ route('services.index') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]">{{ __('header.services_index') }}</a>
                            <a href="{{ route('services.education') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]">{{ __('header.services_education') }}</a>
                            <a href="{{ route('services.intercultural') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]">{{ __('header.services_intercultural') }}</a>
                        </div>
                    </div>
                </div>

                <!-- Proyectos Dropdown -->
                <div class="relative group">
                    <button class="flex items-center hover:text-[#009688] focus:outline-none py-4 transition-colors">
                        {{ __('header.projects') }} <i class="fas fa-chevron-down ml-1 text-[10px] text-gray-400 group-hover:text-[#009688]"></i>
                    </button>
                    <div class="absolute left-0 top-full mt-0 w-56 bg-white border border-gray-100 shadow-xl rounded-b-lg hidden group-hover:block z-50">
                       <div class="py-2">
                            <a href="{{ route('projects.index') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]">{{ __('header.projects_index') }}</a>
                            <a href="{{ route('projects.afrikarte') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]">{{ __('header.projects_afrikarte') }}</a>
                            <a href="{{ route('projects.diversity') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]">{{ __('header.projects_diversity') }}</a>
                            <a href="{{ route('projects.equality') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]">{{ __('header.projects_equality') }}</a>
                            <a href="{{ route('projects.new-generation') }}" class="block px-4 py-2 hover:bg-gray-50 hover:text-[#009688]">{{ __('header.projects_new_generation') }}</a>
                       </div>
                    </div>
                </div>

                <a href="{{ route('contact.index') }}" class="hover:text-[#009688] transition-colors py-4">{{ __('header.contact') }}</a>
            </nav>

            <!-- CTA Button -->
            <a href="{{ route('join.index') }}" class="hidden md:inline-flex items-center justify-center bg-[#ff9800] hover:bg-[#f57c00] text-white font-bold py-2.5 px-6 rounded shadow-md transition-all duration-300 uppercase tracking-wider text-sm transform hover:-translate-y-0.5">
                {{ __('header.join') ?? 'ASÓCIATE' }}
            </a>
            
             <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden text-gray-700 hover:text-[#009688] focus:outline-none p-2 rounded-md hover:bg-gray-50">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 absolute top-full left-0 w-full shadow-lg z-50">
            <a href="{{ route('home') }}" class="block px-6 py-3 border-b border-gray-100 hover:bg-gray-50">{{ __('header.home') }}</a>
            
            <div class="px-6 py-3 border-b border-gray-100">
                <div class="font-bold text-gray-700 mb-2">{{ __('header.about') }}</div>
                <a href="{{ route('about.index') }}" class="block pl-4 py-1 text-gray-600 hover:text-blue-600 text-sm">{{ __('header.about_index') }}</a>
                <a href="{{ route('about.what') }}" class="block pl-4 py-1 text-gray-600 hover:text-blue-600 text-sm">{{ __('header.about_what') }}</a>
                <a href="{{ route('about.who') }}" class="block pl-4 py-1 text-gray-600 hover:text-blue-600 text-sm">{{ __('header.about_who') }}</a>
                <a href="{{ route('about.partners') }}" class="block pl-4 py-1 text-gray-600 hover:text-blue-600 text-sm">{{ __('header.about_partners') }}</a>
            </div>

            <div class="px-6 py-3 border-b border-gray-100">
                <div class="font-bold text-gray-700 mb-2">{{ __('header.services') }}</div>
                <a href="{{ route('services.index') }}" class="block pl-4 py-1 text-gray-600 hover:text-blue-600 text-sm">{{ __('header.services_index') }}</a>
                <a href="{{ route('services.education') }}" class="block pl-4 py-1 text-gray-600 hover:text-blue-600 text-sm">{{ __('header.services_education') }}</a>
                <a href="{{ route('services.intercultural') }}" class="block pl-4 py-1 text-gray-600 hover:text-blue-600 text-sm">{{ __('header.services_intercultural') }}</a>
            </div>

            <div class="px-6 py-3 border-b border-gray-100">
                <div class="font-bold text-gray-700 mb-2">{{ __('header.projects') }}</div>
                <a href="{{ route('projects.index') }}" class="block pl-4 py-1 text-gray-600 hover:text-blue-600 text-sm">{{ __('header.projects_index') }}</a>
                <a href="{{ route('projects.afrikarte') }}" class="block pl-4 py-1 text-gray-600 hover:text-blue-600 text-sm">{{ __('header.projects_afrikarte') }}</a>
                <a href="{{ route('projects.diversity') }}" class="block pl-4 py-1 text-gray-600 hover:text-blue-600 text-sm">{{ __('header.projects_diversity') }}</a>
                <a href="{{ route('projects.equality') }}" class="block pl-4 py-1 text-gray-600 hover:text-blue-600 text-sm">{{ __('header.projects_equality') }}</a>
                <a href="{{ route('projects.new-generation') }}" class="block pl-4 py-1 text-gray-600 hover:text-blue-600 text-sm">{{ __('header.projects_new_generation') }}</a>
            </div>

            <a href="{{ route('contact.index') }}" class="block px-6 py-3 border-b border-gray-100 hover:bg-gray-50">{{ __('header.contact') }}</a>
            
            <div class="p-4 bg-gray-50">
                <a href="{{ route('join.index') }}" class="block w-full text-center bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded shadow-md uppercase">
                    {{ __('header.join') }}
                </a>
            </div>
        </div>
    </header>
    
    <main class="content-justified">
        @yield('content')
    </main>
    
    <footer class="bg-gray-900 text-gray-300 pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <!-- About Section -->
                <div>
                    @if($settings['site_logo'] ?? false)
                        <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'Novisi Elkartea' }}" class="h-12 w-auto object-contain mb-4 brightness-80">
                    @else
                        <h3 class="text-xl font-bold text-white mb-4">{{ $settings['site_name'] ?? 'Novisi Elkartea' }}</h3>
                    @endif
                    <p class="text-sm text-gray-400">
                        {{ __('footer.description') }}
                    </p>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-4">{{ __('footer.contact') }}</h3>
                    <ul class="space-y-2 text-sm">
                        @if($settings['contact_email'] ?? false)
                            <li class="flex items-start">
                                <i class="fas fa-envelope mt-1 mr-3 text-teal-400"></i>
                                <a href="mailto:{{ $settings['contact_email'] }}" class="hover:text-teal-400 transition-colors">{{ $settings['contact_email'] }}</a>
                            </li>
                        @endif
                        
                        @if($settings['contact_phone'] ?? false)
                            <li class="flex items-start">
                                <i class="fas fa-phone mt-1 mr-3 text-teal-400"></i>
                                <a href="tel:{{ $settings['contact_phone'] }}" class="hover:text-teal-400 transition-colors">{{ $settings['contact_phone'] }}</a>
                            </li>
                        @endif
                        
                        @if($settings['contact_address'] ?? false)
                            <li class="flex items-start">
                                <i class="fas fa-map-marker-alt mt-1 mr-3 text-teal-400"></i>
                                <span>{{ $settings['contact_address'] }}</span>
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-4">{{ __('footer.follow_us') }}</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'tiktok', 'pinterest', 'whatsapp', 'telegram', 'snapchat'] as $key)
                            @if(($settings["social_{$key}_active"] ?? false) && ($settings["social_{$key}_url"] ?? '#') !== '#')
                                <a href="{{ $settings["social_{$key}_url"] }}" target="_blank" rel="noopener noreferrer" 
                                   class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-teal-600 transition-colors">
                                    <i class="fab fa-{{ $key === 'twitter' ? 'x-twitter' : ($key === 'linkedin' ? 'linkedin-in' : $key) }}"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 pt-6 text-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'Novisi Elkartea' }}. {{ __('footer.rights') }}</p>
            </div>
        </div>
    </footer>
    
    @yield('scripts')
</body>
</html>