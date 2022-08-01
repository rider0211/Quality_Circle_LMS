/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ols

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-08-11 22:17:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for settings_email_template
-- ----------------------------
DROP TABLE IF EXISTS `settings_email_template`;
CREATE TABLE `settings_email_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `action` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of settings_email_template
-- ----------------------------
INSERT INTO `settings_email_template` VALUES ('4', 'Notice', '<html><div class=\"sortable-row active\"><div class=\"sortable-row-container\"><div class=\"sortable-row-actions\"><div class=\"row-move row-action\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\"><table style=\"border: 4px solid rgb(143, 108, 251); width: 600px;\" class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"padding\" data-mce-style=\"width: 600px;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(79, 89, 227); padding: 10px 50px; border-collapse: collapse;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Hi {USERNAME} thanks for registering to {COURSE_NAME}.This will be another of our out of body training experience from Quality Circle’s LMS, </span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">GoSmart Academy. <o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Have fun learning.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">From our Happy team to you.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Admin<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpFirst\"></p><p class=\"MsoNormal\" style=\"margin-left:18.0pt\" data-mce-style=\"margin-left: 18.0pt;\"><span lang=\"EN-US\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{LOGO}</span><o:p></o:p></span></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div></html>', 'notice_date', '1');
INSERT INTO `settings_email_template` VALUES ('5', 'Welcome To LMS, Thanks for signing up.', '<html><div class=\"sortable-row active\"><div class=\"sortable-row-container\"><div class=\"sortable-row-actions\"><div class=\"row-move row-action\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\"><table class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"padding\" data-mce-style=\"width: 600px;\" style=\"border-spacing: 0px; border-collapse: collapse;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(0, 225, 255); padding: 10px 50px; border-collapse: collapse;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-selected=\"1\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoListParagraphCxSpFirst\"><span data-mce-style=\"color: #000000;\" lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\">Hi {USERNAME},&nbsp; </span></p><p class=\"MsoListParagraphCxSpFirst\"><span data-mce-style=\"color: #000000;\" lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\">Thanks for registering to our training course, on our online platform GoSmart Academy. </span></p><p class=\"MsoListParagraphCxSpFirst\"><span data-mce-style=\"color: #000000;\" lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\">Quality Circle\'s LMS.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span data-mce-style=\"color: #000000;\" lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\"><span style=\"background-color: rgb(255, 255, 0);\" data-mce-style=\"background-color: #ffff00;\">Please&nbsp;<span data-mce-style=\"color: #ff0000;\" style=\"color: rgb(255, 0, 0);\">ENROLL</span>&nbsp;,&nbsp;<span style=\"color: rgb(255, 0, 0);\" data-mce-style=\"color: #ff0000;\">Sign Up&nbsp;</span></span> then&nbsp;<span style=\"color: rgb(255, 0, 0); background-color: rgb(255, 255, 0);\" data-mce-style=\"color: #ff0000; background-color: #ffff00;\">Sign In&nbsp;</span>to access the training.</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">Each session can be downloaded to your drive for use during the training as a soft copy or hardcopy.&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">You need to bring a copy of the standard to this training and have access to the internet a computer or tablet to participae in the training.</span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">Have fun learning.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">From our Happy team to you.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">&nbsp;</span><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">Admin<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: left;\">http://qualitycircleint.com</span></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; color: rgb(0, 0, 0); font-size: medium; font-family: Calibri, sans-serif; caret-color: rgb(0, 0, 0); text-align: justify;\"><o:p></o:p></p><p class=\"MsoNormal\" data-mce-style=\"margin: 0in 0in 0.0001pt; font-size: medium; font-family: Calibri, sans-serif; caret-color: #000000; color: #000000; text-align: justify;\" style=\"margin: 0in 0in 0.0001pt; color: rgb(0, 0, 0); font-size: medium; font-family: Calibri, sans-serif; caret-color: rgb(0, 0, 0); text-align: justify;\">Our Training Division GoSmart Academy is managed through a State of The Art Cloud Based, Learning Management System(LMS) which enables effective remote communication of digital content, delivery options, record keeping and post training support. We offer multiple presentation options to best fit each of our clients specific need. Our channels of delivery includes Open-Enrollment, Virtual Instructor Led Training (VILT) along with Branded Customized on-line single user and on-site presenter led solutions.<o:p></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; color: rgb(0, 0, 0); font-size: medium; font-family: Calibri, sans-serif; caret-color: rgb(0, 0, 0); text-align: start;\"><br data-mce-bogus=\"1\"></p><p class=\"MsoListParagraphCxSpMiddle\"><span style=\"background-color: rgb(255, 255, 0); color: rgb(255, 0, 0);\" data-mce-style=\"background-color: #ffff00; color: #ff0000;\"><span style=\"caret-color: rgb(0, 0, 0); font-family: Calibri, sans-serif; font-size: medium; text-align: start; background-color: rgb(255, 255, 0);\" data-mce-style=\"caret-color: #000000; font-family: Calibri, sans-serif; font-size: medium; text-align: start; background-color: #ffff00;\">&nbsp;</span><span style=\"font-size: 1rem; text-align: left; background-color: rgb(255, 255, 0);\" data-mce-style=\"font-size: 1rem; text-align: left; background-color: #ffff00;\">Partner with us. From Concept to Conclusion we have the power to help you GROW.</span></span></p><p><span style=\"color: rgb(0, 0, 0); font-size: 1rem; text-align: left;\"><br></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span data-mce-style=\"color: #000000;\" lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\">Admin<o:p></o:p></span></p><p></p><p class=\"MsoListParagraphCxSpLast\"><span data-mce-style=\"color: #000000;\" lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\">{LOGO}</span></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\"> </div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\"> </div></html>', 'welcome_email', '1');
INSERT INTO `settings_email_template` VALUES ('6', 'You have  been invited to this course by GoSmart Academy', '<html><div class=\"sortable-row active\"><div class=\"sortable-row-container\"><div class=\"sortable-row-actions\"><div class=\"row-move row-action\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\"><table class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"bg-general\" data-mce-style=\"width: 600px;\" style=\"border-spacing: 0px; border-collapse: collapse;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(0, 230, 255); padding: 10px 50px; border-collapse: collapse;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-selected=\"1\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\" data-mce-style=\"text-align: left;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">Hi {USERNAME},</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\" data-mce-style=\"text-align: left;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">&nbsp;Y</span><span style=\"font-size: 1rem; color: rgb(0, 0, 0);\" data-mce-style=\"font-size: 1rem; color: #000000;\">ou have been assigned to {COURSE_NAME} by your Training Administrator from Quality Circle\'s LMS, GoSmart Academy.</span><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\" data-mce-style=\"text-align: left;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">Please <span style=\"background-color: rgb(0, 255, 255); color: rgb(255, 0, 0);\" data-mce-style=\"background-color: #00ffff; color: #ff0000;\">ENROLL</span>&nbsp;,&nbsp;<span style=\"color: rgb(255, 0, 0); background-color: rgb(0, 255, 255);\" data-mce-style=\"color: #ff0000; background-color: #00ffff;\">Sign Up</span>&nbsp; then <span style=\"background-color: rgb(0, 255, 255);\" data-mce-style=\"background-color: #00ffff;\">Sign In</span> to access the training.</span><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">Each session can be downloaded to your drive for use during the training as a soft copy or hardcopy.&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\" data-mce-style=\"text-align: left;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">You need to bring a copy of the ISO 22000&amp;22002-1 standard to this training and have access to a computer or tablet to participae in the training.</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\" data-mce-style=\"text-align: left;\"><span lang=\"EN-US\" data-mce-style=\"color: #000000;\" style=\"color: rgb(0, 0, 0);\">It is a PreRequisite to login and complete the Pre Course work and do the Pre Course quiz before the start of the course. ?The course begins at 9:00 am promply. All participants should be logged in and ready to start by then.</span></p><p><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Have fun learning.</span></p><p><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\"><span lang=\"EN-US\"><o:p></o:p></span><span lang=\"EN-US\">From our Happy team to you.<o:p></o:p></span></span></p><p><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span><span lang=\"EN-US\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Admin</span><o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: left;\" data-mce-style=\"color: #212529; font-size: 1rem; text-align: left;\">http://qualitycircleint.com</span></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: medium; font-family: Calibri, sans-serif; caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); text-align: justify;\" data-mce-style=\"margin: 0in 0in 0.0001pt; font-size: medium; font-family: Calibri, sans-serif; caret-color: #000000; color: #000000; text-align: justify;\"><o:p></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: medium; font-family: Calibri, sans-serif; caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); text-align: justify;\" data-mce-style=\"margin: 0in 0in 0.0001pt; font-size: medium; font-family: Calibri, sans-serif; caret-color: #000000; color: #000000; text-align: justify;\">Our Training Division GoSmart Academy is managed through a State of The Art Cloud Based, Learning Management System(LMS) which enables effective remote communication of digital content, delivery options, record keeping and post training support. We offer multiple presentation options to best fit each of our clients specific need. Our channels of delivery includes Open-Enrollment, Virtual Instructor Led Training (VILT) along with Branded Customized on-line single user and on-site presenter led solutions.<o:p></o:p></p><p class=\"MsoNormal\" style=\"margin: 0in 0in 0.0001pt; font-size: medium; font-family: Calibri, sans-serif; caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); text-align: start;\" data-mce-style=\"margin: 0in 0in 0.0001pt; font-size: medium; font-family: Calibri, sans-serif; caret-color: #000000; color: #000000; text-align: start;\"><br data-mce-bogus=\"1\"></p><p class=\"MsoListParagraphCxSpMiddle\"><span style=\"caret-color: rgb(0, 0, 0); color: rgb(0, 0, 0); font-family: Calibri, sans-serif; font-size: medium; text-align: start;\" data-mce-style=\"caret-color: #000000; color: #000000; font-family: Calibri, sans-serif; font-size: medium; text-align: start;\">&nbsp;</span><span style=\"color: rgb(0, 0, 0); font-size: 1rem; text-align: left;\" data-mce-style=\"color: #000000; font-size: 1rem; text-align: left;\">Partner with us. From Concept to Conclusion we have the power to help you GROW.</span></p><p class=\"MsoListParagraphCxSpMiddle\"><span style=\"color: rgb(0, 0, 0); font-size: 1rem; text-align: left;\" data-mce-style=\"color: #000000; font-size: 1rem; text-align: left;\">{LOGO}</span><br></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\"> </div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\"> </div></html>', 'assign_course', '1');
INSERT INTO `settings_email_template` VALUES ('7', 'You receive certificate successfully', '<html><div class=\"sortable-row active\"><div class=\"sortable-row-container\"><div class=\"sortable-row-actions\"><div class=\"row-move row-action\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\"><table style=\"border: 4px solid rgb(143, 108, 251); width: 600px;\" class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"padding\" data-mce-style=\"width: 600px;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(221, 255, 0); padding: 10px 50px; border-collapse: collapse;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-selected=\"1\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoListParagraphCxSpFirst\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Hi {USERNAME} Thanks for participating in {COURSE_NAME} You have Successfully Completed the course and your certificate is attached.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">GoSmart Academy <o:p></o:p></span></p><p class=\"MsoListParagraphCxSpFirst\"></p><p class=\"MsoListParagraphCxSpLast\"><span lang=\"EN-US\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{LOGO}</span><o:p></o:p></span></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div></html>', 'success_certificate', '1');
INSERT INTO `settings_email_template` VALUES ('8', 'You didn\'t receive certificate or failed exam', '<html><div class=\"sortable-row\"><div class=\"sortable-row-container\"><div class=\"sortable-row-actions\"><div class=\"row-move row-action\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\"><table style=\"border: 4px solid rgb(143, 108, 251); width: 600px;\" class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"padding\" data-mce-style=\"width: 600px;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(255, 255, 255); padding: 10px 50px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoListParagraphCxSpFirst\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Hi {USERNAME}&nbsp; Thanks for\nparticipating in {COURSE_NAME} &nbsp;You were\nnot successful in your exam. Your certificate of participation is attached.\nContact Admin if you have any questions about taking makeup exams.<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">GoSmart Academy <o:p></o:p></span></p><p class=\"MsoListParagraphCxSpFirst\">\n\n\n\n\n\n</p><p class=\"MsoListParagraphCxSpLast\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{LOGO}<o:p></o:p></span></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div></html>', 'fail_certificate', '1');
INSERT INTO `settings_email_template` VALUES ('9', '', '<html><div class=\"sortable-row active\"><div class=\"sortable-row-container\"><div class=\"sortable-row-actions\"><div class=\"row-move row-action\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\"><table style=\"border: 4px solid rgb(143, 108, 251); width: 600px;\" class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"padding\" data-mce-style=\"width: 600px;\" data-mce-selected=\"1\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(255, 255, 255); padding: 10px 50px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoListParagraphCxSpFirst\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\"><span lang=\"EN-US\">Hi {ADMIN</span><span lang=\"EN-US\" style=\"font-family:&quot;Batang&quot;,serif;mso-bidi-font-family:Batang;mso-fareast-language:KO\" data-mce-style=\"font-family: \'Batang\',serif; mso-bidi-font-family: Batang; mso-fareast-language: KO;\">_</span><span lang=\"EN-US\">USERNAME} , {COURSE_NAME} is now completed. {LEANER_NAME} successfully completed the course .<o:p></o:p></span></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">GoSmart Academy <o:p></o:p></span></p><p class=\"MsoListParagraphCxSpLast\"><span lang=\"EN-US\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{LOGO}</span><o:p></o:p></span></p></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div></html>', 'IA_complete_course', '1');
INSERT INTO `settings_email_template` VALUES ('10', '', '<html><div class=\"sortable-row active\"><div class=\"sortable-row-container\"><div class=\"sortable-row-actions\"><div class=\"row-move row-action\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\"><table style=\"border: 4px solid rgb(143, 108, 251); width: 600px;\" class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"padding\" data-mce-style=\"width: 600px;\" data-mce-selected=\"1\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(255, 255, 255); padding: 10px 50px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoListParagraphCxSpFirst\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\"><span lang=\"EN-US\">Hi {ADMIN</span><span lang=\"EN-US\" style=\"font-family:&quot;Batang&quot;,serif;mso-bidi-font-family:Batang;mso-fareast-language:KO\" data-mce-style=\"font-family: \'Batang\',serif; mso-bidi-font-family: Batang; mso-fareast-language: KO;\">_</span><span lang=\"EN-US\">USERNAME} , {COURSE_NAME}&nbsp; &nbsp;is now completed . &nbsp;{LEANER_NAME}&nbsp;WAS successfully passed exam. <o:p></o:p></span></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">GoSmart Academy <o:p></o:p></span></p><p class=\"MsoListParagraphCxSpFirst\"></p><p class=\"MsoListParagraphCxSpLast\"><span lang=\"EN-US\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{LOGO}</span><o:p></o:p></span></p></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div></html>', 'IA_complete_exam', '1');
INSERT INTO `settings_email_template` VALUES ('11', '', '<html><div class=\"sortable-row active\"><div class=\"sortable-row-container\"><div class=\"sortable-row-actions\"><div class=\"row-move row-action\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\"><table style=\"border: 4px solid rgb(143, 108, 251); width: 600px;\" class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"padding\" data-mce-style=\"border: 4px solid #8f6cfb; width: 600px;\" data-mce-selected=\"1\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(255, 255, 255); padding: 10px 50px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoListParagraphCxSpFirst\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">Hi {ADMIN_USERNAME}&nbsp; {LEARNER_USERNAME}\nhas just enrolled in {COURSE_NAME}<o:p></o:p></span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpMiddle\"><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">GoSmart Academy <o:p></o:p></span></p><p class=\"MsoListParagraphCxSpFirst\">\n\n\n\n\n\n</p><p class=\"MsoListParagraphCxSpLast\"><span lang=\"EN-US\"><span style=\"color: rgb(0, 0, 0);\" data-mce-style=\"color: #000000;\">{LOGO}</span><o:p></o:p></span></p></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div></html>', 'IA_enroll', '1');
INSERT INTO `settings_email_template` VALUES ('12', 'Welcome To LMS, Thanks for signing up.', '<html><div class=\"sortable-row active\"><div class=\"sortable-row-container\"><div class=\"sortable-row-actions\"><div class=\"row-move row-action\"><i class=\"fa fa-arrows-alt\"></i></div><div class=\"row-remove row-action\"><i class=\"fa fa-remove\"></i></div><div class=\"row-duplicate row-action\"><i class=\"fa fa-files-o\"></i></div><div class=\"row-code row-action\"><i class=\"fa fa-code\"></i></div></div><div class=\"sortable-row-content\"><table class=\"main mce-item-table\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" data-types=\"background,padding\" data-last-type=\"padding\" data-mce-style=\"width: 600px;\" style=\"border-spacing: 0px; border-collapse: collapse;\"><tbody><tr><td align=\"center\" class=\"element-content\" style=\"background-color: rgb(0, 225, 255); padding: 10px 50px; border-collapse: collapse;\" data-mce-style=\"background-color: #ffffff; padding: 10px 50px 10px 50px;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"mce-item-table\" style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"border-spacing: 0px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-selected=\"1\"><tbody><tr><td contenteditable=\"true\" align=\"center\" class=\"element-contenteditable active\" style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\" data-mce-style=\"padding: 20px; border-collapse: collapse; text-size-adjust: 100%;\"><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\" data-mce-style=\"text-align: left;\"><font color=\"#000000\">Hello {USERNAME}&nbsp;of Your Organization Name. Thanks for Signing up to&nbsp;</font><font color=\"#000000\">Quality Circle Academy. Please contact us at support@qualitycircleint.com for&nbsp;</font><font color=\"#000000\">assistance</font></p><p class=\"MsoListParagraphCxSpMiddle\"><span data-mce-style=\"color: #000000;\" lang=\"EN-US\" style=\"color: rgb(0, 0, 0);\">&nbsp;</span></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><font color=\"#000000\">SuperAdmin.</font></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><font color=\"#000000\">http://qualitycircleint.com</font></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><font color=\"#000000\">Our Training Division GoSmart Academy is managed through a State of The Art Cloud&nbsp;</font><font color=\"#000000\">Based, Learning Management System(LMS) which enables effective remote&nbsp;</font><font color=\"#000000\">communication of digital content, delivery options, record keeping and post training&nbsp;</font><font color=\"#000000\">support. </font></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><font color=\"#000000\">We offer multiple presentation options to best fit each of our clients specific&nbsp;</font><font color=\"#000000\">need. Our channels of delivery includes Open-Enrollment, Virtual Instructor Led&nbsp;</font><font color=\"#000000\">Training (VILT) along with Branded Customized on-line single user and on-site&nbsp;</font><font color=\"#000000\">presenter led solutions.</font></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><font color=\"#000000\">Partner with us. From Concept to Conclusion we have the power to help you GROW.</font></p><p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: left;\"><font color=\"#000000\">{LOGO}</font></p></td></tr></tbody></table></td></tr></tbody></table><p style=\"text-align: -webkit-center; text-size-adjust: 100%;\" data-mce-style=\"text-align: -webkit-center; text-size-adjust: 100%;\"></p></div></div></div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\"> </div><div class=\"elements-list-item ui-draggable ui-draggable-handle\" style=\"\"> </div></html>', 'signup_company', '1');