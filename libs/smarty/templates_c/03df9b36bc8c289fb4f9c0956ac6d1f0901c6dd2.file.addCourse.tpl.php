<?php /* Smarty version Smarty-3.1.12, created on 2023-06-01 17:04:04
         compiled from "C:wamp\www\student-online-clearance-system-master\SOCS\views\administrator_views\addCourse.tpl" */ ?>
<?php /*%%SmartyHeaderCode:270556478cf8403baf3-18043028%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '03df9b36bc8c289fb4f9c0956ac6d1f0901c6dd2' => 
    array (
      0 => 'C:wamp\\www\\student-online-clearance-system-master\\SOCS\\views\\administrator_views\\addCourse.tpl',
      1 => 1364151211,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '270556478cf8403baf3-18043028',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Dept_name' => 0,
    'Dept_desc' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_6478cf84274bd0_04372097',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6478cf84274bd0_04372097')) {function content_6478cf84274bd0_04372097($_smarty_tpl) {?><!-- Breadcrumb-->
<?php smarty_template_function_breadcrumb($_smarty_tpl,array('lvl2'=>3,'lvl3'=>8,'lvl4'=>1,'lvl5'=>1,'activelvl'=>5,'dept_name'=>((string)$_smarty_tpl->tpl_vars['Dept_name']->value)));?>


<div class="row">
    <div class="span3">

        <!-- Header-->
        <h4 class="well center-text well-small">Departments</h4>

        <!-- Admin Navigations--> 
        <?php smarty_template_function_nav_admin($_smarty_tpl,array('index'=>3));?>


    </div>
    <div class="span9">

        <!-- Header-->
        <div class="well center-text well-small">
            <h4><?php echo $_smarty_tpl->tpl_vars['Dept_name']->value;?>
 </h4>
            <small><?php echo $_smarty_tpl->tpl_vars['Dept_desc']->value;?>
</small>
        </div>

        <!-- Add Course-->
        <form action="course_list_byDepartment.php?action=add_course" method='post' class="form-horizontal">
            <legend>Add Course:</legend>
            <div class="control-group">
                <label class="control-label"><b>Course Name: </b></label>
                <div class="controls">
                    <input style="width: 400px;" class="input-xlarge" type ='text' name='course_name'>
                </div>
            </div>
            <div class="control-group form-inline">
                <div class="controls form-inline">
                    <input type="radio" checked name="course_usability" value="Under Graduate"> <label><b>Under Graduate</b></label>
                    <input type="radio" name="course_usability" value="Graduate"> <label><b>Graduate </b></label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><b>Description: </b></label>
                <div class="controls">
                    <textarea style="width: 400px;" class="input-xlarge" name='course_description' rows="5" cols="50"></textarea>
                </div>
            </div>
            <div class="control-group form-actions">
                <div class="pull-right">
                    <input class="btn btn-primary" type='Submit' value='Save'>
                    <input class="btn" type="button" value="Back" onclick="window.location.href = 'course_list_byDepartment.php'">
                </div>
            </div>
        </form>
    </div>
</div><?php }} ?>