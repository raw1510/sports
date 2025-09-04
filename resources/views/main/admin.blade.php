<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Para Sports Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brown: {
                            50: '#faf6f2',
                            100: '#f3ebe3',
                            200: '#e4d3c3',
                            300: '#d3b79d',
                            400: '#b98e6c',
                            500: '#8b5e34',
                            600: '#734a27',
                            700: '#5a3a20',
                            800: '#422a19',
                            900: '#2d1d12',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen bg-brown-50 text-brown-900">
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile menu backdrop -->        
        <!-- Sidebar -->
        @include('components.admin.navbar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-brown-100">
                <div class="flex justify-between items-center p-4">
                    <div class="flex items-center">
                        <button id="mobile-menu-toggle" class="lg:hidden text-brown-600 hover:text-brown-800 mr-3">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="text-xl font-semibold text-brown-800">Registrations</h2>
                    </div>
                    <div class="flex items-center space-x-2 sm:space-x-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-brown-200 flex items-center justify-center">
                                <i class="fas fa-user text-brown-700"></i>
                            </div>
                            <span class="ml-2 text-brown-700 hidden sm:inline">Admin</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto">
                <!-- Stats Cards -->
                <div class="p-4 sm:p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6">
                        <div class="bg-white rounded-xl shadow p-4 sm:p-6 border border-brown-100">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-amber-100 text-amber-600 flex-shrink-0">
                                    <i class="fas fa-user-plus text-xl"></i>
                                </div>
                                <div class="ml-4 min-w-0">
                                    <h3 class="text-brown-500 text-sm truncate">Total Registrations</h3>
                                    <p class="text-2xl font-bold">142</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow p-4 sm:p-6 border border-brown-100">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-green-100 text-green-600 flex-shrink-0">
                                    <i class="fas fa-check-circle text-xl"></i>
                                </div>
                                <div class="ml-4 min-w-0">
                                    <h3 class="text-brown-500 text-sm truncate">Approved</h3>
                                    <p class="text-2xl font-bold">128</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl shadow p-4 sm:p-6 border border-brown-100 sm:col-span-2 lg:col-span-1">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-blue-100 text-blue-600 flex-shrink-0">
                                    <i class="fas fa-file-medical text-xl"></i>
                                </div>
                                <div class="ml-4 min-w-0">
                                    <h3 class="text-brown-500 text-sm truncate">Documents Pending</h3>
                                    <p class="text-2xl font-bold">14</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Registrations Table -->
                    <div class="bg-white rounded-xl shadow border border-brown-100 overflow-hidden">
                        <div class="px-4 sm:px-6 py-4 border-b border-brown-100">
                            <h3 class="text-lg font-semibold text-brown-800 mb-3">Registration Details</h3>
                            
                            <form method="GET" class="flex flex-col gap-3">
                                <!-- First row: Search and Filters -->
                                <div class="flex flex-col md:flex-row gap-3">
                                    <div class="relative flex-grow">
                                        <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent text-sm">
                                        <i class="fas fa-search absolute left-3 top-3 text-brown-400 text-sm"></i>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row gap-2 flex-shrink-0">
                                        <!-- Disability Category Dropdown -->
                                        <select name="disability_filter" class="w-full sm:w-48 md:w-40 lg:w-48 pl-3 pr-8 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent bg-white text-sm">
                                            <option value="">All Categories</option>
                                            @foreach($disability as $key => $value)
                                                <option value="{{$value}}" {{ request('disability_filter') == $value ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                        </select>

                                        <!-- Games Dropdown -->
                                        <select name="game_filter" class="w-full sm:w-48 md:w-40 lg:w-48 pl-3 pr-8 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent bg-white text-sm">
                                            <option value="">All Games</option>
                                            @foreach($game as $key => $value)
                                                <option value="{{$key}}" {{ request('game_filter') == $key ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Second row: Action Buttons -->
                                <div class="flex flex-wrap gap-2">
                                    <button type="submit" class="bg-brown-600 hover:bg-brown-700 text-white px-4 py-2 rounded-lg flex items-center text-sm transition-colors">
                                        <i class="fas fa-filter mr-2"></i> 
                                        <span>Filter</span>
                                    </button>
                                    <a href="{{ request()->url() }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center text-sm transition-colors">
                                        <i class="fas fa-times mr-2"></i> 
                                        <span>Clear</span>
                                    </a>
                                    <button type="button" onclick="exportToExcel()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center text-sm transition-colors">
                                        <i class="fas fa-file-excel mr-2"></i> 
                                        <span>Excel</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Responsive Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-brown-200">
                                <thead class="bg-brown-50">
                                    <tr>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Name</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Email</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Phone</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Disability Category</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Games</th>
                                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Documents</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-brown-200">
                                    @forelse($registrations as $index => $registration)
                                        <tr class="{{ $index % 2 === 1 ? 'bg-brown-50' : '' }}">
                                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-brown-900">{{ $registration->athlete_name }}</div>
                                            </td>
                                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-brown-500">
                                                {{ $registration->email }}
                                            </td>
                                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-brown-500">
                                                {{ $registration->phone }}
                                            </td>
                                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">
                                                    {{ $registration->disability }}
                                                </span>
                                            </td>
                                            <td class="px-4 sm:px-6 py-4 text-sm text-brown-500">
                                                <div>{{ $registration->games_list }}</div>
                                            </td>
                                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-brown-500">
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach($registration->documents_list as $docUrl)
                                                        <a href="{{ $docUrl }}" target="_blank" class="px-2 py-1 bg-brown-100 rounded text-xs">
                                                            {{ basename($docUrl) }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-4 sm:px-6 py-4 text-center text-sm text-brown-500">
                                                No registrations found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="px-4 sm:px-6 py-4 border-t border-brown-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            {{-- <div class="text-sm text-brown-500">
                                Showing {{ $registrations->firstItem() }} to {{ $registrations->lastItem() }} of {{ $registrations->total() }} results
                            </div> --}}
                            <div>
    @if ($registrations->hasPages())
        <nav class="flex items-center gap-1">
            {{-- Previous --}}
            @if ($registrations->onFirstPage())
                <span class="px-3 py-1 rounded-md bg-brown-100 text-brown-400 text-sm">Previous</span>
            @else
                <a href="{{ $registrations->previousPageUrl() }}" class="px-3 py-1 rounded-md bg-brown-100 text-brown-700 hover:bg-brown-200 text-sm">Previous</a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($registrations->getUrlRange(1, $registrations->lastPage()) as $page => $url)
                @if ($page == $registrations->currentPage())
                    <span class="px-3 py-1 rounded-md bg-brown-600 text-white text-sm">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-3 py-1 rounded-md bg-brown-100 text-brown-700 hover:bg-brown-200 text-sm">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next --}}
            @if ($registrations->hasMorePages())
                <a href="{{ $registrations->nextPageUrl() }}" class="px-3 py-1 rounded-md bg-brown-100 text-brown-700 hover:bg-brown-200 text-sm">Next</a>
            @else
                <span class="px-3 py-1 rounded-md bg-brown-100 text-brown-400 text-sm">Next</span>
            @endif
        </nav>
    @endif
</div>

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function exportToExcel() {
            // Get current URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('export', 'excel');
            
            // Redirect to the same page with export parameter
            window.location.href = window.location.pathname + '?' + urlParams.toString();
        }
        
    
    </script>
    @vite('resources/js/adminnavbar.js')

</body>
</html>