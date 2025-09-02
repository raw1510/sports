{{-- <!-- Sidebar -->
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
</aside> --}}


<!-- Sidebar -->
<aside id="sidebar" class="fixed inset-y-0 left-0 z-30 bg-brown-800 text-white transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
    <!-- Header -->
    <div class="p-5 border-b border-brown-700 flex items-center justify-between">
        <h1 class="text-xl font-bold">Para Sports Admin</h1>
        <button id="sidebar-close" class="lg:hidden text-white hover:text-brown-200">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <!-- Nav -->
    <nav class="mt-5">
        <!-- Registrations Dropdown -->
        <div class="relative">
            <button id="registrationDropdownBtn" class="w-full flex items-center px-5 py-3 text-brown-200 hover:bg-brown-700 transition-colors">
                <i class="fas fa-users mr-3"></i>
                <span class="sm:inline text-white flex-1 text-left">Registrations</span>
                <i id="dropdownIcon" class="fas fa-chevron-down ml-2"></i>
            </button>
            <div id="registrationDropdown" class="hidden ml-10 mt-1">
                {{-- <a href="" class="block px-5 py-2 text-sm {{ request()->routeIs('admin.pending') ? 'bg-brown-700 border-l-4 border-amber-500 text-brown-200' : 'text-brown-200 hover:bg-brown-700' }}"> --}}
                <a href="" class="block px-5 py-2 text-sm 'bg-brown-700 border-l-4 border-amber-500 text-brown-200' : 'text-brown-200 hover:bg-brown-700' }}">
                    Pending
                </a>
                <a href="{{ route('admin.registrations') }}" class="block px-5 py-2 text-sm {{ request()->routeIs('admin.registrations') ? 'bg-brown-700 border-l-4 border-amber-500 text-brown-200' : 'text-brown-200 hover:bg-brown-700' }}">
                    Approved
                </a>
            </div>
        </div>

        <!-- Sidebar (existing) -->
        <a href="{{ route('admin.sidebar') }}" class="flex items-center px-5 py-3 {{ request()->routeIs('admin.sidebar') ? 'bg-brown-700 border-l-4 border-amber-500 text-brown-200' : 'text-brown-200 hover:bg-brown-700' }}">
            <i class="fas fa-chart-bar mr-3"></i>
            <span class="sm:inline text-white">SideBar</span>
        </a>
        <a href="{{ route('admin.contact.view') }}" class="flex items-center px-5 py-3 {{ request()->routeIs('admin.contact.view') ? 'bg-brown-700 border-l-4 border-amber-500 text-brown-200' : 'text-brown-200 hover:bg-brown-700' }}">
            <i class="fas fa-chart-bar mr-3"></i>
            <span class="sm:inline text-white">Contact</span>
        </a>
    </nav>

    <!-- Logout Button -->
    <div class="absolute bottom-0 w-full border-t border-brown-700">
    <form id="logoutForm" method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="button" id="logoutBtn" class="w-full flex items-center px-5 py-3 text-brown-200 hover:bg-brown-700 transition-colors">
            <i class="fas fa-sign-out-alt mr-3"></i>
            <span class="sm:inline text-white">Logout</span>
        </button>
    </form>
</div>

<!-- Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const logoutBtn = document.getElementById("logoutBtn");
        const logoutForm = document.getElementById("logoutForm");

        logoutBtn.addEventListener("click", function () {
            if (confirm("Are you sure you want to log out?")) {
                logoutForm.submit();
            }
        });
    });
</script>
</aside>

<!-- Dropdown Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdownBtn = document.getElementById("registrationDropdownBtn");
        const dropdownMenu = document.getElementById("registrationDropdown");
        const dropdownIcon = document.getElementById("dropdownIcon");

        dropdownBtn.addEventListener("click", function () {
            dropdownMenu.classList.toggle("hidden");
            dropdownIcon.classList.toggle("fa-chevron-down");
            dropdownIcon.classList.toggle("fa-chevron-up");
        });
    });
</script>
