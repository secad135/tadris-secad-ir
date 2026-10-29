<?php
// public/course.php

// ۱. بارگذاری نیازمندی‌های پایه (باید در بالاترین خط باشد)
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/functions.php';

$course_slug = $_GET['c'] ?? null;
$lesson_file = $_GET['l'] ?? null;

// ۲. اعتبارسنجی اولیه نام دوره
if (!$course_slug || !is_valid_name($course_slug)) {
    die("دوره یافت نشد.");
}

// ۳. پیدا کردن اطلاعات دوره
$courses = get_all_courses();
$current_course = null;
foreach ($courses as $c) {
    if ($c['slug'] === $course_slug) {
        $current_course = $c;
        break;
    }
}
if (!$current_course) die("دوره یافت نشد.");

// ۴. گرفتن ساختار درختی دروس (این بخش باید قبل از هدر باشد تا منوی موبایل به آن دسترسی داشته باشد)
$structure = get_course_structure($course_slug);
$course_dir = __DIR__ . '/../courses/' . $course_slug . '/';

$content_html = '';
$page_title = $current_course['title'];

// ۵. بررسی اینکه آیا درس خاصی انتخاب شده است یا خیر
if ($lesson_file) {
    if (!is_valid_name($lesson_file)) {
         die("نام درس نامعتبر است.");
    }
    
    $file_path = $course_dir . $lesson_file;
    
    if (is_file($file_path) && realpath($file_path) && strpos(realpath($file_path), realpath($course_dir)) === 0) {
        $markdown = file_get_contents($file_path);
        $content_html = $Parsedown->text($markdown);
    } else {
        $content_html = "<div style='color: red;'>خطا: درس مورد نظر یافت نشد یا دسترسی غیرمجاز است.</div>";
    }
} else {
    // اگر درس خاصی انتخاب نشده، فایل README.md را نشان بده
    $readme_path = $course_dir . 'README.md';
    if (is_file($readme_path)) {
        $content_html = $Parsedown->text(file_get_contents($readme_path));
    } else {
        $content_html = "<h2 style='color: var(--primary-color);'>" . htmlspecialchars($current_course['title']) . "</h2>
                         <p>توضیحات کلی برای این دوره ثبت نشده است. لطفاً از منوی سمت راست یک درس را انتخاب کنید.</p>";
    }
}

// ۶. حالا که تمام اطلاعات آماده است، هدر را فراخوانی می‌کنیم
require_once __DIR__ . '/header.php';
?>

<div class="main-container">
    <!-- سایدبار (فقط در دسکتاپ نمایش داده می‌شود) -->
    <aside class="sidebar" id="courseSidebar">
        <h3 style="margin-bottom: 15px; border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">فهرست دروس</h3>
        <!-- استفاده از تابع برای نمایش درخت دروس -->
        <?= render_lesson_tree($structure, $course_slug, $lesson_file) ?>
    </aside>

    <!-- محتوای اصلی -->
    <main class="content-area">
        <div style="background: var(--card-bg); padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); min-height: 500px; border: 1px solid var(--border-color);">
            <?= $content_html ?>
        </div>
    </main>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>