<!-- Sidebar -->
<aside id="sidebar" class="fixed inset-y-0 left-0 z-30 bg-brown-800 text-white transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
    <div class="p-5 border-b border-brown-700 flex items-center justify-between">
        <h1 class="text-xl font-bold">Para Sports Admin</h1>
        <button id="sidebar-close" class="lg:hidden text-white hover:text-brown-200">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>
    <nav class="mt-5">
        <a href="{{ route('admin.registrations') }}" class="flex items-center px-5 py-3 {{ request()->routeIs('admin.registrations') ? 'bg-brown-700 border-l-4 border-amber-500 text-brown-200 hover:bg-brown-700' : 'text-brown-200 hover:bg-brown-700' }}">

            <i class="fas fa-users mr-3"></i> 
            <span class=" sm:inline text-white">Registrations</span>
        </a>
        <a href="{{ route('admin.sidebar') }}" class="flex items-center px-5 py-3 text-brown-200 hover:bg-brown-700 transition-colors {{ request()->routeIs('admin.sidebar') ? 'bg-brown-700 border-l-4 border-amber-500 text-brown-200 hover:bg-brown-700' : 'text-brown-200 hover:bg-brown-700' }}">

            <i class="fas fa-chart-bar mr-3"></i> 
            <span class=" sm:inline text-white ">SideBar</span>   
        </a>
        
    </nav>
</aside>