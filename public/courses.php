<?php
// public/courses.php
$page_title = "لیست دوره‌ها";
require_once 'header.php';

$courses = get_all_courses();
?>

<div class="main-container" style="justify-content: center;">
    <div class="content-area">
        <h2 style="margin-bottom: 30px; color: var(--text-color);">دوره‌های آموزشی</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
            <?php if(empty($courses)): ?>
                <p>هنوز دوره‌ای ثبت نشده است.</p>
            <?php else: ?>
                <?php foreach($courses as $course): ?>
                    <div style="background: var(--card-bg); padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <a href="course.php?c=<?= htmlspecialchars($course['slug']) ?>" style="display: inline-block; background: var(--bg-color); color: var(--text-color); padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 0.9rem;">
                        <h3 style="color: var(--primary-color); margin-bottom: 10px;"><?= htmlspecialchars($course['title'] ?? $course['slug']) ?></h3>
                        </a>
                        <p style="font-size: 0.9rem; color: var(--text-color); margin-bottom: 15px;"><?= htmlspecialchars($course['description'] ?? '') ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>