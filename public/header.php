<?php
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/functions.php';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) . ' | ' : '' ?>سامانه آموزشی سکاد</title>

        <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>

    <link rel="stylesheet" href="assets/css/style.css">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-sql.min.js"></script> -->
</head>
<body>

    <!-- نوار بالا -->
            <nav class="navbar">
        <a href="index.php" class="navbar-brand">تدریس سکاد</a>
        
        <div class="navbar-actions">
            <?php if(isset($show_sidebar_toggle) && $show_sidebar_toggle): ?>
                <button class="btn-sidebar-toggle" id="sidebarToggle">☰ دروس</button>
            <?php endif; ?>
            
            <!-- دکمه تغییر پوسته -->
            <button id="themeToggle" class="theme-toggle-btn" title="تغییر حالت تاریک/روشن">🌙</button>

            <!-- دکمه منوی موبایل -->
            <button class="menu-toggle" id="menuToggle">☰</button>
        </div>
        
        <ul class="nav-links">
            <li><a href="index.php">صفحه اصلی</a></li>
            <li><a href="courses.php">دوره‌ها</a></li>
            <li><a href="https://tamrin.secad.ir" target="_blank">تمرینات</a></li>
        </ul>
    </nav>