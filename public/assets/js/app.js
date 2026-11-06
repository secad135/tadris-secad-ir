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

    // Keep the desktop reading preference across lessons; mobile uses the navbar list.
    if (sidebarToggle && sidebar) {
        const preferenceKey = 'courseSidebarCollapsed';
        const setSidebarCollapsed = (collapsed) => {
            sidebar.hidden = collapsed;
            sidebarToggle.setAttribute('aria-expanded', String(!collapsed));
            sidebarToggle.querySelector('span').textContent = collapsed
                ? 'نمایش فهرست دروس'
                : 'پنهان کردن فهرست دروس';
        };

        let collapsed = false;
        try {
            collapsed = localStorage.getItem(preferenceKey) === 'true';
        } catch (error) {
            // The toggle still works when browser storage is unavailable.
        }
        setSidebarCollapsed(collapsed);
        sidebarToggle.hidden = false;
        sidebarToggle.addEventListener('click', () => {
            setSidebarCollapsed(!sidebar.hidden);
            try {
                localStorage.setItem(preferenceKey, String(sidebar.hidden));
            } catch (error) {
                // Saving the preference is optional.
            }
        });
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
    // Keep the original text intact: highlighting and line numbers are presentation only.
    document.querySelectorAll('.content-area pre > code').forEach((code) => {
        const pre = code.parentElement;
        const source = code.textContent;
        const languageClass = [...code.classList].find(name => name.startsWith('language-'));
        const declaredLanguage = languageClass ? languageClass.slice(9).toLowerCase() : 'text';
        const language = declaredLanguage === 'apache' ? 'apacheconf' : declaredLanguage;
        if (language !== declaredLanguage) {
            code.classList.replace(languageClass, 'language-' + language);
        }
        const labels = { php: 'PHP', html: 'HTML', markup: 'HTML', xml: 'XML',
            javascript: 'JavaScript', js: 'JavaScript', css: 'CSS', sql: 'SQL',
            apacheconf: 'Apache', json: 'JSON', bash: 'Bash', shell: 'Shell', text: 'Plain Text', plaintext: 'Plain Text' };
        const frame = document.createElement('div');
        frame.className = 'code-viewer';
        const toolbar = document.createElement('div');
        toolbar.className = 'code-toolbar';
        const label = document.createElement('span');
        label.className = 'code-language';
        label.textContent = labels[language] || language.toUpperCase();
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'copy-code-btn';
        btn.textContent = 'کپی کد';
        btn.setAttribute('aria-label', 'کپی کد');
        btn.setAttribute('aria-live', 'polite');
        toolbar.append(label, btn);
        pre.before(frame);
        frame.append(toolbar, pre);
        pre.tabIndex = 0;
        pre.setAttribute('aria-label', 'کد ' + label.textContent);

        if (window.Prism && Prism.languages[language]) {
            Prism.highlightElement(code);
        }

        // A separate gutter preserves multiline tokens and excludes numbers from copying.
        const gutter = document.createElement('span');
        gutter.className = 'code-line-numbers';
        gutter.setAttribute('aria-hidden', 'true');
        const count = Math.max(1, source.replace(/\r\n?/g, '\n').replace(/\n$/, '').split('\n').length);
        for (let line = 1; line <= count; line++) {
            const number = document.createElement('span');
            number.textContent = line;
            gutter.appendChild(number);
        }
        pre.prepend(gutter);

        btn.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(source);
                btn.textContent = 'کپی شد!';
                btn.classList.add('copied');
            } catch (error) {
                btn.textContent = 'کپی نشد؛ دوباره تلاش کنید';
            }
            clearTimeout(btn.resetTimer);
            btn.resetTimer = setTimeout(() => {
                btn.textContent = 'کپی کد';
                btn.classList.remove('copied');
            }, 2500);
        });
    });
        // --- انیمیشن پس‌زمینه کدنویسی ---
    const bgContainer = document.getElementById('code-background');
    if (bgContainer) {
        const symbols = ['php?>', '</>', 'echo', 'while', 'if', 'array', 'and', '$', '++', 'or', 'function'];
        const numSymbols = 10; // تعداد نمادها در پس‌زمینه

        for (let i = 0; i < numSymbols; i++) {
            const span = document.createElement('span');
            span.className = 'code-symbol';
            // انتخاب یک نماد تصادفی
            span.innerText = symbols[Math.floor(Math.random() * symbols.length)];
            
            // موقعیت افقی تصادفی
            span.style.left = Math.random() * 100 + '%';
            
            // اندازه فونت تصادفی (بین 20 تا 50 پیکسل)
            span.style.fontSize = (Math.random() * 30 + 20) + 'px';
            
            // سرعت انیمیشن تصادفی (بین 15 تا 40 ثانیه)
            span.style.animationDuration = (Math.random() * 25 + 15) + 's';
            
            // تاخیر اولیه تصادفی برای اینکه همه با هم شروع نشوند
            span.style.animationDelay = '-' + (Math.random() * 20) + 's';
            
            bgContainer.appendChild(span);
        }
    }
});
