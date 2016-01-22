-- create table e_friend
CREATE TABLE `e_friend`(
`uid` INT(10) UNSIGNED NOT NULL COMMENT '用户ID',
`fri_uid` INT(11) NOT NULL COMMENT '好友的用户ID',
`fri_nickname` VARCHAR(64) NULL DEFAULT NULL COMMENT 'gbk_bin',
`fri_group_id` MEDIUMINT(9) NULL DEFAULT NULL COMMENT '好友分组',
PRIMARY KEY (`uid`,`fri_uid`),
INDEX `idx_friend_fri_group_id` (`fri_group_id`)
)COMMENT='好友表(一对好友关系2条记录)' COLLATE='gbk_bin' ENGINE=INNODB;
-- create table e_feed
CREATE TABLE `e_feed`(
	`feed_id` INT(10) UNSIGNED NOT NULL COMMENT '动态ID',
	`uid` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT '用户ID',
	`feed_data` VARCHAR(1024) NULL DEFAULT NULL COMMENT '动态数据内容' COLLATE 'gbk_bin',
	PRIMARY KEY (`feed_id`)
) COMMENT = '动态' COLLATE='gbk_bin' ENGINE=INNODB CHECKSUM=1;
--联合查询
SELECT u.uid,u.fri_uid,u.fri_nickname,f.feed_id,f.feed_data FROM e_friend u LEFT JOIN e_feed f ON u.fri_uid = f.uid;
-- 视图
CREATE VIEW freind_feed AS SELECT u.uid,u.fri_uid,u.fri_nickname,f.feed_id,f.feed_data FROM e_friend u LEFT JOIN e_feed f ON u.fri_uid = f.uid;
SELECT * FROM friend_feed WHERE uid = 1;
-- MySQL 并不能提高查询效率，只是另一个查询语句的映射
-- 视图只是一个虚拟表，只包含定义，不包含任何数据。
-- MySQL存储过程和事件调度
 CREATE TABLE `log` (
 `id` INT(10) NOT NULL AUTO_INCREMENT,
 `message` VARCHAR (200) NULL DEFAULT '0',
 `isread` INT(11) NULL DEFAULT 0,
 PRIMARY KEY (`id`)
 )COLLATE='utf8_general_ci';

-- 存储过程
DELIMITER//
CREATE PROCEDURE `utable` (IN $tname VARCHAR(20),IN $field VARCHAR(10))
BEGIN 
SET @sqlcmd = CONCAT("delete from ",$tname," where ",$field,"=1");
PREPARE stmt FROM @sqlcmd;
EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END 
//
-- 调用存储过程
CALL `utable` ('log','isread');
-- 创建事件
CREATE EVENT IF NOT EXISTS event_log ON SCHEDULE
EVERY 10 SECOND 
ON COMPLETION PRESERVE
DO CALL `utable`('log','isread');
-- 队列和栈一样是一种线性表结构
-- Mysql 模拟消息队列
DROP TABLE IF EXISTS `eventqueue`;
CREATE TABLE `eventqueue`(
	`qid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '消息序列',
	`topic` tinyint(4) NOT NULL COMMENT '应用类型',
	`status` tinyint(4) NOT NULL COMMENT '状态，表示是否进行分发，0 未分发，1已分发',
	`data` VARCHAR(1024) DEFAULT NULL COLLATE utf8_general_ci COMMENT '消息内容',
	`create_date` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp COMMENT '发送时间', 
	`uid` INT(11) NOT NULL COMMENT '动态产生者的uid',
	PRIMARY KEY (`qid`)
)COMMENT='消息队列表，用以记录消息的属性和内容' ENGINE=MEMORY DEFAULT CHARSET = utf8 COLLATE=utf8_general_ci;
-- 存储过程 接受并处理好友的动态发布
DROP PROCEDURE IF EXISTS `proc_msg_recever_friend`;
DELIMITER //
CREATE DEFINER = 'TEST'@'%' PROCEDURE `proc_msg_recever_friend`() 
COMMENT '消息队列中好友分发存储过程'
BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION ROLLBACK;
	START TRANSACTION;
	INSERT INTO `feed_broadcast` SELECT feed_id,ef.fri_uid,temp.create_date,app_id,src_type FROM (SELECT * FROM eventqueue eq WHERE eq.status = 0 AND eq.topic = 1 ORDER BY 	create_date DESC LIMIT 100) temp,friend ef WHERE temp.uid = ef.uid;
	UPDATE eventqueue eq SET status = 1 WHERE eq.status = 0 AND eq.topic = 1 ORDER BY create_date DESC LIMIT 100;
	COMMIT;
END //
DELIMITER;
-- 调度 event实现
DROP EVENT IF EXISTS `event_msg_cleaner`;
DELIMITER //
	CREATE EVENT `event_msg_cleaner` ON SCHEDULE EVERY 1 HOUR STARTS '2015-08-27 16:00:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT '删除已处理消息调度' DO DELETE FROM ens_eventqueue WHERE STATUS=1 //
DELIMITER;
-- 存储过程 接收并处理公共主页的动态发布