<?php
define('SYSTEM_NO_ERROR', true);
define('SYSTEM_NO_CHECK_VER', true);
define('SYSTEM_ONLY_CHECK_LOGIN', true);
define('SYSTEM_NO_PLUGIN', true);
require '../init.php';
global $m;
error_reporting(0);
if (ROLE == 'admin') {
    $cv = option::get('core_version');
    if (!empty($cv) && $cv >= '4.0') {
        msg('������ǩ���������� V4.0 �汾�������ظ�����<br/><br/>������ɾ�� /setup/update3.9to4.0.php');
    }
    //------------------------------------------------//
    option::add('toolpw','');
    option::add('sign_scan','1');
    option::add('system_keywords','������ǩ��');
    option::add('system_description','������ǩ��');
    option::add('bbs_us','');
    option::add('bbs_pw','');
    $m->xquery('ALTER TABLE `tc_tieba`
MODIFY COLUMN `id`  int(30) UNSIGNED NOT NULL AUTO_INCREMENT FIRST ,
MODIFY COLUMN `uid`  int(30) UNSIGNED NOT NULL AFTER `id`,
MODIFY COLUMN `pid`  int(30) UNSIGNED NOT NULL DEFAULT 0 AFTER `uid`,
MODIFY COLUMN `fid`  int(30) UNSIGNED NOT NULL DEFAULT 0 AFTER `pid`;

ALTER TABLE `tc_tieba`
DROP COLUMN `lastdo`,
ADD COLUMN `latest`  tinyint(2) UNSIGNED NOT NULL DEFAULT 0 AFTER `status`;

ALTER TABLE `tc_tieba`
MODIFY COLUMN `status`  tinyint(2) UNSIGNED NOT NULL DEFAULT 0 AFTER `no`;

ALTER TABLE `tc_baiduid`
MODIFY COLUMN `id`  int(30) UNSIGNED NOT NULL AUTO_INCREMENT FIRST ,
MODIFY COLUMN `uid`  int(30) UNSIGNED NOT NULL AFTER `id`;

ALTER TABLE `tc_cron`
ADD PRIMARY KEY (`name`);

ALTER TABLE `tc_cron`
MODIFY COLUMN `no`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 AFTER `file`;

ALTER TABLE `tc_users_options`
ADD INDEX `name` (`name`) USING BTREE ;

ALTER TABLE `tc_tieba`
ADD INDEX `latest` (`latest`) USING BTREE ;');
    //------------------------------------------------//
    unlink(__FILE__);
    msg('������ǩ���ѳɹ������� V4.0 �汾��������ɾ�� /setup/update3.9to4.0.php��лл<br/><br/>��Ҫ��ȡ V4.0 �汾�����ԣ���ǰ�� <a href="http://www.stus8.com/forum.php?mod=viewthread&tid=6411">StusGame GROUP</a> ', SYSTEM_URL);
} else {
    msg('����Ҫ�ȵ�¼�ɰ汾����ǩ�������ܼ�������');
}