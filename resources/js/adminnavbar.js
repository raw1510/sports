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



