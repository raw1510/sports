
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
        <div id="mobile-menu-backdrop" class="fixed inset-0 z-20 bg-black bg-opacity-50 hidden lg:hidden"></div>
        
        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-brown-800 text-white transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
            <div class="p-5 border-b border-brown-700 flex items-center justify-between">
                <h1 class="text-xl font-bold">Para Sports Admin</h1>
                <button id="sidebar-close" class="lg:hidden text-white hover:text-brown-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <nav class="mt-5">
                <a href="#" class="flex items-center px-5 py-3 bg-brown-700 border-l-4 border-amber-500 hover:bg-brown-600">
                    <i class="fas fa-users mr-3"></i> 
                    <span class="hidden sm:inline text-white">Registrations</span>
                </a>
                <a href="#" class="flex items-center px-5 py-3 text-brown-200 hover:bg-brown-700 transition-colors">
                    <i class="fas fa-chart-bar mr-3"></i> 
                    <span class="hidden sm:inline text-white">Reports</span>
                </a>
                <a href="#" class="flex items-center px-5 py-3 text-brown-200 hover:bg-brown-700 transition-colors">
                    <i class="fas fa-cog mr-3"></i> 
                    <span class="hidden sm:inline text-white">Settings</span>
                </a>
            </nav>
        </div>

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
    <div class="px-4 sm:px-6 py-4 border-b border-brown-100 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
        <h3 class="text-lg font-semibold text-brown-800">Registration Details</h3>
        <div class="flex flex-col sm:flex-row sm:items-center gap-3 w-full sm:w-auto">
            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <div class="relative w-full sm:w-auto">
                    <input type="text" placeholder="Search..." class="w-full sm:w-auto pl-10 pr-4 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent text-sm">
                    <i class="fas fa-search absolute left-3 top-3 text-brown-400 text-sm"></i>
                </div>
                <div class="flex flex-wrap gap-2 w-full sm:w-auto">
                    <!-- Disability Category Dropdown -->
                    <select class="w-full sm:w-auto max-w-md pl-3 pr-8 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent bg-white text-sm">
                        <option value="">All Categories</option>
                        @foreach($disability as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>

                    <!-- Games Dropdown -->
                    <select class="w-full sm:w-auto max-w-md pl-3 pr-8 py-2 border border-brown-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent bg-white text-sm">
                        <option value="">All Games</option>
                        @foreach($game as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button class="bg-brown-600 hover:bg-brown-700 text-white px-3 py-2 rounded-lg flex items-center text-sm transition-colors whitespace-nowrap">
                <i class="fas fa-file-export mr-1 sm:mr-2"></i> 
                <span class="text-xs sm:text-sm">Export</span>
            </button>
        </div>
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
                @foreach($registrations as $index => $registration)
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
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="px-4 sm:px-6 py-4 border-t border-brown-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="text-sm text-brown-500">
            Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">142</span> results
        </div>
        <div class="flex space-x-2 justify-center sm:justify-end">
            <button class="px-3 py-1 rounded-md bg-brown-100 text-brown-700 hover:bg-brown-200 transition-colors text-sm">
                Previous
            </button>
            <button class="px-3 py-1 rounded-md bg-brown-600 text-white hover:bg-brown-700 transition-colors text-sm">
                Next
            </button>
        </div>
    </div>
</div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const mobileMenuBackdrop = document.getElementById('mobile-menu-backdrop');
        const sidebarClose = document.getElementById('sidebar-close');

        function openMobileMenu() {
            sidebar.classList.remove('-translate-x-full');
            mobileMenuBackdrop.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeMobileMenu() {
            sidebar.classList.add('-translate-x-full');
            mobileMenuBackdrop.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        mobileMenuToggle.addEventListener('click', openMobileMenu);
        sidebarClose.addEventListener('click', closeMobileMenu);
        mobileMenuBackdrop.addEventListener('click', closeMobileMenu);

        // Close mobile menu on window resize if screen becomes large
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                closeMobileMenu();
            }
        });
    </script>
</body>
</html>
