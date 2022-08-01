-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `uczvcekptd`;
CREATE DATABASE `uczvcekptd` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `uczvcekptd`;

DROP TABLE IF EXISTS `accounting`;
CREATE TABLE `accounting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pay_status` int(1) NOT NULL DEFAULT '0' COMMENT '0: Open , 1: Paid',
  `pay_date` varchar(255) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `fasi_id` int(11) DEFAULT NULL,
  `fasi_name` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `history_type` int(1) NOT NULL DEFAULT '0' COMMENT '0: training, 1: exam',
  `history_title` varchar(255) DEFAULT NULL,
  `history_id` int(10) unsigned NOT NULL,
  `amount` float(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `eid` (`user_id`) USING BTREE,
  KEY `examid` (`history_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `activity_type` varchar(35) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity_message` text,
  `is_read` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_title` varchar(255) NOT NULL,
  `article_link` text NOT NULL,
  `article_desc` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `added_by` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `property` varchar(100) DEFAULT NULL,
  `name` varchar(70) DEFAULT NULL,
  `html` text,
  `used_count` int(11) DEFAULT '0',
  `is_active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `block_category`;
CREATE TABLE `block_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `book_shop`;
CREATE TABLE `book_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `library_id` int(11) NOT NULL,
  `title` varchar(1024) DEFAULT NULL,
  `price` float(11,2) DEFAULT NULL,
  `description` text,
  `assign_user` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `picture1` varchar(255) DEFAULT NULL,
  `picture2` varchar(255) DEFAULT NULL,
  `picture3` varchar(255) DEFAULT NULL,
  `picture4` varchar(255) DEFAULT NULL,
  `picture5` varchar(255) DEFAULT NULL,
  `wcm_pt_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `book_shop_orders`;
CREATE TABLE `book_shop_orders` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_method_title` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `date_paid` varchar(255) NOT NULL,
  `date_paid_gmt` varchar(255) NOT NULL,
  `date_completed` varchar(255) NOT NULL,
  `date_completed_gmt` varchar(255) NOT NULL,
  `cart_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `wcm_cat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `category_standard`;
CREATE TABLE `category_standard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `certification`;
CREATE TABLE `certification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `title` varchar(1024) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `chapter`;
CREATE TABLE `chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `title` varchar(1024) DEFAULT NULL,
  `description` text,
  `library_id` int(11) DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `position` int(11) DEFAULT NULL,
  `is_done` enum('0','1') NOT NULL,
  `exam_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `page_type` int(11) DEFAULT NULL,
  `relative_page_id` int(11) DEFAULT NULL,
  `attempt_num` int(11) DEFAULT NULL,
  `exam_max_num` int(11) DEFAULT NULL,
  `session_dateTime` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `chapter_live`;
CREATE TABLE `chapter_live` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `title` varchar(1024) DEFAULT NULL,
  `description` text,
  `library_id` int(11) DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `position` int(11) DEFAULT NULL,
  `is_done` enum('0','1') NOT NULL,
  `exam_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `chapter_num`;
CREATE TABLE `chapter_num` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `chapter_training`;
CREATE TABLE `chapter_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `title` varchar(1024) DEFAULT NULL,
  `description` text,
  `library_id` int(11) DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `position` int(11) DEFAULT NULL,
  `is_done` enum('0','1') NOT NULL,
  `exam_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `chat_rooms_details`;
CREATE TABLE `chat_rooms_details` (
  `crid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `room_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `learner_ids` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`crid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `state_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) DEFAULT NULL,
  `paypal_client_id` varchar(255) DEFAULT NULL,
  `discount` int(2) DEFAULT '0',
  `paypal_secret_id` varchar(255) DEFAULT NULL,
  `stripe_client_id` varchar(255) DEFAULT NULL,
  `stripe_secret_id` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `company_user`;
CREATE TABLE `company_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `role` enum('Instructor','Learner') NOT NULL DEFAULT 'Learner',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `reg_date` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_type` tinyint(1) DEFAULT NULL,
  `course_self_time` varchar(50) DEFAULT NULL,
  `access_restrict` tinyint(4) NOT NULL,
  `limit_time` int(11) DEFAULT NULL,
  `pay_type` tinyint(1) DEFAULT NULL,
  `pay_price` float(11,0) DEFAULT NULL,
  `show_user` tinyint(1) DEFAULT NULL,
  `pass_mark` int(11) DEFAULT NULL,
  `number_of_participants` int(11) NOT NULL DEFAULT '0',
  `is_ass_end` tinyint(4) DEFAULT NULL,
  `is_cron` int(11) NOT NULL DEFAULT '0',
  `assesment_end_course_date` date DEFAULT NULL,
  `instructors` varchar(1024) DEFAULT NULL,
  `enroll_users` varchar(1024) DEFAULT NULL,
  `title` varchar(1024) DEFAULT NULL,
  `subtitle` varchar(1024) DEFAULT NULL,
  `about` text,
  `prerequisite` text,
  `learning_objective` text,
  `objective_img` varchar(255) DEFAULT NULL,
  `attend` text,
  `attend_img` varchar(255) DEFAULT NULL,
  `agenda` text,
  `agenda_img` varchar(255) DEFAULT NULL,
  `create_id` int(11) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `start_at` date DEFAULT NULL,
  `end_at` date DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `course_type` tinyint(1) DEFAULT '0' COMMENT '0:ILT,1:VILT,2:demand',
  `standard_id` int(11) DEFAULT NULL,
  `wcm_pt_id` int(11) DEFAULT NULL,
  `tax_type` tinyint(1) DEFAULT '0' COMMENT '1: fixed tax; 0: percent tax',
  `tax_rate` int(11) DEFAULT '0',
  `discount` int(2) DEFAULT '0',
  `amount` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `course_assessment`;
CREATE TABLE `course_assessment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `page_type` int(11) DEFAULT NULL,
  `assessment` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reg_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `course_history`;
CREATE TABLE `course_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT '0',
  `chapter_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `course_instructor`;
CREATE TABLE `course_instructor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `course_session`;
CREATE TABLE `course_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `course_time` int(11) DEFAULT '0',
  `reg_date` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `course_status`;
CREATE TABLE `course_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `reg_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `end_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `enrollments`;
CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `course_time_id` int(11) DEFAULT NULL,
  `course_title` varchar(100) DEFAULT NULL,
  `create_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `evening_wrk_excercise`;
CREATE TABLE `evening_wrk_excercise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `session` varchar(255) DEFAULT NULL,
  `evening_work` varchar(255) DEFAULT NULL,
  `excercise` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `document2` varchar(255) DEFAULT NULL,
  `document3` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `exam`;
CREATE TABLE `exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1024) DEFAULT NULL,
  `description` text,
  `instruction` text,
  `limit_time` int(11) DEFAULT NULL,
  `min_percent` float(11,2) DEFAULT NULL,
  `certificate_id` int(11) DEFAULT NULL,
  `marker1_id` int(11) DEFAULT NULL,
  `marker2_id` int(11) DEFAULT NULL,
  `observer_id` int(11) DEFAULT NULL,
  `type` enum('Manual','Auto') DEFAULT 'Auto',
  `solution_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:show answer, 1:non',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `create_id` int(11) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `exam_feedback`;
CREATE TABLE `exam_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `answer1` text,
  `answer2` text,
  `answer3` text,
  `answer4` text,
  `answer5` text,
  `answer6` text,
  `answer7_content` text,
  `answer7_method` text,
  `answer7_material` text,
  `answer7_trainer1` text,
  `answer7_trainer2` text,
  `answer7_organ` text,
  `answer7_facilities` text,
  `answer7_com` text,
  `answer8` text,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `exam_history`;
CREATE TABLE `exam_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_start_at` datetime DEFAULT NULL,
  `exam_end_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `exam_status` enum('Not Determine','Fail','Pass','Certification') NOT NULL DEFAULT 'Not Determine',
  `cert_created_at` datetime DEFAULT NULL,
  `mark` float(11,0) NOT NULL DEFAULT '0',
  `certificate_id` int(11) DEFAULT NULL,
  `sign` text,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `exam_quiz`;
CREATE TABLE `exam_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) DEFAULT NULL,
  `type` enum('multi-choice','checkbox','true-false','fill-blank','matching','essay') DEFAULT NULL,
  `ques_title` text,
  `content` text,
  `ques_file` varchar(1024) DEFAULT NULL,
  `feedback` varchar(1024) DEFAULT NULL,
  `radio_imag_type` tinyint(1) DEFAULT NULL,
  `position` int(5) NOT NULL DEFAULT '1',
  `updated_at` datetime DEFAULT NULL,
  `tags` varchar(1024) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `quiz_code` varchar(255) DEFAULT NULL,
  `pass_mark` int(5) DEFAULT '0',
  `max_mark` int(5) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `exam_quiz_group`;
CREATE TABLE `exam_quiz_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `quiz_ids` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `exam_quiz_history`;
CREATE TABLE `exam_quiz_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `mark1` float NOT NULL DEFAULT '0',
  `mark2` float NOT NULL DEFAULT '0',
  `group_id` int(11) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `feedback_message`;
CREATE TABLE `feedback_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `priority` int(2) NOT NULL DEFAULT '0',
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '1: read, 0: unread',
  `message_id` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `highlight`;
CREATE TABLE `highlight` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `content` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `inbox`;
CREATE TABLE `inbox` (
  `id` int(11) DEFAULT NULL,
  `from_user` int(11) DEFAULT NULL,
  `to_user` int(11) DEFAULT NULL,
  `message` text,
  `from_role` varchar(255) DEFAULT NULL,
  `to_role` varchar(255) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `read_flag` tinyint(1) DEFAULT NULL,
  `title` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `instructor_uploads`;
CREATE TABLE `instructor_uploads` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `instructor_email` varchar(255) NOT NULL,
  `learner_email` text NOT NULL,
  `filename` text NOT NULL,
  `filelocation` text NOT NULL,
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `invite_user`;
CREATE TABLE `invite_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `course_type` int(1) DEFAULT NULL COMMENT '0:demand course, 1:training course,2:virtual course',
  `course_id` int(11) DEFAULT NULL,
  `virtual_course_time_id` int(11) DEFAULT NULL,
  `ilt_course_time_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `library`;
CREATE TABLE `library` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_shopping` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `assign_user` varchar(254) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `manual` longtext,
  `manual_type` int(11) DEFAULT NULL,
  `create_id` int(11) DEFAULT NULL,
  `manual_html_path` varchar(255) DEFAULT NULL,
  `print_permission` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `my_books`;
