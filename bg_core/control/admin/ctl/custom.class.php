<?php
/*-----------------------------------------------------------------
！！！！警告！！！！
以下为系统文件，请勿修改
-----------------------------------------------------------------*/

//不能非法包含或直接执行
if (!defined("IN_BAIGO")) {
    exit("Access Denied");
}

include_once(BG_PATH_CLASS . "tpl.class.php"); //载入模板类
include_once(BG_PATH_MODEL . "custom.class.php");
include_once(BG_PATH_MODEL . "cate.class.php");

/*-------------允许类-------------*/
class CONTROL_CUSTOM {

    public $obj_tpl;
    public $mdl_custom;
    public $adminLogged;
    private $is_super = false;

    function __construct() { //构造函数
        $this->obj_base       = $GLOBALS["obj_base"]; //获取界面类型
        $this->config         = $this->obj_base->config;
        $this->adminLogged    = $GLOBALS["adminLogged"];
        $this->mdl_custom     = new MODEL_CUSTOM();
        $this->mdl_cate       = new MODEL_CATE(); //设置栏目对象
        $_arr_cfg["admin"]    = true;
        $this->obj_tpl        = new CLASS_TPL(BG_PATH_TPLSYS . "admin/" . BG_DEFAULT_UI, $_arr_cfg); //初始化视图对象
        $this->fields         = include_once(BG_PATH_LANG . $this->config["lang"] . "/fields.php");
        $this->tplData = array(
            "adminLogged" => $this->adminLogged
        );

        if ($this->adminLogged["admin_type"] == "super") {
            $this->is_super = true;
        }

        $this->group_allow = $this->adminLogged["groupRow"]["group_allow"];
    }


    function ctl_order() {
        if (!isset($this->group_allow["opt"]["custom"]) && !$this->is_super) {
            return array(
                "alert" => "x200303"
            );
        }

        $_num_customId = fn_getSafe(fn_get("custom_id"), "int", 0);

        if ($_num_customId < 1) {
            return array(
                "alert" => "x200209"
            );
        }

        $_arr_customRow = $this->mdl_custom->mdl_read($_num_customId);
        if ($_arr_customRow["alert"] != "y200102") {
            return $_arr_customRow;
        }

        $_arr_tpl = array(
            "customRow"    => $_arr_customRow, //栏目信息
        );

        $_arr_tplData = array_merge($this->tplData, $_arr_tpl);

        $this->obj_tpl->tplDisplay("custom_order.tpl", $_arr_tplData);

        return array(
            "alert" => "y200102"
        );
    }


    function ctl_form() {
        if (!isset($this->group_allow["opt"]["custom"]) && !$this->is_super) {
            return array(
                "alert" => "x200301",
            );
        }

        $_num_customId    = fn_getSafe(fn_get("custom_id"), "int", 0);

        if ($_num_customId > 0) {
            $_arr_customRow = $this->mdl_custom->mdl_read($_num_customId);
            if ($_arr_customRow["alert"] != "y200102") {
                return $_arr_customRow;
            }
        } else {
            $_arr_customRow = array(
                "custom_id"         => 0,
                "custom_name"       => "",
                "custom_type"       => "",
                "custom_opt"        => "",
                "custom_status"     => "enable",
                "custom_parent_id"  => -1,
                "custom_cate_id"    => -1,
                "custom_format"     => "",
            );
        }

        if (is_array($_arr_customRow["custom_opt"])) {
            $this->fields[$_arr_customRow["custom_type"]]["option"] = $_arr_customRow["custom_opt"];
        }

        $_arr_searchCate = array(
            "status" => "show",
        );

        $_arr_searchCustom = array(
            "status" => "enable",
        );

        $_arr_customRows  = $this->mdl_custom->mdl_list(1000, 0, $_arr_searchCustom);
        $_arr_cateRows    = $this->mdl_cate->mdl_list(1000, 0, $_arr_searchCate);

        //print_r($_arr_customRow);

        $_arr_tpl = array(
            "customRow"  => $_arr_customRow,
            "customRows" => $_arr_customRows,
            "cateRows"   => $_arr_cateRows,
            "fields"     => $this->fields,
        );

        $_arr_tplData = array_merge($this->tplData, $_arr_tpl);

        $this->obj_tpl->tplDisplay("custom_form.tpl", $_arr_tplData);

        return array(
            "alert" => "y200102",
        );
    }

    /**
     * ctl_list function.
     *
     * @access public
     * @return void
     */
    function ctl_list() {
        if (!isset($this->group_allow["opt"]["custom"]) && !$this->is_super) {
            return array(
                "alert" => "x200301",
            );
        }

        $_arr_search = array(
            "key"        => fn_getSafe(fn_get("key"), "txt", ""),
            "status"     => fn_getSafe(fn_get("status"), "txt", ""),
        );

        $_num_customCount = $this->mdl_custom->mdl_count($_arr_search);
        $_arr_page        = fn_page($_num_customCount); //取得分页数据
        $_str_query       = http_build_query($_arr_search);
        $_arr_customRows  = $this->mdl_custom->mdl_list(BG_DEFAULT_PERPAGE, $_arr_page["except"], $_arr_search);

        //print_r($_arr_customRows);


        $_arr_tpl = array(
            "query"      => $_str_query,
            "pageRow"    => $_arr_page,
            "search"     => $_arr_search,
            "customRows" => $_arr_customRows,
        );

        $_arr_tplData = array_merge($this->tplData, $_arr_tpl);

        $this->obj_tpl->tplDisplay("custom_list.tpl", $_arr_tplData);

        return array(
            "alert" => "y200301",
        );
    }

}
