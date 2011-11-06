<?php

require_once("NFSN/RemoteAddr.php");

$version = $_GET['v'];
$iversion = $_GET['iv'];
$ip = LastRemoteAddr();
$agent = urldecode($_SERVER['HTTP_USER_AGENT']);
$time = time();
if ($_GET['debug']) {
  print_r($_GET);
}
$reloads = isset($_GET['stat_reloads']) ? (int)$_GET['stat_reloads'] : 0;

$stats = array();
foreach ($_GET as $k => $v) {
    $k = str_replace('.', '_', str_replace('-', '_', $k));
    if (substr($k, 0, 5) == 'stat_') {
        $stats[$k] = $v;
    }
}
$stats = json_encode($stats);

if (!empty($version)) {
    if (empty($iversion)) {
        $iversion = $version;
    }
    mysql_connect('omega.db', 'livereload', 'TdDmCHrUhYV4qKrN');
    mysql_select_db('livereload');

    $sql = sprintf('INSERT INTO stats(time, date, ip, version, iversion, agent, stat_reloads, stats) VALUES(%s, FROM_UNIXTIME(%s), "%s", "%s", "%s", "%s", "%s", "%s")',
        $time, $time,
        mysql_real_escape_string($ip),
        mysql_real_escape_string($version),
        mysql_real_escape_string($iversion),
        mysql_real_escape_string($agent),
        mysql_real_escape_string("$reloads"),
        mysql_real_escape_string($stats));

    mysql_query($sql);
}
echo "This file is used to compute anonymous usage statistics and does not contain personally identifiable information.";