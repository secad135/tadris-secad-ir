<?php
// app/bootstrap.php

// شروع سشن‌ها (برای آینده)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// بارگذاری تنظیمات
$config_path = __DIR__ . '/../config/config.php';
if (file_exists($config_path)) {
    $config = require $config_path;
} else {
    die("فایل تنظیمات (config.php) یافت نشد. لطفا فایل example را کپی کنید.");
}

// بارگذاری کتابخانه پارس داون
require_once __DIR__ . '/lib/Parsedown.php';
$Parsedown = new Parsedown();
$Parsedown->setSafeMode(true); // جلوگیری از حملات XSS در مارک‌داون

// تنظیم منطقه زمانی
date_default_timezone_set('Asia/Tehran');
?>