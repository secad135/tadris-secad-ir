<?php
// public/course.php

$show_sidebar_toggle = true; // <--- این خط را اضافه کنید
require_once __DIR__ . '/header.php';

$course_slug = $_GET['c'] ?? null;
$lesson_file = $_GET['l'] ?? null;

if (!$course_slug || !is_valid_name($course_slug)) {
    die("دوره یافت نشد.");
}

$courses = get_all_courses();
$current_course = null;
foreach ($courses as $c) {
    if ($c['slug'] === $course_slug) {
        $current_course = $c;
        break;
    }
}
if (!$current_course) die("دوره یافت نشد.");

$structure = get_course_structure($course_slug);
$course_dir = __DIR__ . '/../courses/' . $course_slug . '/';

$content_html = '';
$page_title = $current_course['title'];

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
    $readme_path = $course_dir . 'README.md';
    if (is_file($readme_path)) {
        $content_html = $Parsedown->text(file_get_contents($readme_path));
    } else {
        $content_html = "<h2 style='color: var(--primary-color);'>" . htmlspecialchars($current_course['title']) . "</h2>
                         <p>توضیحات کلی برای این دوره ثبت نشده است. لطفاً از منوی سمت راست یک درس را انتخاب کنید.</p>";
    }
}
?>

<div class="main-container">
    <aside class="sidebar" id="courseSidebar">
        <h3 style="margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">فهرست دروس</h3>
        
        <ul style="list-style: none; padding-right: 0;">
            <li style="margin-bottom: 15px;">
                <a href="course.php?c=<?= htmlspecialchars($course_slug) ?>" style="text-decoration: none; color: <?= !$lesson_file ? 'var(--primary-color); font-weight: bold;' : 'var(--text-color);' ?>">
                    📖 معرفی دوره
                </a>
            </li>
            
            <?php foreach($structure as $item): ?>
                <?php if($item['type'] === 'dir'): ?>
                    <li style="margin-bottom: 10px; margin-top: 15px;">
                        <span style="font-weight: bold; color: var(--text-color); display: block; border-bottom: 1px solid #eee; padding-bottom: 5px;">
                            📁 <?= htmlspecialchars($item['name']) ?>
                        </span>
                        <ul style="list-style: none; padding-right: 15px; margin-top: 5px;">
                            <?php foreach($item['files'] as $file): ?>
                                <?php $is_active = ($lesson_file === $file['path']); ?>
                                <li style="margin-bottom: 8px;">
                                    <a href="course.php?c=<?= htmlspecialchars($course_slug) ?>&l=<?= htmlspecialchars($file['path']) ?>" 
                                       style="text-decoration: none; color: <?= $is_active ? 'var(--primary-color); font-weight: bold;' : 'var(--text-color)' ?>; font-size: 0.95rem;">
                                        📄 <?= htmlspecialchars($file['title']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <?php $is_active = ($lesson_file === $item['path']); ?>
                    <li style="margin-bottom: 10px;">
                        <a href="course.php?c=<?= htmlspecialchars($course_slug) ?>&l=<?= htmlspecialchars($item['path']) ?>" 
                           style="text-decoration: none; color: <?= $is_active ? 'var(--primary-color); font-weight: bold;' : 'var(--text-color);' ?>">
                            📄 <?= htmlspecialchars($item['title']) ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </aside>

    <main class="content-area">
        <div style="background: var(--card-bg); padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); min-height: 500px;">
            <?= $content_html ?>
        </div>
    </main>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>