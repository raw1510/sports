<header class="bg-white shadow sticky top-0 z-50 p-2">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <div class="flex items-center justify-between h-16">
        <!-- Brand -->
        <div class="flex items-center gap-3">
          <!-- Replace with optimized webp/logo svg -->
          <a href="/">
          <img src="{{ asset('images/logo.webp') }}" alt="PCI Logo" class="h-10 md:h-14 lg:h-16 w-auto" decoding="async" loading="lazy">
          </a>

          <div>
            <a href="/" class="md:text-xl text-sm font-semibold text-amber-900 hover:text-amber-800 transition-colors">ParaSports Association of Surat</a>
          </div>
        </div>

        <!-- Desktop nav -->
        <div class="parent-div-navbar md:flex">
                <nav aria-label="Primary" class="hidden lg:flex lg:items-center lg:space-x-6 md:mx-4">
                <!-- Menu items with dropdowns -->
                <a href="/" class="text-amber-700 font-medium hover:text-amber-800 transition-colors">Home</a>

                <div class="relative dropdown" data-dropdown>
                    <a href="#about" class="text-gray-700 hover:text-amber-700 transition-colors">About US</a>
                </div>

                <a href="#gallery" class="text-gray-700 hover:text-amber-700 transition-colors">Gallery</a>
                <a href="#contact" class="text-gray-700 hover:text-amber-700 transition-colors">Contact Us</a>
            </nav>
            <div class="flex items-center gap-3">
            <a href="{{ route('main.register') }}" class="hidden lg:inline-block bg-amber-700 text-white px-4 py-2 rounded-md hover:bg-amber-800 transition-colors shadow-md">Register</a>


            <!-- Mobile toggle -->
            <button id="mobile-toggle" class="lg:hidden p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 text-amber-700 hover:text-amber-800" aria-label="Open menu" aria-controls="mobile-menu" aria-expanded="false">
                <!-- hamburger svg -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            </div>
        </div>

        <!-- Action + Mobile button -->
      </div>

    </div>

    <!-- Mobile menu (single DOM node controlled by JS) -->
    <nav id="mobile-menu" class="lg:hidden fixed inset-x-0 top-16 bg-white border-t shadow-lg opacity-0 pointer-events-none transition-all duration-300 ease-in-out transform -translate-y-2">
            <div class="px-4 pt-4 pb-6">
                <div class="space-y-2">
                    <a href="#" class="block px-3 py-2 text-amber-700 font-medium rounded hover:bg-amber-50 transition-colors">Home</a>

                    <a href="#" class="block px-3 py-2 rounded hover:bg-amber-50 text-gray-700 transition-colors">About US</a>

                    <a href="#" class="block px-3 py-2 rounded hover:bg-amber-50 text-gray-700 transition-colors">Gallery</a>
                    <a href="#" class="block px-3 py-2 rounded hover:bg-amber-50 text-gray-700 transition-colors">Contact Us</a>

                    <a href="#" class="block mt-3 bg-amber-700 text-white text-center px-3 py-2 rounded hover:bg-amber-800 transition-colors shadow-md">Register</a>
                </div>
            </div>
        </nav>

  </header>

  <style>
    /* Custom styles for dropdowns matching brown theme */
    .dropdown-menu { 
      display: none; 
    }
    .dropdown-open > .dropdown-menu { 
      display: block; 
    }
    
    /* Brown theme hover effects */
    .dropdown-menu a:hover {
      background-color: rgb(251 245 232); /* amber-50 */
      color: rgb(146 64 14); /* amber-800 */
    }
    
    /* Focus states for accessibility */
    button:focus,
    a:focus {
      outline: 2px solid rgb(217 119 6); /* amber-600 */
      outline-offset: 2px;
    }
    
    /* Mobile menu show state */
    #mobile-menu.show {
      opacity: 1;
      pointer-events: auto;
      transform: translateY(0);
    }
  </style>


  @vite(['resources/js/navbar.js'])
