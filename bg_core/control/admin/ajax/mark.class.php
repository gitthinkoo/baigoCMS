<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

//不能非法包含或直接执行
if (!defined("IN_BAIGO")) {
    exit("Access Denied");
}

include_once(BG_PATH_CLASS . "ajax.class.php"); //载入 AJAX 基类
include_once(BG_PATH_MODEL . "mark.class.php");

/*-------------用户类-------------*/
class AJAX_MARK {

    private $adminLogged;
    private $obj_ajax;
    private $mdl_mark;
    private $is_super = false;

    function __construct() { //构造函数
        $this->adminLogged    = $GLOBALS["adminLogged"]; //获取已登录信息
        $this->obj_ajax       = new CLASS_AJAX();
        $this->obj_ajax->chk_install();
        $this->mdl_mark       = new MODEL_MARK();

        if ($this->adminLogged["alert"] != "y020102") { //未登录，抛出错误信息
            $this->obj_ajax->halt_alert($this->adminLogged["alert"]);
        }

        if ($this->adminLogged["admin_type"] == "super") {
            $this->is_super = true;
        }

        $this->group_allow = $this->adminLogged["groupRow"]["group_allow"];
    }


    /**
     * ajax_submit function.
     *
     * @access public
     * @return void
     */
    function ajax_submit() {
        if (!isset($this->group_allow["article"]["mark"]) && !$this->is_super) {
            $this->obj_ajax->halt_alert("x140302");
        }

        $_arr_markSubmit = $this->mdl_mark->input_submit();

        if ($_arr_markSubmit["alert"] != "ok") {
            $this->obj_ajax->halt_alert($_arr_markSubmit["alert"]);
        }

        $_arr_markRow = $this->mdl_mark->mdl_submit();

        $this->obj_ajax->halt_alert($_arr_markRow["alert"]);
    }


    /**
     * ajax_del function.
     *
     * @access public
     * @return void
     */
    function ajax_del() {
        if (!isset($this->group_allow["article"]["mark"]) && !$this->is_super) {
            $this->obj_ajax->halt_alert("x140304");
        }

        $_arr_markIds = $this->mdl_mark->input_ids();
        if ($_arr_markIds["alert"] != "ok") {
            $this->obj_ajax->halt_alert($_arr_markIds["alert"]);
        }

        $_arr_markRow = $this->mdl_mark->mdl_del();

        $this->obj_ajax->halt_alert($_arr_markRow["alert"]);
    }


    /**
     * ajax_chkname function.
     *
     * @access public
     * @return void
     */
    function ajax_chkname() {
        $_str_markName    = fn_getSafe(fn_get("mark_name"), "txt", "");
        $_num_markId      = fn_getSafe(fn_get("mark_id"), "int", 0);

        if (!fn_isEmpty($_str_markName)) {
            $_arr_markRow     = $this->mdl_mark->mdl_read($_str_markName, "mark_name", $_num_markId);

            if ($_arr_markRow["alert"] == "y140102") {
                $this->obj_ajax->halt_re("x140203");
            }
        }

        $arr_re = array(
            "re" => "ok"
        );

        exit(json_encode($arr_re));
    }
}
