CREATE TABLE IF NOT EXISTS `settings` (
  `key_name` varchar(50) NOT NULL,
  `key_value` text NOT NULL,
  PRIMARY KEY (`key_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `settings` (`key_name`, `key_value`) VALUES
('site_title', 'سامانه آموزشی سکاد'),
('site_desc', 'جزوات و کدهای آموزشی');