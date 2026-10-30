document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.querySelector('.nav-links');
    
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('courseSidebar');

    // باز و بسته کردن منوی بالا در موبایل
    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }

    // باز و بسته کردن سایدبار دروس در موبایل
    if (sidebarToggle && sidebar) {
        // ساخت یک لایه تاریک به صورت پویا
        const backdrop = document.createElement('div');
        backdrop.className = 'sidebar-backdrop';
        document.body.appendChild(backdrop);

        const toggleSidebar = () => {
            sidebar.classList.toggle('active');
            backdrop.classList.toggle('active');
        };

        // با کلیک روی دکمه، سایدبار باز/بسته شود
        sidebarToggle.addEventListener('click', toggleSidebar);
        
        // با کلیک روی لایه تاریک، سایدبار بسته شود
        backdrop.addEventListener('click', toggleSidebar);
    }
        // --- منطق تغییر حالت تاریک و روشن ---
    const themeToggle = document.getElementById('themeToggle');
    
    // تنظیم آیکون اولیه
    if (document.documentElement.getAttribute('data-theme') === 'dark') {
        themeToggle.textContent = '☀️';
    }

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            
            if (currentTheme === 'dark') {
                document.documentElement.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
                themeToggle.textContent = '🌙';
            } else {
                document.documentElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                themeToggle.textContent = '☀️';
            }
        });
    }
        // --- منطق باز و بسته شدن پوشه‌های دروس ---
    window.toggleFolder = function(element) {
        // پیدا کردن لیست محتویات پوشه که بعد از عنوان قرار دارد
        const content = element.nextElementSibling;
        // پیدا کردن فلش
        const arrow = element.querySelector('.folder-arrow');

        if (content.style.display === 'none' || content.style.display === '') {
            content.style.display = 'block';
            arrow.textContent = '▼';
        } else {
            content.style.display = 'none';
            arrow.textContent = '▶';
        }
    };
});