CREATE TABLE `my_books` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `bookshop_id` int(11) NOT NULL DEFAULT '0',
  `reg_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `order_id` int(11) NOT NULL,
  `w_prod_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`bookshop_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notification_type` varchar(30) NOT NULL,
  `from_user_id` int(10) unsigned NOT NULL,
  `to_user_id` int(10) unsigned NOT NULL,
  `notification_title` varchar(50) NOT NULL,
  `notification_message` text,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`from_user_id`,`to_user_id`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `user_id` (`from_user_id`) USING BTREE,
  KEY `to_user_id` (`to_user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;


DROP TABLE IF EXISTS `payment_history`;
CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `amount` float(11,2) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `pay_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text,
  `company_id` int(11) NOT NULL,
  `object_type` enum('training','live','book','course','plan') DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL,
  `tax_rate` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL,
  `tax_type` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `plan`;
CREATE TABLE `plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_limit` int(11) NOT NULL,
  `library_limit` int(11) NOT NULL,
  `demand_limit` int(11) NOT NULL,
  `vilt_user_limit` int(11) NOT NULL,
  `vilt_room_limit` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `term_type` int(1) NOT NULL DEFAULT '0' COMMENT '0:month,1:year',
  `price_type` int(1) NOT NULL DEFAULT '0' COMMENT '0:NO FREE,1:FREE,2:no limit of counts',
  `ilt_user_limit` int(11) DEFAULT '0',
  `ilt_room_limit` int(11) DEFAULT '0',
  `duration` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `prerequisitehighlight`;
CREATE TABLE `prerequisitehighlight` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `content` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `settings_email_template`;
CREATE TABLE `settings_email_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `action` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `settings_email_template` (`id`, `subject`, `message`, `action`, `company_id`) VALUES
(4, 'Notice', '<html><div class=\"sortable-row active\"><div class=\"sortable-row-container\"><div class=\"sortable-row-actions\"><div class=\"row-move row-action\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\"><table style=\"border: 4px solid rgb(143, 108, 251); width: 600px;\" class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"padding\" data-mce-style=\"width: 600px;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(79, 89, 227); padding: 10px 50px; border-collapse: collapse;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Hi {USERNAME} thanks for registering to {COURSE_NAME}.This will be another of our out of body training experience from Quality Circle’s LMS, </span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">GoSmart Academy. <o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Have fun learning.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">From our Happy team to you.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Admin<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpFirst\"></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{LOGO}</span><o:p></o:p></span></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div></html>', 'notice_date',  1),
(5, 'Welcome To GoSmart. Thanks for enrolling.',  '<html><div class=\"sortable-row active\"><div class=\"sortable-row-container\"><div class=\"sortable-row-actions\"><div class=\"row-move row-action\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\"><table class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"padding\" data-mce-style=\"width: 600px;\" style=\"border-spacing: 0px; border-collapse: collapse;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(0, 225, 255); padding: 10px 50px; border-collapse: collapse;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-selected=\"1\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoListParagraphCxSpFirst\"><span data-mce-style=\"color: #000000;\" lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\">Hi {USERNAME},&nbsp; </span></p><p class=\"MsoListParagraphCxSpFirst\"><span data-mce-style=\"color: #000000;\" lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\">Thanks for registering to our training course, on our online platform GoSmart Academy. </span></p><p class=\"MsoListParagraphCxSpFirst\"><span data-mce-style=\"color: #000000;\" lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\">Quality Circle\'s LMS.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span data-mce-style=\"color: #000000;\" lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\"><span style=\"background-color: rgb(255, 255, 0);\" data-mce-style=\"background-color: #ffff00;\">Please&nbsp;<span data-mce-style=\"color: #ff0000;\" style=\"color: rgb(255, 0, 0);\">ENROLL</span>&nbsp;,&nbsp;<span style=\"color: rgb(255, 0, 0);\" data-mce-style=\"color: #ff0000;\">Sign Up&nbsp;</span></span> then&nbsp;<span style=\"color: rgb(255, 0, 0); background-color: rgb(255, 255, 0);\" data-mce-style=\"color: #ff0000; background-color: #ffff00;\">Sign In&nbsp;</span>to access the training.</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">Each session can be downloaded to your drive for use during the training as a soft copy or hardcopy.&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">You need to bring a copy of the standard to this training and have access to the internet a computer or tablet to participae in the training.</span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">Have fun learning.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">From our Happy team to you.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">&nbsp;</span><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">Admin<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: left;\">http://qualitycircleint.com</span></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; color: rgb(0, 0, 0); font-size: medium; font-family: Calibri, sans-serif; caret-color: rgb(0, 0, 0); text-align: justify;\"><o:p></o:p></p><p class=\"MsoNormal\" data-mce-style=\"margin: 0in 0in 0.0001pt; font-size: medium; font-family: Calibri, sans-serif; caret-color: #000000; color: #000000; text-align: justify;\" style=\"margin: 0in 0in 0.0001pt; color: rgb(0, 0, 0); font-size: medium; font-family: Calibri, sans-serif; caret-color: rgb(0, 0, 0); text-align: justify;\">Our Training Division GoSmart Academy is managed through a State of The Art Cloud Based, Learning Management System(LMS) which enables effective remote communication of digital content, delivery options, record keeping and post training support. We offer multiple presentation options to best fit each of our clients specific need. Our channels of delivery includes Open-Enrollment, Virtual Instructor Led Training (VILT) along with Branded Customized on-line single user and on-site presenter led solutions.<o:p></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; color: rgb(0, 0, 0); font-size: medium; font-family: Calibri, sans-serif; caret-color: rgb(0, 0, 0); text-align: start;\"><br data-mce-bogus=\"1\"></p><p class=\"MsoListParagraphCxSpMiddle\"><span style=\"background-color: rgb(255, 255, 0); color: rgb(255, 0, 0);\" data-mce-style=\"background-color: #ffff00; color: #ff0000;\"><span style=\"caret-color: rgb(0, 0, 0); font-family: Calibri, sans-serif; font-size: medium; text-align: start; background-color: rgb(255, 255, 0);\" data-mce-style=\"caret-color: #000000; font-family: Calibri, sans-serif; font-size: medium; text-align: start; background-color: #ffff00;\">&nbsp;</span><span style=\"font-size: 1rem; text-align: left; background-color: rgb(255, 255, 0);\" data-mce-style=\"font-size: 1rem; text-align: left; background-color: #ffff00;\">Partner with us. From Concept to Conclusion we have the power to help you GROW.</span></span></p><p><span style=\"color: rgb(0, 0, 0); font-size: 1rem; text-align: left;\"><br></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span data-mce-style=\"color: #000000;\" lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\">Admin<o:p></o:p></span></p><p></p><p class=\"MsoListParagraphCxSpLast\"><span data-mce-style=\"color: #000000;\" lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\">{LOGO}</span></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\"> </div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\"> </div></html>',  'welcome_email',  1),
(6, 'You have been invited to this course by GoSmart Academy',  '<html><div class=\"sortable-row active\" bis_skin_checked=\"1\"><div class=\"sortable-row-container\" bis_skin_checked=\"1\"><div class=\"sortable-row-actions\" bis_skin_checked=\"1\"><div class=\"row-move row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\" bis_skin_checked=\"1\"><table class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"bg-general\" data-mce-style=\"width: 600px;\" style=\"border-spacing: 0px; border-collapse: collapse;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(0, 230, 255); padding: 10px 50px; border-collapse: collapse;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-selected=\"1\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\" data-mce-style=\"text-align: left;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">Hi {USERNAME},</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: justify;\" data-mce-style=\"text-align: justify;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">&nbsp;</span><span style=\"font-size: 1rem; color: rgb(0, 0, 0);\" data-mce-style=\"font-size: 1rem; color: #000000;\">You have been assigned to {COURSE_NAME} under {CATEGORY} by your Training Administrator from Quality Circle\'s LMS, GoSmart Academy.</span><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: justify;\" data-mce-style=\"text-align: justify;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">Please <span style=\"background-color: rgb(0, 255, 255); color: rgb(255, 0, 0);\" data-mce-style=\"background-color: #00ffff; color: #ff0000;\">ENROLL</span>&nbsp;,&nbsp;<span style=\"color: rgb(255, 0, 0); background-color: rgb(0, 255, 255);\" data-mce-style=\"color: #ff0000; background-color: #00ffff;\">Sign Up at&nbsp;</span>https://gosmartacademy.com/login &nbsp;then <span style=\"background-color: rgb(0, 255, 255);\" data-mce-style=\"background-color: #00ffff;\"><span style=\"color: rgb(255, 102, 0);\" data-mce-style=\"color: #ff6600;\">Sign</span> <span style=\"color: rgb(255, 102, 0);\" data-mce-style=\"color: #ff6600;\">In at&nbsp;</span></span>https://gosmartacademy.com/login &nbsp;to access the training.&nbsp;</span><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">Each session can be downloaded to your drive for use during the training as a soft copy or hardcopy.&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: justify;\" data-mce-style=\"text-align: justify;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">You need to bring a copy of the {STANDARD} standard to this training and have access to a computer or tablet to participate in the training. The course is offered online. All you need to do is select the</span><span lang=\"EN-US\" style=\"color: rgb(255, 102, 0);\" data-mce-style=\"color: #ff6600;\"><strong> START</strong></span><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\"> or <span style=\"color: rgb(255, 102, 0);\" data-mce-style=\"color: #ff6600;\"><strong>LAUNCH</strong></span> button and it will take you to the training platform the training will be conducted from. (</span><span style=\"color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; font-size: 1rem;\">https://live.mycybermeet.com/) (You can access the training from this link as well)</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: justify;\" data-mce-style=\"text-align: justify;\"><span style=\"font-size: 10pt; caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); font-family: Arial, sans-serif;\">You are required to use to have a chrome browser on their laptop and clear cache at this link for best user experience (</span><a href=\"https://support.google.com/accounts/answer/32050?co=GENIE.Platform%3DDesktop&amp;hl=en\" style=\"font-family: &quot;Yu Mincho Demibold&quot;, serif; font-size: 10pt; caret-color: rgb(0, 0, 0);\"><span style=\"font-family: Arial, sans-serif;\">https://support.google.com/accounts/answer/32050?co=GENIE.Platform%3DDesktop&amp;hl=en</span></a><span style=\"font-size: 10pt; caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); font-family: Arial, sans-serif;\">)&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: justify;\" data-mce-style=\"text-align: justify;\"><span style=\"color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; font-size: 1rem;\">You will have access to the platform 30 minutes prior to start time. You are required to gain access as soon as you get this email. If you have questions send an email to your instructon.&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: justify;\" data-mce-style=\"text-align: justify;\"><span style=\"color: rgb(0, 0, 0); font-size: 1rem;\">The course begins at 9:00 am prompt at {LOCATION} . All participants should be logged in and ready to start by then.</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: justify;\" data-mce-style=\"text-align: justify;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">You are required to complete your final exam immediately after the training. &nbsp;If you do not it will require a US$50 administrative fee to complete the exam thereafter.</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: justify;\" data-mce-style=\"text-align: justify;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">When you complete the final exam you are required to download your certificate and save it to a USB &nbsp;or your hard drive to provide to your training administrator and to keep for your records.</span></p><p style=\"text-align: justify;\" data-mce-style=\"text-align: justify;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Have fun learning.</span></p><p style=\"text-align: justify;\" data-mce-style=\"text-align: justify;\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\"><span lang=\"EN-US\"><o:p></o:p></span><span lang=\"EN-US\">From our Happy team to you.<o:p></o:p></span></span></p><p style=\"text-align: justify;\" data-mce-style=\"text-align: justify;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span><span lang=\"EN-US\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Admin</span><o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-align: justify;\" data-mce-style=\"text-align: justify;\"><span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: left;\" data-mce-style=\"color: #212529; font-size: 1rem; text-align: left;\">http://qualitycircleint.com</span></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: medium; font-family: Calibri, sans-serif; caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); text-align: justify;\" data-mce-style=\"margin: 0in 0in 0.0001pt; font-size: medium; font-family: Calibri, sans-serif; caret-color: #000000; color: #000000; text-align: justify;\"><o:p></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: medium; font-family: Calibri, sans-serif; caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); text-align: justify;\" data-mce-style=\"margin: 0in 0in 0.0001pt; font-size: medium; font-family: Calibri, sans-serif; caret-color: #000000; color: #000000; text-align: justify;\">Our Training Division GoSmart Academy is managed through a State of The Art Cloud Based, Learning Management System(LMS) which enables effective remote communication of digital content, delivery options, record keeping, and post-training support. We offer multiple presentation options to best fit each of our client\'s specific needs. Our channels of delivery include Open-Enrollment, Virtual Instructor-Led Training (VILT) along with Branded Customized on-line single user and on-site presenter-led solutions.<o:p></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: medium; font-family: Calibri, sans-serif; caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); text-align: justify;\" data-mce-style=\"margin: 0in 0in 0.0001pt; font-size: medium; font-family: Calibri, sans-serif; caret-color: #000000; color: #000000; text-align: justify;\"><br data-mce-bogus=\"1\"></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-align: justify;\" data-mce-style=\"text-align: justify;\"><span style=\"caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); font-family: Calibri, sans-serif; font-size: medium; text-align: start;\" data-mce-style=\"caret-color: #000000; color: #000000; font-family: Calibri, sans-serif; font-size: medium; text-align: start;\">&nbsp;</span><span style=\"color: rgb(0, 0, 0); font-size: 1rem; text-align: left;\" data-mce-style=\"color: #000000; font-size: 1rem; text-align: left;\">Partner with us. From Concept to Conclusion we have the power to help you GROW.</span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-align: justify;\" data-mce-style=\"text-align: justify;\"><span style=\"color: rgb(0, 0, 0); font-size: 1rem; text-align: left;\" data-mce-style=\"color: #000000; font-size: 1rem; text-align: left;\">{LOGO}</span><br></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\" bis_skin_checked=\"1\"> </div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\" bis_skin_checked=\"1\"> </div></html>', 'assign_course',  1),
(7, 'You receive certificate successfully', '<html><div class=\"sortable-row active\"><div class=\"sortable-row-container\"><div class=\"sortable-row-actions\"><div class=\"row-move row-action\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\"><table style=\"border: 4px solid rgb(143, 108, 251); width: 600px;\" class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"padding\" data-mce-style=\"width: 600px;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(221, 255, 0); padding: 10px 50px; border-collapse: collapse;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-selected=\"1\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoListParagraphCxSpFirst\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Hi {USERNAME} Thanks for participating in {COURSE_NAME} You have Successfully Completed the course and your certificate is attached.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">GoSmart Academy <o:p></o:p></span></p><p class=\"MsoListParagraphCxSpFirst\"></p><p class=\"MsoListParagraphCxSpLast\"><span lang=\"EN-US\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{LOGO}</span><o:p></o:p></span></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div></html>',  'success_certificate',  1),
(8, 'You didn\'t receive certificate or failed exam', '<html><div class=\"sortable-row active\"><div class=\"sortable-row-container\"><div class=\"sortable-row-actions\"><div class=\"row-move row-action\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\"><table style=\"border: 4px solid rgb(143, 108, 251); width: 600px;\" class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"padding\" data-mce-style=\"width: 600px;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(255, 255, 255); padding: 10px 50px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-selected=\"1\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoListParagraphCxSpFirst\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Hi {USERNAME}&nbsp; Thanks forparticipating in {COURSE_NAME} &nbsp;You werenot successful in your exam. Your certificate of participation is attached. Contact Admin if you have any questions about taking makeup exams.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">GoSmart Academy <o:p></o:p></span></p><p class=\"MsoListParagraphCxSpFirst\"></p><p class=\"MsoListParagraphCxSpLast\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{LOGO}<o:p></o:p></span></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div></html>',  'fail_certificate', 1),
(12,  'Welcome To LMS, Thanks for signing up.', '<html><div class=\"sortable-row active\"><div class=\"sortable-row-container\"><div class=\"sortable-row-actions\"><div class=\"row-move row-action\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\"><table class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"padding\" data-mce-style=\"width: 600px;\" style=\"border-spacing: 0px; border-collapse: collapse;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(0, 225, 255); padding: 10px 50px; border-collapse: collapse;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-selected=\"1\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\" data-mce-style=\"text-align: left;\"><font color=\"#000000\">Hello {USERNAME}&nbsp;of Your Organization Name. Thanks for Signing up to&nbsp;</font><font color=\"#000000\">Quality Circle Academy. Please contact us at support@qualitycircleint.com for&nbsp;</font><font color=\"#000000\">assistance</font></p><p class=\"MsoListParagraphCxSpMiddle\"><span data-mce-style=\"color: #000000;\" lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><font color=\"#000000\">SuperAdmin.</font></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><font color=\"#000000\">http://qualitycircleint.com</font></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><font color=\"#000000\">Our Training Division GoSmart Academy is managed through a State of The Art Cloud&nbsp;</font><font color=\"#000000\">Based, Learning Management System(LMS) which enables effective remote&nbsp;</font><font color=\"#000000\">communication of digital content, delivery options, record keeping and post training&nbsp;</font><font color=\"#000000\">support. </font></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><font color=\"#000000\">We offer multiple presentation options to best fit each of our clients specific&nbsp;</font><font color=\"#000000\">need. Our channels of delivery includes Open-Enrollment, Virtual Instructor Led&nbsp;</font><font color=\"#000000\">Training (VILT) along with Branded Customized on-line single user and on-site&nbsp;</font><font color=\"#000000\">presenter led solutions.</font></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><font color=\"#000000\">Partner with us. From Concept to Conclusion we have the power to help you GROW.</font></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><font color=\"#000000\">{LOGO}</font></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\"> </div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\"> </div></html>',  'signup_company', 1),
(13,  'Verify Code',  '<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/><meta name=\"viewport\" content=\"width=device-width\"/><title>Quality Circle | Email Template</title><link href=\"https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\"><style type=\"text/css\">/*////// RESET STYLES //////*/body{height:100% !important; margin:0; padding:0; width:100% !important;}table{border-collapse:separate;}img, a img{border:0; outline:none; text-decoration:none;}h1, h2, h3, h4, h5, h6{margin:0; padding:0;}p{margin: 1em 0;}/*////// CLIENT-SPECIFIC STYLES //////*/.ReadMsgBody{width:100%;}.ExternalClass{width:100%;}.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{line-height:100%;}table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;}#outlook a{padding:0;}img{-ms-interpolation-mode: bicubic;}body, table, td, p, a, li, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}/*////// GENERAL STYLES //////*/img{max-width: 100%; height: auto;}/*////// TABLET STYLES //////*/@media only screen and (max-width: 620px){.shrink_font{font-size: 62px;}/*////// GENERAL STYLES //////*/#foxeslab-email .table1{width: 90% !important;}#foxeslab-email .table1-2{width: 98% !important; margin-left: 1%; margin-right: 1%;}#foxeslab-email .table1-3{width: 98% !important; margin-left: 1%; margin-right: 1%;}#foxeslab-email .table1-4{width: 98% !important; margin-left: 1%; margin-right: 1%;}#foxeslab-email .table1-5{width: 90% !important; margin-left: 5%; margin-right: 5%;}#foxeslab-email .tablet_no_float{clear: both; width: 100% !important; margin: 0 auto !important; text-align: center !important;}#foxeslab-email .tablet_wise_float{clear: both; float: none !important; width: auto !important; margin: 0 auto !important; text-align: center !important;}#foxeslab-email .tablet_hide{display: none !important;}#foxeslab-email .image1{width: 98% !important;}#foxeslab-email .image1-290{width: 100% !important; max-width: 290px !important;}.center_content{text-align: center !important;}.center_image{margin: 0 auto !important;}.center_button{width: 50% !important;margin-left: 25% !important;max-width: 250px !important;}.centerize{margin: 0 auto !important;}}/*////// MOBILE STYLES //////*/@media only screen and (max-width: 480px){.shrink_font{font-size: 48px;}.safe_color{color: #6a1b9a !important;}/*////// CLIENT-SPECIFIC STYLES //////*/body{width:100% !important; min-width:100% !important;}/* Force iOS Mail to render the email at full width. */table[class=\"flexibleContainer\"]{width: 100% !important;}/* to prevent Yahoo Mail from rendering media query styles on desktop *//*////// GENERAL STYLES //////*/img[class=\"flexibleImage\"]{height:auto !important; width:100% !important;}#foxeslab-email .table1{width: 98% !important;}#foxeslab-email .no_float{clear: both; width: 100% !important; margin: 0 auto !important; text-align: center !important;}#foxeslab-email .wise_float{clear: both;float: none !important;width: auto !important;margin: 0 auto !important;text-align: center !important;}#foxeslab-email .mobile_hide{display: none !important;}.auto_height{height: auto !important;}.table1-3 table{max-width: 500px !important;}}</style></head><body style=\"padding: 0;margin: 0;\" id=\"foxeslab-email\"> <div style=\"max-width: 600px; margin: 0 auto;\" class=\"email-container\"><table class=\"table_full editable-bg-color bg_color_512da8 editable-bg-image\" width=\"100%\" align=\"center\" mc:repeatable=\"castellab\" mc:variant=\"Header\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" background=\"https://gosmartacademy.com/assets/images/images/01-bg-3.jpg\"><tr><td><table class=\"table1\" width=\"600\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td height=\"20\"></td></tr><tr><td><table class=\"table1\" width=\"460\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td><table height=\"30\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"max-width: 100%;\"><tr><td valign=\"middle\" align=\"center\"><div style=\"border-style: none !important; display: block; border: 0 !important;\"><h2 style=\"color:yellow;\">Quality Circle International Limited</h2><p style=\"color:#fff; margin:10px 0; font-size:18px;\">Creating tomorrows smart tool today</p></div></td></tr></table></td></tr></table></td></tr><tr><td height=\"20\"></td></tr></table></td></tr></table><table class=\"table_full editable-bg-color bg_color_ffffff editable-bg-image\" bgcolor=\"#ffffff\" width=\"100%\" align=\"center\" mc:repeatable=\"castellab\" mc:variant=\"Header\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"background-image: url(#); background-position: top center; background-repeat: no-repeat; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;\" background=\"#\"><tr><td><table class=\"table1\" width=\"500\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"margin: 0 auto;\"><tr><td height=\"30\"></td></tr><tr><td><table class=\"table1-2\" width=\"100%\" align=\"right\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"max-width: 390;\"><tr><td mc:edit=\"text202\" align=\"left\" class=\"center_content text_color_242a33\" style=\"color: #242a33; font-size: 16px;line-height: 1.8; font-weight: 500; font-family: \'Open Sans\', Helvetica, sans-serif; mso-line-height-rule: exactly;\"><div class=\"editable-text\" style=\"line-height: 1.8;\"><span class=\"text_container\" style=\"font-size: 22px; color:#000; font-weight:600;\">Hi{FIRSTNAME}{LASTNAME}</span><p>We have received a request to reset your password Quality Circle LMS. Please follow the link below. You will need to select your browser.</p><span class=\"text_container\" style=\"font-size: 17px; color:blue; font-weight:600;\">{PASS_KEY_URL}</span></div></td></tr></table></td></tr><tr><td height=\"10\"></td></tr></table></td></tr></table></td></tr><tr><td><table width=\"600\" align=\"center\" class=\"table1\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td height=\"1\" bgcolor=\"#ebebeb\"></td></tr></table></td></tr></table><table class=\"table_full editable-bg-color bg_color_ffffff editable-bg-image\" bgcolor=\"#ffffff\" width=\"100%\" align=\"center\" mc:repeatable=\"castellab\" mc:variant=\"Header\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"border-bottom: 1px solid #ebebeb;background-image: url(#); background-position: top center; background-repeat: no-repeat; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;\" background=\"#\"><tr><td height=\"30\"></td></tr><tr><td><table class=\"table1\" width=\"600\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"margin: 0 auto;\"><tr><td><table class=\"table1-3\" width=\"300\" align=\"left\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"max-width: 290px;\"><tr><td><div style=\"border-style: none !important; display: block; border: 0 !important;\" class=\"editable-img\"><img editable=\"true\" mc:edit=\"image1001\" src=\"cid:work-1\" style=\"display:block; line-height:0; font-size:0; border:0; width: 100%;\" border=\"0\" alt=\"\"/></div></td></tr></table></td></tr></table><table class=\"table1-3\" width=\"300\" align=\"left\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"max-width: 290px; margin:0 auto;\"><tr><td><div style=\"border-style: none !important; display: block; border: 0 !important;\" class=\"editable-img\"><img editable=\"true\" mc:edit=\"image1002\" src=\"cid:work-5\" style=\"display:block; line-height:0; font-size:0; border:0; width: 100%;\" border=\"0\" alt=\"\"/></div></td></tr></table></td></tr></table></td></tr><tr><td height=\"30\"></td></tr></table></td></tr></table><table class=\"table_full editable-bg-color bg_color_ebebeb editable-bg-image\" bgcolor=\"#ebebeb\" width=\"100%\" align=\"center\" mc:repeatable=\"castellab\" mc:variant=\"Header\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"background-image: url(#); background-position: top center; background-repeat: no-repeat; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;\" background=\"#\"><tr><td height=\"30\"></td></tr><tr><td><table class=\"table1\" width=\"600\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"margin: 0 auto;\"><tr><td mc:edit=\"text1501\" align=\"center\" class=\"text_color_282828\" style=\"color: #282828; font-size: 14px;line-height: 2;font-style: italic;font-weight: 600; font-family: \'Open Sans\', Helvetica, sans-serif; mso-line-height-rule: exactly;\"><div class=\"editable-text\"><span class=\"text_container\">&copy; 2019 All rights Reserved - Quality Circle International Limited</span></div></td></tr></table></td></tr><tr><td height=\"10\"></td></tr><tr> <td> <table class=\"table1\" style=\"padding:0 30px;\"> <tr> <td width=\"300\"> <div class=\"editable-text\"> <a href=\"https://isoprocessbasedauditexperts.com/\" target=\"_blank\"><img src=\"cid:logo\" alt=\"logo\" width=\"230px\"></a> </div></td><td width=\"300\"> <div class=\"editable-text\"> <ul style=\"text-align:right;\"> <li style=\"display:inline-block; font-family:fontawesome; height:30px; width:30px; text-align:center; line-height:30px; background: #004a9a; border-radius:50px;\"><a style=\"text-decoration:none; color:#fff;\" href=\"https://www.facebook.com/pages/category/Consulting-Agency/Quality-Circle-International-Limited-LLC-1985141218415956/\" target=\"_blank\"><i class=\"fab fa-facebook-f\" style=\"font-style:normal;\">f</i></a></li><li style=\"display:inline-block; font-family:fontawesome; height:30px; width:30px; text-align:center; line-height:30px; background: #004a9a; border-radius:50px;\"><a style=\"text-decoration:none; color:#fff;\" href=\"#\"><i class=\"fab fa-twitter\" style=\"font-style:normal;\">T</i></a></li><li style=\"display:inline-block; font-family:fontawesome; height:30px; width:30px; text-align:center; line-height:30px; background: #004a9a; border-radius:50px;\"><a style=\"text-decoration:none; color:#fff;\" href=\"#\"><i class=\"fab fa-linkedin\" style=\"font-style:normal;\">in</i></a></li></ul> </div></td></tr></table></td></tr><tr><td height=\"20\"></td></tr></table></div></body></html>',  'reset_password', 1),
(14,  'Email Verification', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\"><html data-editor-version=\"2\" class=\"sg-campaigns\" xmlns=\"http://www.w3.org/1999/xhtml\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><meta name=\"viewport\" content=\"width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1\"><meta http-equiv=\"X-UA-Compatible\" content=\"IE=Edge\"><style type=\"text/css\">body, p, div{font-family: inherit;font-size: 14px;}body{color: #000000;}body a{color: #1188E6;text-decoration: none;}p{margin: 0; padding: 0;}table.wrapper{width:100% !important;table-layout: fixed;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: 100%;-moz-text-size-adjust: 100%;-ms-text-size-adjust: 100%;}img.max-width{max-width: 100% !important;}.column.of-2{width: 50%;}.column.of-3{width: 33.333%;}.column.of-4{width: 25%;}@media screen and (max-width:480px){.preheader .rightColumnContent,.footer .rightColumnContent{text-align: left !important;}.preheader .rightColumnContent div,.preheader .rightColumnContent span,.footer .rightColumnContent div,.footer .rightColumnContent span{text-align: left !important;}.preheader .rightColumnContent,.preheader .leftColumnContent{font-size: 80% !important;padding: 5px 0;}table.wrapper-mobile{width: 100% !important;table-layout: fixed;}img.max-width{height: auto !important;max-width: 100% !important;}a.bulletproof-button{display: block !important;width: auto !important;font-size: 80%;padding-left: 0 !important;padding-right: 0 !important;}.columns{width: 100% !important;}.column{display: block !important;width: 100% !important;padding-left: 0 !important;padding-right: 0 !important;margin-left: 0 !important;margin-right: 0 !important;}}</style><link href=\"https://fonts.googleapis.com/css?family=Muli&display=swap\" rel=\"stylesheet\"><style>body{font-family: Muli, sans-serif;}</style></head><body><center class=\"wrapper\" data-link-color=\"#1188E6\" data-body-style=\"font-size:14px; font-family:inherit; color:#000000; background-color:#FFFFFF;\"><div class=\"webkit\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\" class=\"wrapper\" bgcolor=\"#FFFFFF\"><tbody><tr><td valign=\"top\" bgcolor=\"#FFFFFF\" width=\"100%\"><table width=\"100%\" role=\"content-container\" class=\"outer\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tbody><tr><td width=\"100%\"><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tbody> <tr> <td><!--[if mso]> <center> <table> <tr> <td width=\"600\"><![endif]--> <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:100%; max-width:600px;\" align=\"center\"> <tbody> <tr> <td role=\"modules-container\" style=\"padding:0px 0px 0px 0px; color:#000000; text-align:left;\" bgcolor=\"#FFFFFF\" width=\"100%\" align=\"left\"> <table class=\"module preheader preheader-hide\" role=\"module\" data-type=\"preheader\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"display: none !important; mso-hide: all; visibility: hidden; opacity: 0; color: transparent; height: 0; width: 0;\"> <tbody> <tr> <td role=\"module-content\"> <p></p></td></tr></tbody> </table> <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" width=\"100%\" role=\"module\" data-type=\"columns\" style=\"padding:30px 20px 30px 20px;\" bgcolor=\"#f6f6f6\"> <tbody> <tr role=\"module-content\"> <td height=\"100%\" valign=\"top\"> <table class=\"column\" width=\"540\" style=\"width:540px; border-spacing:0; border-collapse:collapse; margin:0px 10px 0px 10px;\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" border=\"0\" bgcolor=\"\"> <tbody> <tr> <td style=\"padding:0px;margin:0px;border-spacing:0;\"> <table class=\"wrapper\" role=\"module\" data-type=\"image\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"table-layout: fixed;\" data-muid=\"72aac1ba-9036-4a77-b9d5-9a60d9b05cba\"> <tbody> <tr> <td style=\"font-size:6px; line-height:10px; padding:0px 0px 0px 0px;\" valign=\"top\" align=\"center\"> <img class=\"max-width\" border=\"0\" style=\"display:block; color:#000000; text-decoration:none; font-family:Helvetica, arial, sans-serif; font-size:16px;\" alt=\"\" data-proportionally-constrained=\"true\" data-responsive=\"false\" src=\"https://isogapauditsoftware.com/assets/home/Images/images/logo_f.png\" height=\"50 \"> </td></tr></tbody> </table> <table class=\"module\" role=\"module\" data-type=\"text\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"table-layout: fixed;\" data-muid=\"948e3f3f-5214-4721-a90e-625a47b1c957\" data-mc-module-version=\"2019-10-22\"> <tbody> <tr> <td style=\"padding:50px 30px 18px 30px; line-height:36px; text-align:inherit; background-color:#ffffff;\" height=\"100%\" valign=\"top\" bgcolor=\"#ffffff\" role=\"module-content\"> <div> <div style=\"font-family: inherit; text-align: center\"><span style=\"font-size: 43px\">Thanks for signing up,{username}!&nbsp;</span></div><div></div></div></td></tr></tbody> </table> <table class=\"module\" role=\"module\" data-type=\"text\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"table-layout: fixed;\" data-muid=\"a10dcb57-ad22-4f4d-b765-1d427dfddb4e\" data-mc-module-version=\"2019-10-22\"> <tbody> <tr> <td style=\"padding:18px 30px 18px 30px; line-height:22px; text-align:inherit; background-color:#ffffff;\" height=\"100%\" valign=\"top\" bgcolor=\"#ffffff\" role=\"module-content\"> <div> <div style=\"font-family: inherit; text-align: center\"><span style=\"font-size: 18px\">Please verify your email address to</span><span style=\"color: #000000; font-size: 18px; font-family: arial,helvetica,sans-serif\"> get access to Quality Circle International Limited</span><span style=\"font-size: 18px\">.</span></div><div style=\"font-family: inherit; text-align: center\"><span style=\"color: #ffbe00; font-size: 18px\"><strong>Thank you!&nbsp;</strong></span></div><div></div></div></td></tr></tbody> </table> <table class=\"module\" role=\"module\" data-type=\"spacer\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"table-layout: fixed;\" data-muid=\"7770fdab-634a-4f62-a277-1c66b2646d8d\"> <tbody> <tr> <td style=\"padding:0px 0px 20px 0px;\" role=\"module-content\" bgcolor=\"#ffffff\"> </td></tr></tbody> </table> <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"module\" data-role=\"module-button\" data-type=\"button\" role=\"module\" style=\"table-layout:fixed;\" width=\"100%\" data-muid=\"d050540f-4672-4f31-80d9-b395dc08abe1\"> <tbody> <tr> <td align=\"center\" bgcolor=\"#ffffff\" class=\"outer-td\" style=\"padding:0px 0px 0px 0px;\"> <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper-mobile\" style=\"text-align:center;\"> <tbody> <tr> <td align=\"center\" bgcolor=\"#ffbe00\" class=\"inner-td\" style=\"border-radius:6px; font-size:16px; text-align:center; background-color:inherit;\"> <a href=\"{verification_link}\" style=\"background-color:#ffbe00; border:1px solid #ffbe00; border-color:#ffbe00; border-radius:0px; border-width:1px; color:#000000; display:inline-block; font-size:14px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:12px 40px 12px 40px; text-align:center; text-decoration:none; border-style:solid; font-family:inherit;\" target=\"_blank\">Verify Email Now</a> </td></tr></tbody> </table> </td></tr></tbody> </table> <table class=\"module\" role=\"module\" data-type=\"spacer\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"table-layout: fixed;\" data-muid=\"7770fdab-634a-4f62-a277-1c66b2646d8d.1\"> <tbody> <tr> <td style=\"padding:0px 0px 50px 0px;\" role=\"module-content\" bgcolor=\"#ffffff\"> </td></tr></tbody> </table> </td></tr></tbody> </table> </td></tr></tbody> </table> <div data-role=\"module-unsubscribe\" class=\"module\" role=\"module\" data-type=\"unsubscribe\" style=\"color:#444444; font-size:12px; line-height:20px; padding:16px 16px 16px 16px; text-align:Center;\" data-muid=\"4e838cf3-9892-4a6d-94d6-170e474d21e5\"> <div class=\"Unsubscribe--addressLine\"> <p class=\"Unsubscribe--senderName\" style=\"font-size:12px; line-height:20px;\">Local Solution Global Reach</p><p style=\"font-size:12px; line-height:20px;\"><span class=\"Unsubscribe--senderAddress\">We have the power to let your business grow</span></p></div><p style=\"font-size:12px; line-height:20px;\"><a class=\"Unsubscribe--unsubscribeLink\" href=\"{{{unsubscribe}}}\" target=\"_blank\" style=\"\">Unsubscribe</a> - <a href=\"{{{unsubscribe_preferences}}}\" target=\"_blank\" class=\"Unsubscribe--unsubscribePreferences\" style=\"\">Unsubscribe Preferences</a></p></div><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"module\" data-role=\"module-button\" data-type=\"button\" role=\"module\" style=\"table-layout:fixed;\" width=\"100%\" data-muid=\"550f60a9-c478-496c-b705-077cf7b1ba9a\"> <tbody> <tr> <td align=\"center\" bgcolor=\"\" class=\"outer-td\" style=\"padding:0px 0px 20px 0px;\"> <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper-mobile\" style=\"text-align:center;\"> <tbody> <tr> <td align=\"center\" bgcolor=\"#f5f8fd\" class=\"inner-td\" style=\"border-radius:6px; font-size:16px; text-align:center; background-color:inherit;\"><a href=\"https://sendgrid.com/\" style=\"background-color:#f5f8fd; border:1px solid #f5f8fd; border-color:#f5f8fd; border-radius:25px; border-width:1px; color:#a8b9d5; display:inline-block; font-size:10px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:5px 18px 5px 18px; text-align:center; text-decoration:none; border-style:solid; font-family:helvetica,sans-serif;\" target=\"_blank\">? POWERED BY Quality Circle International Limited</a></td></tr></tbody> </table> </td></tr></tbody> </table> </td></tr></tbody> </table> </td></tr></tbody> </table> </td></tr></tbody></table></td></tr></tbody></table></div></center></body></html><!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\"><html data-editor-version=\"2\" class=\"sg-campaigns\" xmlns=\"http://www.w3.org/1999/xhtml\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><meta name=\"viewport\" content=\"width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1\"><meta http-equiv=\"X-UA-Compatible\" content=\"IE=Edge\"><style type=\"text/css\">body, p, div{font-family: inherit;font-size: 14px;}body{color: #000000;}body a{color: #1188E6;text-decoration: none;}p{margin: 0; padding: 0;}table.wrapper{width:100% !important;table-layout: fixed;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: 100%;-moz-text-size-adjust: 100%;-ms-text-size-adjust: 100%;}img.max-width{max-width: 100% !important;}.column.of-2{width: 50%;}.column.of-3{width: 33.333%;}.column.of-4{width: 25%;}@media screen and (max-width:480px){.preheader .rightColumnContent,.footer .rightColumnContent{text-align: left !important;}.preheader .rightColumnContent div,.preheader .rightColumnContent span,.footer .rightColumnContent div,.footer .rightColumnContent span{text-align: left !important;}.preheader .rightColumnContent,.preheader .leftColumnContent{font-size: 80% !important;padding: 5px 0;}table.wrapper-mobile{width: 100% !important;table-layout: fixed;}img.max-width{height: auto !important;max-width: 100% !important;}a.bulletproof-button{display: block !important;width: auto !important;font-size: 80%;padding-left: 0 !important;padding-right: 0 !important;}.columns{width: 100% !important;}.column{display: block !important;width: 100% !important;padding-left: 0 !important;padding-right: 0 !important;margin-left: 0 !important;margin-right: 0 !important;}}</style><link href=\"https://fonts.googleapis.com/css?family=Muli&display=swap\" rel=\"stylesheet\"><style>body{font-family: Muli, sans-serif;}</style></head><body><center class=\"wrapper\" data-link-color=\"#1188E6\" data-body-style=\"font-size:14px; font-family:inherit; color:#000000; background-color:#FFFFFF;\"><div class=\"webkit\"><table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\" class=\"wrapper\" bgcolor=\"#FFFFFF\"><tbody><tr><td valign=\"top\" bgcolor=\"#FFFFFF\" width=\"100%\"><table width=\"100%\" role=\"content-container\" class=\"outer\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tbody><tr><td width=\"100%\"><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"><tbody> <tr> <td><!--[if mso]> <center> <table> <tr> <td width=\"600\"><![endif]--> <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:100%; max-width:600px;\" align=\"center\"> <tbody> <tr> <td role=\"modules-container\" style=\"padding:0px 0px 0px 0px; color:#000000; text-align:left;\" bgcolor=\"#FFFFFF\" width=\"100%\" align=\"left\"> <table class=\"module preheader preheader-hide\" role=\"module\" data-type=\"preheader\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"display: none !important; mso-hide: all; visibility: hidden; opacity: 0; color: transparent; height: 0; width: 0;\"> <tbody> <tr> <td role=\"module-content\"> <p></p></td></tr></tbody> </table> <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" width=\"100%\" role=\"module\" data-type=\"columns\" style=\"padding:30px 20px 30px 20px;\" bgcolor=\"#f6f6f6\"> <tbody> <tr role=\"module-content\"> <td height=\"100%\" valign=\"top\"> <table class=\"column\" width=\"540\" style=\"width:540px; border-spacing:0; border-collapse:collapse; margin:0px 10px 0px 10px;\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\" border=\"0\" bgcolor=\"\"> <tbody> <tr> <td style=\"padding:0px;margin:0px;border-spacing:0;\"> <table class=\"wrapper\" role=\"module\" data-type=\"image\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"table-layout: fixed;\" data-muid=\"72aac1ba-9036-4a77-b9d5-9a60d9b05cba\"> <tbody> <tr> <td style=\"font-size:6px; line-height:10px; padding:0px 0px 0px 0px;\" valign=\"top\" align=\"center\"> <img class=\"max-width\" border=\"0\" style=\"display:block; color:#000000; text-decoration:none; font-family:Helvetica, arial, sans-serif; font-size:16px;\" alt=\"\" data-proportionally-constrained=\"true\" data-responsive=\"false\" src=\"https://isogapauditsoftware.com/assets/home/Images/images/logo_f.png\" height=\"50 \"> </td></tr></tbody> </table> <table class=\"module\" role=\"module\" data-type=\"text\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"table-layout: fixed;\" data-muid=\"948e3f3f-5214-4721-a90e-625a47b1c957\" data-mc-module-version=\"2019-10-22\"> <tbody> <tr> <td style=\"padding:50px 30px 18px 30px; line-height:36px; text-align:inherit; background-color:#ffffff;\" height=\"100%\" valign=\"top\" bgcolor=\"#ffffff\" role=\"module-content\"> <div> <div style=\"font-family: inherit; text-align: center\"><span style=\"font-size: 43px\">Thanks for signing up,{username}!&nbsp;</span></div><div></div></div></td></tr></tbody> </table> <table class=\"module\" role=\"module\" data-type=\"text\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"table-layout: fixed;\" data-muid=\"a10dcb57-ad22-4f4d-b765-1d427dfddb4e\" data-mc-module-version=\"2019-10-22\"> <tbody> <tr> <td style=\"padding:18px 30px 18px 30px; line-height:22px; text-align:inherit; background-color:#ffffff;\" height=\"100%\" valign=\"top\" bgcolor=\"#ffffff\" role=\"module-content\"> <div> <div style=\"font-family: inherit; text-align: center\"><span style=\"font-size: 18px\">Please verify your email address to</span><span style=\"color: #000000; font-size: 18px; font-family: arial,helvetica,sans-serif\"> get access to Quality Circle International Limited</span><span style=\"font-size: 18px\">.</span></div><div style=\"font-family: inherit; text-align: center\"><span style=\"color: #ffbe00; font-size: 18px\"><strong>Thank you!&nbsp;</strong></span></div><div></div></div></td></tr></tbody> </table> <table class=\"module\" role=\"module\" data-type=\"spacer\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"table-layout: fixed;\" data-muid=\"7770fdab-634a-4f62-a277-1c66b2646d8d\"> <tbody> <tr> <td style=\"padding:0px 0px 20px 0px;\" role=\"module-content\" bgcolor=\"#ffffff\"> </td></tr></tbody> </table> <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"module\" data-role=\"module-button\" data-type=\"button\" role=\"module\" style=\"table-layout:fixed;\" width=\"100%\" data-muid=\"d050540f-4672-4f31-80d9-b395dc08abe1\"> <tbody> <tr> <td align=\"center\" bgcolor=\"#ffffff\" class=\"outer-td\" style=\"padding:0px 0px 0px 0px;\"> <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper-mobile\" style=\"text-align:center;\"> <tbody> <tr> <td align=\"center\" bgcolor=\"#ffbe00\" class=\"inner-td\" style=\"border-radius:6px; font-size:16px; text-align:center; background-color:inherit;\"> <a href=\"{verification_link}\" style=\"background-color:#ffbe00; border:1px solid #ffbe00; border-color:#ffbe00; border-radius:0px; border-width:1px; color:#000000; display:inline-block; font-size:14px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:12px 40px 12px 40px; text-align:center; text-decoration:none; border-style:solid; font-family:inherit;\" target=\"_blank\">Verify Email Now</a> </td></tr></tbody> </table> </td></tr></tbody> </table> <table class=\"module\" role=\"module\" data-type=\"spacer\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"table-layout: fixed;\" data-muid=\"7770fdab-634a-4f62-a277-1c66b2646d8d.1\"> <tbody> <tr> <td style=\"padding:40px 30px 18px 30px; line-height:22px; text-align:inherit; background-color:#ffffff;\" height=\"100%\" valign=\"top\" bgcolor=\"#ffffff\" role=\"module-content\"> <div> <div style=\"font-family: inherit; text-align: center\"><span style=\"font-size: 18px\">If you are facing any problem in clicking above button,</span><span style=\"color: #000000; font-size: 18px; font-family: arial,helvetica,sans-serif\"> Then copy paste this URL in browser.</span><span style=\"font-size: 18px\">.</span></div><div style=\"font-family: inherit; text-align: center\"><span style=\"color: #ffbe00; font-size: 18px\"><strong>{verification_link}&nbsp;</strong></span></div><div></div></div></td></tr></tbody> </table> </td></tr></tbody> </table> </td></tr></tbody> </table> <div data-role=\"module-unsubscribe\" class=\"module\" role=\"module\" data-type=\"unsubscribe\" style=\"color:#444444; font-size:12px; line-height:20px; padding:16px 16px 16px 16px; text-align:Center;\" data-muid=\"4e838cf3-9892-4a6d-94d6-170e474d21e5\"> <div class=\"Unsubscribe--addressLine\"> <p class=\"Unsubscribe--senderName\" style=\"font-size:12px; line-height:20px;\">Local Solution Global Reach</p><p style=\"font-size:12px; line-height:20px;\"><span class=\"Unsubscribe--senderAddress\">We have the power to let your business grow</span></p></div><p style=\"font-size:12px; line-height:20px;\"><a class=\"Unsubscribe--unsubscribeLink\" href=\"{{{unsubscribe}}}\" target=\"_blank\" style=\"\">Unsubscribe</a> - <a href=\"{{{unsubscribe_preferences}}}\" target=\"_blank\" class=\"Unsubscribe--unsubscribePreferences\" style=\"\">Unsubscribe Preferences</a></p></div><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"module\" data-role=\"module-button\" data-type=\"button\" role=\"module\" style=\"table-layout:fixed;\" width=\"100%\" data-muid=\"550f60a9-c478-496c-b705-077cf7b1ba9a\"> <tbody> <tr> <td align=\"center\" bgcolor=\"\" class=\"outer-td\" style=\"padding:0px 0px 20px 0px;\"> <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper-mobile\" style=\"text-align:center;\"> <tbody> <tr> <td align=\"center\" bgcolor=\"#f5f8fd\" class=\"inner-td\" style=\"border-radius:6px; font-size:16px; text-align:center; background-color:inherit;\"><a href=\"https://sendgrid.com/\" style=\"background-color:#f5f8fd; border:1px solid #f5f8fd; border-color:#f5f8fd; border-radius:25px; border-width:1px; color:#a8b9d5; display:inline-block; font-size:10px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:5px 18px 5px 18px; text-align:center; text-decoration:none; border-style:solid; font-family:helvetica,sans-serif;\" target=\"_blank\">? POWERED BY Quality Circle International Limited</a></td></tr></tbody> </table> </td></tr></tbody> </table> </td></tr></tbody> </table> </td></tr></tbody> </table> </td></tr></tbody></table></td></tr></tbody></table></div></center></body></html>',  'email_verification_authentication',  1),
(15,  'Forgot Password Recovery', '<!DOCTYPE html><html><head> <title>table</title> <link href=\"https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese\" rel=\"stylesheet\"> <style>body{margin: 0; padding: 0; font-family: Montserrat, sans-serif;}</style> </head><body><div style=\"padding: 0px\"><div style=\"width: 100%;float: left;\"> <table style=\"border: none;width: 100%;max-width: 500px;margin: auto;\"> <tr> <td><img src=\"https://isogapauditsoftware.com/assets/images/forgot-pass.png\" style=\"width: 100%;\"></td></tr><tr> <td><p style=\"margin: 50px 0 20px 0;text-align: center;padding: 0 0 0 0;font-size: 35px;font-weight: bold;color: #532280;\">Got Yourself Locked Out?</p></td></tr><tr> <td><p style=\"margin: 0 0 0 0;text-align: center;padding: 0 0 0 0;font-size: 17px;\">No worries - we\"ll help you retrieve your keys(AKA account password), and get you back on the road again in no time.</p></td></tr><tr> <td><a href=\"{forgot_pass_link}\" style=\"background: #532280;text-decoration: none;color: #fff;font-weight: bold;font-size: 17px;padding: 10px 20px;border-radius: 10px;width: 100%;display: block;text-align: center;max-width: 200px;margin: auto;margin-top: 15px;margin-bottom: 15px;text-transform: uppercase;\">Change Password</a></td></tr><tr> <td><p style=\"margin: 0 0 0 0;text-align: center;padding: 0 0 60px 0;font-size: 17px;\">Button not working ? Copy and paste this URL into your browser instead :{forgot_pass_link}</p></td></tr></table></div><div class=\"clearfix\"></div></div></body></html>', 'forgot_password_recovery', 1),
(17,  'Course Participation Filled',  '<html><div class=\"sortable-row\" bis_skin_checked=\"1\"><div class=\"sortable-row-container\" bis_skin_checked=\"1\"><div class=\"sortable-row-actions\" bis_skin_checked=\"1\"><div class=\"row-move row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\" bis_skin_checked=\"1\"><table style=\"border: 4px solid rgb(143, 108, 251); width: 600px; border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"padding\" data-mce-style=\"width: 600px;\" data-mce-selected=\"1\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(255, 255, 255); padding: 10px 50px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoListParagraphCxSpFirst\" style=\"text-size-adjust: 100%;\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\"><span lang=\"EN-US\">Hi {ADMIN</span><span lang=\"EN-US\" style=\"font-family:&quot;Batang&quot;,serif;mso-bidi-font-family:Batang;mso-fareast-language:KO\" data-mce-style=\"font-family: \'Batang\',serif; mso-bidi-font-family: Batang; mso-fareast-language: KO;\">_</span><span lang=\"EN-US\">USERNAME} , {COURSE_NAME} Participtaion is filled now.&nbsp;<o:p></o:p></span></span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-size-adjust: 100%;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpMiddle\" style=\"text-size-adjust: 100%;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">GoSmart Academy <o:p></o:p></span></p><p class=\"MsoListParagraphCxSpLast\" style=\"text-size-adjust: 100%;\"><span lang=\"EN-US\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{LOGO}</span><o:p></o:p></span></p></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div></html>', 'course_participation_filled',  1),
(18,  'New Course Scheduled', '<html><div class=\"sortable-row\" bis_skin_checked=\"1\"><div class=\"sortable-row-container\" bis_skin_checked=\"1\"><div class=\"sortable-row-actions\" bis_skin_checked=\"1\"><div class=\"row-move row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\" bis_skin_checked=\"1\"><table style=\"border: 4px solid rgb(143, 108, 251); width: 600px;\" class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"bg-general\" data-mce-style=\"width: 600px;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(0, 255, 213); padding: 10px 50px; border-collapse: collapse;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Hi {USERNAME} , New Course {COURSE_NAME} Scheduled Under ({CATEGORY_NAME}) for the dates {START_DATE} - {END_DATE}</span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">GoSmart Academy. <o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Have fun learning.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">From our Happy team to you.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Admin<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpFirst\"></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{LOGO}</span><o:p></o:p></span></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div></html>',  'new_course_scheduled', 1),
(19,  'New Course Arrival', '<html><div class=\"sortable-row active\" bis_skin_checked=\"1\"><div class=\"sortable-row-container\" bis_skin_checked=\"1\"><div class=\"sortable-row-actions\" bis_skin_checked=\"1\"><div class=\"row-move row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\" bis_skin_checked=\"1\"><table style=\"border: 4px solid rgb(143, 108, 251); width: 600px;\" class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"bg-general\" data-mce-style=\"width: 600px;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(0, 255, 213); padding: 10px 50px; border-collapse: collapse;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-selected=\"1\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Hi, New Course is an arrival</span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">GoSmart Academy. <o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Have fun learning.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">From our Happy team to you.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Admin<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpFirst\"></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{LOGO}</span><o:p></o:p></span></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div></html>', 'new_course_arrival', 1),
(20,  'User OTP Login', '<html><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\"> </div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\"> </div><div class=\"sortable-row code-editor active\" bis_skin_checked=\"1\"><div class=\"sortable-row-container\" bis_skin_checked=\"1\"><div class=\"sortable-row-actions\" bis_skin_checked=\"1\"><div class=\"row-move row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\" bis_skin_checked=\"1\"><table style=\"border: 4px solid rgb(143, 108, 251); width: 600px; border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"width\" data-mce-style=\"width: 600px;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(0, 255, 213); padding: 10px 50px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoNormal\" style=\"margin-left: 18pt; text-size-adjust: 100%;\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Hi {USERNAME}, </span></p><p class=\"MsoNormal\" style=\"margin-left: 18pt; text-size-adjust: 100%;\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Your OTP: {OTP}</span></p><p class=\"MsoNormal\" style=\"margin-left: 18pt; text-size-adjust: 100%;\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">From our Happy team to you<o:p></o:p></span></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\"> </div></html>',  'user_otp_login', 1),
(21,  'Company Assign to Quality Circle\'s LMS',  '<html><div class=\"sortable-row active\"><div class=\"sortable-row-container\"><div class=\"sortable-row-actions\"><div class=\"row-move row-action\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\"><table class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"padding\" data-mce-style=\"width: 600px;\" style=\"border-spacing: 0px; border-collapse: collapse;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(0, 225, 255); padding: 10px 50px; border-collapse: collapse;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-selected=\"1\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\" data-mce-style=\"text-align: left;\"><font color=\"#000000\">Hello {USERNAME}&nbsp;your company &nbsp;{COMPANYNAME} has been assigned  to </font><font color=\"#000000\">Quality Circle’s LMS, GoSmart Academy. Please access your company page&nbsp; {URL} and login with your {PASSWORD} and update your profile. <br>Contact support@gosmartacademy.com for information on how to get started or watch our videos {LINK}</font></p><p class=\"MsoListParagraphCxSpMiddle\"><span data-mce-style=\"color: #000000;\" lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><font color=\"#000000\">Thanks.</font></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><font color=\"#000000\">Quality Circle &nbsp;</font><br><font color=\"#000000\">Administrator&nbsp;</font></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\"> </div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\"> </div></html>',  'company_admin',  1),
(23,  'New Course Created', '<!DOCTYPE html><html lang=\"en\" class=\"js-focus-visible\" data-js-focus-visible=\"\"><head> <title>Quality Circle</title> <style type=\"text/css\"> a{text-decoration: none;}.container{padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;}.col-md-4{width: 33.33333333%; position: relative; min-height: 1px; padding-right: 15px; padding-left: 15px;}.courseBox{background: #fff; border: 1px #ccc solid; margin-bottom: 30px; border-radius: 4px; overflow: hidden;}.courseImg{width: 100%; height: 240px; overflow: hidden;}.courseInfo{padding: 15px;}.coursePrice{padding: 15px; border-top: 1px #ececec solid;}.row{margin-right: -15px; margin-left: -15px;}.btnBlue{display: inline-block; height: 45px; border-radius: 4px; background: #03a9f4; color: #fff; font-weight: 400; line-height: 45px; padding: 0px 10px; text-align: center;}ul{list-style: none; margin: 0; padding: 0; border: 0; font-size: 100%; font: inherit; vertical-align: baseline; outline: none; font-family: \'Poppins\', sans-serif;}.courseInfo ul.courseUl li{text-align: justify;}.courseUl li{margin-bottom: 10px; line-height: 24px;}.li{margin: 0; padding: 0; border: 0; font-size: 100%; font: inherit; vertical-align: baseline; outline: none; font-family: \'Poppins\', sans-serif;}.btnBlue:hover{background: #33be03; color: #fff; box-shadow: 0px 2px 20px rgb(0 0 0 / 40%);}.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9{position: relative; min-height: 1px; padding-right: 15px; padding-left: 15px;}.courseInfo h5{font-size: 20px; font-weight: 700; color: #333; margin-bottom: 15px; line-height: 25px; min-height: 50px;}.text-justify{text-align: justify !important;}</style> <body> <p class=\"text-justify\">Hi{USERNAME}<br>We at Quality Circle\'s Smart Academy wish you all the best in your company\'s management system journey. We are inviting you to participate in our{COURSETITLE}under the category of our{CATEGORY}which will be conducted using our{COURSETYPE}. We offer you world class coaching to understand, interpret and audit any ISO and GFSI standards. <br><br>Our courses are recognized and certified by Exemplar Global. Our smart academy mimics the brick and mortar experience in a full sack virtual environment. Our flip book library used in the training is best in class. All our training aids are stored in our digital library. This eliminates the need for any paper based communication. <br><br>Enroll now on our academy for another great training experience and get all the advantages of after training support from our academy and Exemplar Global.<br>Have fun learning.<br>From our Happy team to you.<br><br>Please share with a colleague. </p><img src=\"{COMPANYLOGO}\" width=\"50\" height=\"50\" style=\"width:50px;height: 50px\"/> <img src=\"{EXAMPLERLOGO}\" width=\"50\" height=\"50\" style=\"width:50px;height: 50px\"/> <section class=\"sectionBox\"> <div class=\"container\"> <div class=\"row\"> <div class=\"col-md-12 col-sm-12 col-xs-12 col-full\"> <div class=\"courseBox\"> <div class=\"courseImg\"> <a href=\"{VIEWLINK}\" target=\"_blank\"> <img style=\"cursor: pointer\" src=\"{IMAGEURL}\" > </a> </div><div class=\"courseInfo\"> <a href=\"{VIEWLINK}\" target=\"_blank\"> <h5 style=\"cursor: pointer\" onclick=\"view_live(3)\">{COURSETITLE}</h5> </a> <ul class=\"courseUl\"> <li style=\"height:25px\"> <a href=\"mailto:support@qualitycircleint.com\" target=\"_blank\">support@qualitycircleint.com</a></li><li></li><li> Type:{PAYTYPE}</li><li> Duration:{DURATION}Day </li>{STARTDATE}{ENDDATE}<!-- <li> Start Date:{STARTDATE}</li><li> End Date:{ENDDATE}</li>--> <li> Price: ${PRICE}</li><li> Discount:{DISCOUNT}%</li><li> Cost: ${AMOUNT}</li></ul> </div><div class=\"coursePrice\"> <div class=\"row\"> <div class=\"col-sm-9 col-xs-9\"> <a href=\"{VIEWCOURSE}\" target=\"_blank\" style=\"margin-left:10px\" class=\"btnBlue\">View Detail</a> <a href=\"{ENROLLCOURSE}\" target=\"_blank\" class=\"btnBlue\">Enroll Now</a> </div></div></div></div></div></div></div></section> </body></html>',  'create_course',  1),
(24,  'User Paid for Course For Admin', '<html> <div class=\"sortable-row active\" bis_skin_checked=\"1\"> <div class=\"sortable-row-container\" bis_skin_checked=\"1\"> <div class=\"sortable-row-actions\" bis_skin_checked=\"1\"> <div class=\"row-move row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\" bis_skin_checked=\"1\"> <table style=\"border: 4px solid rgb(143, 108, 251); width: 600px;\" class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"bg-general\" data-mce-style=\"width: 600px;\" > <tbody> <tr> <td align=\"center\" class=\"element-content\" style=\"background-color: rgb(0, 255, 213); padding: 10px 50px; border-collapse: collapse;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"> <table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-selected=\"1\" > <tbody> <tr> <td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" > <p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Hi{USERNAME}, this is the test email for admin after payment for course</span> </p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{COURSE_TITLE}<o:p></o:p></span> </p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{COURSE_TYPE}<o:p></o:p></span> </p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{PAYMENT_DATE}<o:p></o:p></span> </p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Have fun learning.<o:p></o:p></span> </p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">From our Happy team to you.<o:p></o:p></span> </p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Admin<o:p></o:p></span> </p><p class=\"MsoListParagraphCxSpFirst\"></p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{LOGO}</span><o:p></o:p></span> </p></td></tr></tbody> </table> </td></tr></tbody> </table> <p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div></html>',  'paid_email_admin', 1),
(25,  'User Paid for Course For Instructor',  '<html> <div class=\"sortable-row active\" bis_skin_checked=\"1\"> <div class=\"sortable-row-container\" bis_skin_checked=\"1\"> <div class=\"sortable-row-actions\" bis_skin_checked=\"1\"> <div class=\"row-move row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\" bis_skin_checked=\"1\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\" bis_skin_checked=\"1\"> <table style=\"border: 4px solid rgb(143, 108, 251); width: 600px;\" class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"bg-general\" data-mce-style=\"width: 600px;\" > <tbody> <tr> <td align=\"center\" class=\"element-content\" style=\"background-color: rgb(0, 255, 213); padding: 10px 50px; border-collapse: collapse;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"> <table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-selected=\"1\" > <tbody> <tr> <td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" > <p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Hi, this is the test email for admin after payment for course</span> </p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{COURSE_TITLE}<o:p></o:p></span> </p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{COURSE_TYPE}<o:p></o:p></span> </p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{PAYMENT_DATE}<o:p></o:p></span> </p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Have fun learning.<o:p></o:p></span> </p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">From our Happy team to you.<o:p></o:p></span> </p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Admin<o:p></o:p></span> </p><p class=\"MsoListParagraphCxSpFirst\"></p><p class=\"MsoNormal\" style=\"margin-left: 18pt;\" data-mce-style=\"margin-left: 18.0pt;\"> <span lang=\"EN-US\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{LOGO}</span><o:p></o:p></span> </p></td></tr></tbody> </table> </td></tr></tbody> </table> <p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div></html>',  'paid_email_instructor',  1);

DROP TABLE IF EXISTS `setting_certificate`;
CREATE TABLE `setting_certificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `content` text,
  `left_sign` varchar(255) DEFAULT NULL,
  `right_sign` varchar(255) DEFAULT NULL,
  `left_des` varchar(255) DEFAULT NULL,
  `right_des` varchar(255) DEFAULT NULL,
  `watermark` varchar(255) DEFAULT NULL,
  `middle_logo` varchar(255) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `setting_email`;
CREATE TABLE `setting_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_email` varchar(255) NOT NULL,
  `billing_email` varchar(255) NOT NULL,
  `support_email` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `phpmail` tinyint(1) DEFAULT NULL,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_password` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(255) DEFAULT NULL,
  `mail_ecription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `setting_global`;
CREATE TABLE `setting_global` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `setting_site_config`;
CREATE TABLE `setting_site_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `otp_login` tinyint(4) NOT NULL,
  `verify_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `setting_theme`;
CREATE TABLE `setting_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `header_color` varchar(255) DEFAULT NULL,
  `navigation_color` varchar(255) DEFAULT NULL,
  `font_color` varchar(255) DEFAULT NULL,
  `login_title` varchar(255) DEFAULT NULL,
  `login_bg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `temp_token`;
CREATE TABLE `temp_token` (
  `user_id` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expire_time` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `training_course`;
CREATE TABLE `training_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1024) DEFAULT NULL,
  `subtitle` varchar(100) DEFAULT NULL,
  `description` text,
  `description_img` varchar(1024) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `objective` text,
  `objective_img` varchar(1024) DEFAULT NULL,
  `attend` text,
  `attend_img` varchar(1024) DEFAULT NULL,
  `agenda` text,
  `agenda_img` varchar(1024) DEFAULT NULL,
  `startday` varchar(100) DEFAULT NULL,
  `endday` varchar(100) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `highlights` text,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `create_id` int(11) DEFAULT NULL,
  `instructors` varchar(1024) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `category` int(11) NOT NULL,
  `standard_id` varchar(100) DEFAULT NULL,
  `course_link` varchar(255) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `course_type` int(11) NOT NULL,
  `course_pre_requisite` text,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `training_course_time`;
CREATE TABLE `training_course_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training_course_id` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `sday` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `date_str` varchar(100) DEFAULT NULL,
  `start_day` varchar(100) DEFAULT NULL,
  `start_time` varchar(100) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `end_time` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `training_course_user`;
CREATE TABLE `training_course_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training_course_time_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `trans_lang`;
CREATE TABLE `trans_lang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(30) DEFAULT NULL,
  `lang_code` varchar(15) DEFAULT NULL,
  `field_name` varchar(30) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `active_flag` int(11) DEFAULT '0' COMMENT '0:deactive, 1:active',
  `add_flag` int(11) DEFAULT '0' COMMENT '0:dropdownlist, 1:tablelist',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `trans_term`;
CREATE TABLE `trans_term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_url` varchar(200) DEFAULT '',
  `term` varchar(255) NOT NULL DEFAULT '',
  `english` varchar(1000) DEFAULT '',
  `albania` varchar(1000) DEFAULT '',
  `afrikaans` varchar(1000) DEFAULT '',
  `afar` varchar(1000) DEFAULT '',
  `german` varchar(1000) DEFAULT '',
  `croatian` varchar(1000) DEFAULT '',
  `czech` varchar(1000) DEFAULT '',
  `dutch` varchar(1000) DEFAULT '',
  `french` varchar(1000) DEFAULT '',
  `greek` varchar(1000) DEFAULT '',
  `italian` varchar(1000) DEFAULT '',
  `korean` varchar(1000) DEFAULT '',
  `norwegian` varchar(1000) DEFAULT '',
  `polish` varchar(1000) DEFAULT '',
  `portuguese` varchar(1000) DEFAULT '',
  `romanian` varchar(1000) DEFAULT '',
  `russian` varchar(1000) DEFAULT '',
  `serbian` varchar(255) DEFAULT '',
  `spanish` varchar(255) DEFAULT '',
  `turkish` varchar(1000) DEFAULT '',
  `checked` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`term`) USING BTREE,
  UNIQUE KEY `term` (`term`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `otp` varchar(50) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `isPasswordUptd` tinyint(1) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `organization` varchar(100) DEFAULT NULL,
  `manager` varchar(100) DEFAULT NULL,
  `about_me` varchar(1024) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `country_code` varchar(50) DEFAULT NULL,
  `sortname` varchar(50) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `user_type` enum('Superadmin','Admin','Learner','Instructor') DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `security_key` varchar(255) DEFAULT NULL,
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `wrong_attempts` int(11) NOT NULL,
  `blocked_till` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `plan_id` int(1) DEFAULT NULL,
  `is_trialed` int(1) DEFAULT NULL COMMENT '0:no trialed, 1:it''s already trialed',
  `expired` varchar(255) DEFAULT NULL,
  `sign` longtext,
  `api_key` varchar(255) DEFAULT NULL,
  `payment_status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPRESSED;


DROP TABLE IF EXISTS `user_book`;
CREATE TABLE `user_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `user_login_log`;
CREATE TABLE `user_login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `platform` varchar(255) NOT NULL,
  `device` varchar(255) NOT NULL,
  `crdate` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_title` varchar(255) NOT NULL,
  `video_link` text NOT NULL,
  `video_desc` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `added_by` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `virtual_course`;
CREATE TABLE `virtual_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1024) DEFAULT NULL,
  `subtitle` varchar(1024) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `startday` varchar(100) DEFAULT NULL,
  `endday` varchar(100) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `highlights` text,
  `about` text,
  `objective` text,
  `attend` text,
  `agenda` text,
  `user_type` tinyint(1) DEFAULT NULL,
  `pay_type` tinyint(1) DEFAULT NULL,
  `record_type` tinyint(1) DEFAULT NULL,
  `pay_price` float(11,0) NOT NULL DEFAULT '0',
  `instructors` varchar(1024) DEFAULT NULL,
  `enroll_users` text,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `create_id` int(11) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `objective_img` varchar(255) DEFAULT NULL,
  `attend_img` varchar(255) DEFAULT NULL,
  `agenda_img` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `category` int(11) NOT NULL,
  `standard_id` varchar(100) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `course_type` int(11) NOT NULL,
  `course_pre_requisite` text NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `moderatorPW` varchar(255) DEFAULT NULL,
  `attendeePW` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `virtual_course_history`;
CREATE TABLE `virtual_course_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `virtual_course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `virtual_course_instructor`;
CREATE TABLE `virtual_course_instructor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `virtual_course_time`;
CREATE TABLE `virtual_course_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `virtual_course_id` int(11) DEFAULT NULL,
  `start_at` date DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `start_time` varchar(100) DEFAULT NULL,
  `end_time` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;


DROP TABLE IF EXISTS `virtual_course_user`;
CREATE TABLE `virtual_course_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `virtual_course_time_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


-- 2022-04-27 14:24:54