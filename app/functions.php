<?php
// app/functions.php

/**
 * اسکن پوشه courses و برگرداندن لیست دوره‌ها
 */
function get_all_courses() {
    $courses_dir = __DIR__ . '/../courses/';
    $courses = [];
    
    if (!is_dir($courses_dir)) return $courses;

    $dirs = array_diff(scandir($courses_dir), ['.', '..']);
    foreach ($dirs as $dir) {
        $meta_file = $courses_dir . $dir . '/meta.json';
        if (is_file($meta_file)) {
            $meta = json_decode(file_get_contents($meta_file), true);
            if ($meta) {
                $meta['slug'] = $dir; 
                $courses[] = $meta;
            }
        }
    }
    return $courses;
}

/**
 * اعتبارسنجی نام پوشه و فایل (نسخه منعطف و امن)
 */
function is_valid_name($name) {
    if (strpos($name, '..') !== false) return false;
    if (preg_match('/[\x00-\x1F\x7F]/', $name)) return false;
    if (strpos($name, '\\') !== false) return false;
    if (strpos($name, '/') === 0) return false;
    return true;
}

/**
 * استخراج تیتر اول (H1) از فایل مارک‌داون
 */
function extract_md_title($file_path) {
    if (!is_readable($file_path)) return '';
    
    $fp = fopen($file_path, 'r');
    $title = '';
    $lines_to_read = 10; 
    
    while (($line = fgets($fp)) !== false && $lines_to_read > 0) {
        $line = trim($line);
        if (strpos($line, '# ') === 0) {
            $title = trim(substr($line, 2));
            break;
        } 
        elseif (strpos($line, '## ') === 0 && empty($title)) {
            $title = trim(substr($line, 3));
        }
        $lines_to_read--;
    }
    fclose($fp);
    return $title;
}

/**
 * گرفتن ساختار درختی دروس (پوشه‌ها و فایل‌های مارک‌داون)
 */
function get_course_structure($course_slug) {
    if (!is_valid_name($course_slug)) return [];
    
    $course_dir = __DIR__ . '/../courses/' . $course_slug . '/';
    if (!is_dir($course_dir)) return [];

    $structure = [];
    $items = array_diff(scandir($course_dir), ['.', '..']);

    foreach ($items as $item) {
        $path = $course_dir . $item;
        
        // اگر یک پوشه بود (فصل)
        if (is_dir($path)) {
            // بررسی وجود فایل meta.json داخل پوشه
            $dir_title = $item; // پیش‌فرض: نام پوشه
            $dir_meta_file = $path . '/meta.json';
            if (is_file($dir_meta_file)) {
                $dir_meta = json_decode(file_get_contents($dir_meta_file), true);
                if ($dir_meta && isset($dir_meta['title'])) {
                    $dir_title = $dir_meta['title'];
                }
            }

            $files = array_diff(scandir($path), ['.', '..']);
            $md_files = [];
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'md') {
                    $file_path = $path . '/' . $file;
                    $title = extract_md_title($file_path);
                    
                    $md_files[] = [
                        'name' => $file,
                        'title' => $title ?: pathinfo($file, PATHINFO_FILENAME),
                        'path' => $item . '/' . $file 
                    ];
                }
            }
            if (!empty($md_files)) {
                $structure[] = [
                    'type' => 'dir',
                    'name' => $item,
                    'display_name' => $dir_title, // ذخیره نام نمایشی
                    'files' => $md_files
                ];
            }
        } 
        // اگر خودش یک فایل مارک‌داون در روت دوره بود
        elseif (pathinfo($item, PATHINFO_EXTENSION) === 'md' && strtolower($item) !== 'readme.md') {
            $title = extract_md_title($path);
            $structure[] = [
                'type' => 'file',
                'name' => $item,
                'title' => $title ?: pathinfo($item, PATHINFO_FILENAME),
                'path' => $item
            ];
        }
    }
    return $structure;
}

/**
 * تولید کدهای HTML برای نمایش درخت دروس
 */
/**
 * تولید کدهای HTML برای نمایش درخت دروس
 */
function render_lesson_tree($structure, $course_slug, $lesson_file) {
    ob_start();
    ?>
    <ul style="list-style: none; padding-right: 0; text-align: right; width: 100%;">
        <li style="margin-bottom: 15px;">
            <a href="course.php?c=<?= htmlspecialchars($course_slug) ?>" style="text-decoration: none; display: block; padding: 5px 0; color: <?= !$lesson_file ? 'var(--primary-color); font-weight: bold;' : 'var(--text-color);' ?>">
                📖 معرفی دوره
            </a>
        </li>
        
        <?php foreach($structure as $item): ?>
            <?php if($item['type'] === 'dir'): ?>
                <?php 
                    // بررسی اینکه آیا درس فعلی داخل این پوشه قرار دارد یا خیر
                    $is_folder_active = ($lesson_file && strpos($lesson_file, $item['name'] . '/') === 0);
                ?>
                <li style="margin-bottom: 10px; margin-top: 15px;">
                    <!-- عنوان پوشه (کلیک‌پذیر) -->
                    <div class="folder-header" onclick="toggleFolder(this)">
                        <span class="folder-arrow"><?= $is_folder_active ? '▼' : '▶' ?></span>
                        📁 <?= htmlspecialchars($item['display_name'] ?? $item['name']) ?>
                    </div>
                    
                    <!-- محتویات پوشه -->
                    <ul class="folder-content" style="list-style: none; padding-right: 15px; margin-top: 5px; display: <?= $is_folder_active ? 'block' : 'none' ?>;">
                        <?php foreach($item['files'] as $file): ?>
                            <?php $is_active = ($lesson_file === $file['path']); ?>
                            <li style="margin-bottom: 8px;">
                                <a href="course.php?c=<?= htmlspecialchars($course_slug) ?>&l=<?= htmlspecialchars($file['path']) ?>" 
                                   style="text-decoration: none; display: block; padding: 5px 0; color: <?= $is_active ? 'var(--primary-color); font-weight: bold;' : 'var(--text-color)' ?>; font-size: 0.95rem;">
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
                       style="text-decoration: none; display: block; padding: 5px 0; color: <?= $is_active ? 'var(--primary-color); font-weight: bold;' : 'var(--text-color);' ?>">
                        📄 <?= htmlspecialchars($item['title']) ?>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <?php
    return ob_get_clean();
}
?>