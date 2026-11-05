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

    </div> <!-- بسته شدن landing-grid -->

    <!-- فوتر کوچک و لینک گیت‌هاب -->
    <div class="landing-footer">
        <div style="display: flex; justify-content: center; align-items: center; gap: 15px; flex-wrap: wrap;">
            
            <p style="margin: 0;">این سامانه زیرمجموعه‌ای از وب‌سایت <a href="https://secad.ir" target="_blank">SECAD.ir</a> می‌باشد.</p>
            
            <span style="color: var(--border-color);">|</span>
            
            <!-- لینک و آیکون گیت‌هاب -->
            <a href="https://github.com/secad135/tadris-secad-ir/tree/main" target="_blank" rel="noopener noreferrer" style="color: var(--text-color); text-decoration: none; display: inline-flex; align-items: center; gap: 6px; opacity: 0.7; transition: opacity 0.3s;" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0.7">
                <svg height="16" width="16" viewBox="0 0 16 16" fill="currentColor" style="vertical-align: middle;">
                    <path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path>
                </svg>
                مخزن گیت‌هاب
            </a>

        </div>
    </div> <!-- بسته شدن landing-footer -->

</div> <!-- بسته شدن landing-container -->

<?php require_once __DIR__ . '/footer.php'; ?>