<?php
// public/index.php
$page_title = "صفحه اصلی";
require_once __DIR__ . '/header.php';
?>

<!-- کانتینر اصلی (بدون سایدبار) -->
<div class="main-container" style="justify-content: center; align-items: center; text-align: center;">
    <div class="content-area" style="max-width: 800px; margin-top: 50px;">
        <h1 style="font-size: 2.5rem; margin-bottom: 20px; color: var(--primary-color);">به سامانه آموزشی سکاد خوش آمدید</h1>
        <p style="font-size: 1.2rem; margin-bottom: 40px; color: var(--text-color);">در اینجا می‌توانید به جزوات و کدهای آموزشی دسترسی داشته باشید.</p>
        
        <a href="courses.php" style="display: inline-block; background-color: var(--primary-color); color: white; padding: 15px 40px; border-radius: 8px; text-decoration: none; font-size: 1.2rem; transition: background 0.3s;">
            ورود به دوره‌ها
        </a>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>