<?php /* Smarty version Smarty-3.1.12, created on 2023-06-01 17:00:23
         compiled from "C:wamp\www\student-online-clearance-system-master\SOCS\views\administrator_views\course_list_byDepartment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:260946478cea72ecae1-37770110%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c89f5f1a5d61c70d7d777f47a4eaca0f9c58474' => 
    array (
      0 => 'C:wamp\\www\\student-online-clearance-system-master\\SOCS\\views\\administrator_views\\course_list_byDepartment.tpl',
      1 => 1364151211,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '260946478cea72ecae1-37770110',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Dept_name' => 0,
    'Dept_desc' => 0,
    'rowCount_course' => 0,
    'myName_course' => 0,
    'k' => 0,
    'myKey_course' => 0,
    'i' => 0,
    'desc_course' => 0,
    'usability_course' => 0,
    'course_length' => 0,
    'start' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_6478cea905ae85_71503994',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6478cea905ae85_71503994')) {function content_6478cea905ae85_71503994($_smarty_tpl) {?><!-- Breadcrumb-->
<?php smarty_template_function_breadcrumb($_smarty_tpl,array('lvl2'=>3,'lvl3'=>8,'lvl4'=>1,'activelvl'=>4,'dept_name'=>((string)$_smarty_tpl->tpl_vars['Dept_name']->value)));?>


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

        <div class="navbar">
            <div class="navbar-inner">

                <?php smarty_template_function_nav_departments($_smarty_tpl,array('index'=>1));?>


                <?php smarty_template_function_search($_smarty_tpl,array());?>


            </div>
        </div>

        <!-- Course List Table-->
        <table class="table table-hover table-bordered">     
            <tr>
                <th>
                    <input type="checkbox" onclick="isCheck(<?php echo $_smarty_tpl->tpl_vars['rowCount_course']->value;?>
);" id="check"> Courses
                </th>
                <th>Description</th>
                <th>Usability</th> 
                <th>Controls</th>
            </tr>
            <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['myName_course']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
                <tr>
                    <td>
                        <label class="checkbox">
                            <input class="Checkbox" type="checkbox" id = '<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
' value = <?php echo $_smarty_tpl->tpl_vars['myKey_course']->value[$_smarty_tpl->tpl_vars['k']->value];?>
 > <?php echo $_smarty_tpl->tpl_vars['i']->value;?>

                        </label>
                    </td>
                    <td><label><?php echo $_smarty_tpl->tpl_vars['desc_course']->value[$_smarty_tpl->tpl_vars['k']->value];?>
</label></td>    
                    <td><label><?php echo $_smarty_tpl->tpl_vars['usability_course']->value[$_smarty_tpl->tpl_vars['k']->value];?>
  </label></td>
                    <td>
                        <div>
                            <a style="cursor:pointer;" onclick="window.location.href = 'course_list_byDepartment.php?action=editCourse&seleted=<?php echo $_smarty_tpl->tpl_vars['myKey_course']->value[$_smarty_tpl->tpl_vars['k']->value];?>
'">
                                <i class="icon-pencil"></i> Edit
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <!-- Delete Button-->
        <a style="cursor:pointer;" onclick="findCheck('<?php echo $_smarty_tpl->tpl_vars['rowCount_course']->value;?>
', 'course')" >
            <i class="icon-remove"></i> Delete Selected
        </a>

        <!-- Pagination-->
        <div class="pull-right">
            Jump to: <select id="jump" class="input-mini" onchange="jumpToPage()">
                <option>--</option>
                <?php $_smarty_tpl->tpl_vars['start'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['start']->step = 1;$_smarty_tpl->tpl_vars['start']->total = (int)ceil(($_smarty_tpl->tpl_vars['start']->step > 0 ? $_smarty_tpl->tpl_vars['course_length']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['course_length']->value)+1)/abs($_smarty_tpl->tpl_vars['start']->step));
if ($_smarty_tpl->tpl_vars['start']->total > 0){
for ($_smarty_tpl->tpl_vars['start']->value = 1, $_smarty_tpl->tpl_vars['start']->iteration = 1;$_smarty_tpl->tpl_vars['start']->iteration <= $_smarty_tpl->tpl_vars['start']->total;$_smarty_tpl->tpl_vars['start']->value += $_smarty_tpl->tpl_vars['start']->step, $_smarty_tpl->tpl_vars['start']->iteration++){
$_smarty_tpl->tpl_vars['start']->first = $_smarty_tpl->tpl_vars['start']->iteration == 1;$_smarty_tpl->tpl_vars['start']->last = $_smarty_tpl->tpl_vars['start']->iteration == $_smarty_tpl->tpl_vars['start']->total;?>
                    <option><?php echo $_smarty_tpl->tpl_vars['start']->value;?>
</option>
                <?php }} ?>
            </select>
        </div>

    </div>
</div>

<?php }} ?>