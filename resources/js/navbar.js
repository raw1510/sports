(function () {
    /* ===== Mobile menu open/close with smooth animation ===== */
    const mobileToggle = document.getElementById('mobile-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    
    mobileToggle.addEventListener('click', () => {
        const expanded = mobileToggle.getAttribute('aria-expanded') === 'true';
        mobileToggle.setAttribute('aria-expanded', String(!expanded));
        
        if (expanded) {
            // Closing animation
            mobileMenu.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            mobileMenu.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
            setTimeout(() => {
                mobileMenu.style.display = 'none';
            }, 300);
        } else {
            // Opening animation
            mobileMenu.style.display = 'block';
            // Force reflow
            mobileMenu.offsetHeight;
            mobileMenu.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-2');
            mobileMenu.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
        }
    });

    // Hide mobile menu by default
    mobileMenu.style.display = 'none';

    /* ===== Mobile nested toggles ===== */
    document.querySelectorAll('[data-mobile-toggle]').forEach(btn => {
        btn.addEventListener('click', () => {
            const list = btn.nextElementSibling;
            const open = !list.classList.contains('hidden');
            const svg = btn.querySelector('svg');
            
            if (open) {
                // Closing
                list.style.maxHeight = list.scrollHeight + 'px';
                setTimeout(() => {
                    list.style.maxHeight = '0';
                    setTimeout(() => {
                        list.classList.add('hidden');
                    }, 200);
                }, 10);
                svg.style.transform = 'rotate(0deg)';
            } else {
                // Opening
                list.classList.remove('hidden');
                list.style.maxHeight = '0';
                setTimeout(() => {
                    list.style.maxHeight = list.scrollHeight + 'px';
                    setTimeout(() => {
                        list.style.maxHeight = '';
                    }, 200);
                }, 10);
                svg.style.transform = 'rotate(180deg)';
            }
        });
    });

    /* ===== Desktop dropdowns ===== */
    document.querySelectorAll('.dropdown').forEach(drop => {
        const btn = drop.querySelector('button');
        const menu = drop.querySelector('.dropdown-menu');

        function open() {
            drop.classList.add('dropdown-open');
            btn.setAttribute('aria-expanded', 'true');
            menu.classList.remove('hidden');
        }
        
        function close() {
            drop.classList.remove('dropdown-open');
            btn.setAttribute('aria-expanded', 'false');
            menu.classList.add('hidden');
        }

        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const isOpen = drop.classList.contains('dropdown-open');
            if (isOpen) close(); else open();
        });

        drop.addEventListener('mouseenter', open);
        drop.addEventListener('mouseleave', close);

        drop.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') close();
        });

        document.addEventListener('click', (e) => {
            if (!drop.contains(e.target)) close();
        });
    });

    /* ===== Resize fix ===== */
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            mobileMenu.style.display = 'none';
            mobileMenu.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
            mobileMenu.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
            mobileToggle.setAttribute('aria-expanded', 'false');
        }
    });
})();
