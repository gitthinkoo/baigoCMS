<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/
$arr_mod = array("article", "tag", "mark", "spec", "cate", "attach", "call", "custom");

if (isset($_GET["mod"])) {
    $mod = $_GET["mod"];
} else {
    $mod = $arr_mod[0];
}

if (!in_array($mod, $arr_mod)) {
    exit("Access Denied");
}

$base = $_SERVER["DOCUMENT_ROOT"] . str_ireplace(basename(dirname($_SERVER["PHP_SELF"])), "", dirname($_SERVER["PHP_SELF"]));

include_once($base . "bg_config/init.class.php");

$obj_init = new CLASS_INIT();

$obj_init->config_gen();

include_once($obj_init->str_pathRoot . "bg_config/config.inc.php"); //载入配置

include_once(BG_PATH_MODULE . "api/api/" . $mod . ".php");