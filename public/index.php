<?php
// public/index.php
$page_title = "صفحه اصلی";
require_once __DIR__ . '/header.php';
?>

<!-- کانتینر انیمیشن پس‌زمینه -->
<div id="code-background"></div>

<div class="landing-container">
    <div class="landing-grid">
        
        <!-- ستون راست: معرفی و دکمه‌ها -->
        <div class="hero-section">
            <div class="logo-container">
                <img src="assets/images/logo.png" alt="لوگوی سجاد اسماعیلی" class="hero-logo">
            </div>
            
            <h1 class="hero-title">مهندس سجاد اسماعیلی</h1>
            <h2 class="hero-subtitle">
                برنامه‌نویس و توسعه‌دهنده وب اپلیکیشن<br>
                هنرآموز رسمی آموزش و پرورش
            </h2>

            <div class="hero-buttons">
                <a href="courses.php" class="hero-btn primary-btn">📚 ورود به دوره‌ها</a>
                <a href="https://tamrin.secad.ir" target="_blank" class="hero-btn secondary-btn">✏️ بخش تمرینات</a>
                <a href="https://shad.ir/secadir" target="_blank" class="hero-btn outline-btn">💬 ارتباط در شاد</a>
            </div>
        </div>

        <!-- ستون چپ: کارت‌های ویژگی -->
        <div class="features-section">
            <div class="feature-card">
                <div class="feature-icon">📄</div>
                <div>
                    <h3>جزوات درسی</h3>
                    <p>دسترسی به جزوات و سرفصل‌های درسی به صورت مرتب و دسته‌بندی شده.</p>
                </div>
            </div>

            <div class="feature-card">
                <div class="feature-icon">💻</div>
                <div>
                    <h3>کدهای آموزشی</h3>
                    <p>نمونه کدهای تمیز و کاربردی برای یادگیری بهتر مباحث برنامه‌نویسی.</p>
                </div>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🎯</div>
                <div>
                    <h3>آزمون و تمرین</h3>
                    <p>سنجش یادگیری با تمرین‌های عملی در سامانه اختصاصی تمرینات.</p>
                </div>
            </div>
        </div>

    </div>

    <!-- فوتر کوچک -->
    <div class="landing-footer">
        <p>این سامانه زیرمجموعه‌ای از وب‌سایت <a href="https://secad.ir" target="_blank">SECAD.ir</a> می‌باشد.</p>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>