<?php /* Smarty version Smarty-3.1.12, created on 2023-06-04 18:37:02
         compiled from "C:wamp\www\student-online-clearance-system-master\SOCS\views\main_views\student_registration.tpl" */ ?>
<?php /*%%SmartyHeaderCode:89486474f0f74d18e8-58577519%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '797a2aaef20de2b8c1d942225ab684722d6c8ac5' => 
    array (
      0 => 'C:wamp\\www\\student-online-clearance-system-master\\SOCS\\views\\main_views\\student_registration.tpl',
      1 => 1685903812,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89486474f0f74d18e8-58577519',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_6474f0f7ab7580_07195357',
  'variables' => 
  array (
    'depts' => 0,
    'dept' => 0,
    'k' => 0,
    'dept_ID' => 0,
    'dept_id_inCourses' => 0,
    'k_course' => 0,
    'host' => 0,
    'years' => 0,
    'year' => 0,
    's_name' => 0,
    'f_name' => 0,
    'm_name' => 0,
    'e_add' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6474f0f7ab7580_07195357')) {function content_6474f0f7ab7580_07195357($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_debug_print_var')) include 'C:\\wamp\\www\\student-online-clearance-system-master\\SOCS\\libs\\smarty\\plugins\\modifier.debug_print_var.php';
?><?php echo smarty_modifier_debug_print_var($_SESSION);?>


    <script type="text/javascript">
        function changeCourses() {
            var department = document.getElementById("dept"); //alert(document.getElementById("stud_status1").checked);
            department.innerHTML = "";
            if (document.getElementById("stud_status1").checked == true) {
                var stud_status = "Under Graduate";
                document.getElementById("prog_evening").disabled = false;

            
            <?php  $_smarty_tpl->tpl_vars['dept'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dept']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['depts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dept']->key => $_smarty_tpl->tpl_vars['dept']->value){
$_smarty_tpl->tpl_vars['dept']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['dept']->key;
?>
                if (document.getElementById("prog_evening").checked) {
                    <?php if ($_smarty_tpl->tpl_vars['dept']->value=="University Evening Program"){?>
                        department.options[department.options.length] = new Option("<?php echo $_smarty_tpl->tpl_vars['dept']->value;?>
", "<?php echo $_smarty_tpl->tpl_vars['dept_ID']->value[$_smarty_tpl->tpl_vars['k']->value];?>
");
                    <?php }?>
                } else {
                    <?php if ($_smarty_tpl->tpl_vars['dept']->value!="University Evening Program"){?>
                        department.options[department.options.length] = new Option("<?php echo $_smarty_tpl->tpl_vars['dept']->value;?>
", "<?php echo $_smarty_tpl->tpl_vars['dept_ID']->value[$_smarty_tpl->tpl_vars['k']->value];?>
");
                    <?php }?>
                }
            <?php } ?>
            
            } else {
                var stud_status = "Graduate";
                document.getElementById("prog_evening").disabled = true;
            
            <?php  $_smarty_tpl->tpl_vars['dept'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dept']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['depts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dept']->key => $_smarty_tpl->tpl_vars['dept']->value){
$_smarty_tpl->tpl_vars['dept']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['dept']->key;
?>
                <?php if ($_smarty_tpl->tpl_vars['dept']->value!="University Evening Program"){?>
                    department.options[department.options.length] = new Option("<?php echo $_smarty_tpl->tpl_vars['dept']->value;?>
", "<?php echo $_smarty_tpl->tpl_vars['dept_ID']->value[$_smarty_tpl->tpl_vars['k']->value];?>
");
                <?php }?>
            <?php } ?>
            

                document.getElementById("prog_evening").checked = false;
                document.getElementById("prog_day").checked = true;
            }

            //document.getElementById("prog_evening").checked = false; 
            //document.getElementById("prog_day").checked = true;

            changeOptions();
        }

        function changeOptions() {
            if (document.getElementById("stud_status1").checked == true) {
                var stud_status = "Under Graduate";
            } else { var stud_status = "Graduate"; }

            var department = document.getElementById("dept");
            document.getElementById("course").innerHTML = "";
            var select = document.getElementById("course");
            var dept_id = department.options[department.selectedIndex].value;

              
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k_course'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['dept_id_inCourses']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k_course']->value = $_smarty_tpl->tpl_vars['item']->key;
?>       
            if(dept_id == <?php echo $_smarty_tpl->tpl_vars['dept_id_inCourses']->value[$_smarty_tpl->tpl_vars['k_course']->value][0];?>
 && stud_status == "<?php echo $_smarty_tpl->tpl_vars['dept_id_inCourses']->value[$_smarty_tpl->tpl_vars['k_course']->value][2];?>
"){
            select.options[select.options.length] = new Option("<?php echo $_smarty_tpl->tpl_vars['dept_id_inCourses']->value[$_smarty_tpl->tpl_vars['k_course']->value][1];?>
", "<?php echo $_smarty_tpl->tpl_vars['dept_id_inCourses']->value[$_smarty_tpl->tpl_vars['k_course']->value][1];?>
");
        }
    <?php } ?>                          
        
        }
    </script>



<div class="alert alert-block alert-info">
    Assign as a signatory? <a href="signatory_registration.php">Click Here</a>
</div>

<form method='post' class="form-horizontal" action="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
/index.php?action=student_register"
    enctype="multipart/form-data">

    <legend>Login Information: </legend>

    <div class="control-group">
        <label class="control-label"><b>Student ID: </b></label>
        <div class="controls">

            <?php echo smarty_modifier_debug_print_var($_SESSION);?>

            <select class="select2 input-small" name="stud_id" required>
                <?php  $_smarty_tpl->tpl_vars['year'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['year']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['years']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['year']->key => $_smarty_tpl->tpl_vars['year']->value){
$_smarty_tpl->tpl_vars['year']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['year']->key;
?>
                    <option><?php echo $_smarty_tpl->tpl_vars['year']->value;?>
</option>
                <?php } ?>
            </select>

            

            -
            
                <input class="input-small" type='text' name='number' value="" maxlength="5" required title="Numbers Only">
            
            <span class="help-block">ID number that has been given by the University after admission. Must be a bonafied
                student of the University of Southeastern Philippines.</span>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><b>Password: </b></label>
        <div class="controls">
            
                <input id="password_entered" type='password' name='password' pattern="^.{4,50}$"
                    title="Password minimum of 4 characters" required>
            
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><b>Re-type Password: </b></label>
        <div class="controls">
            <input id="retyped_password_entered" type='password' name='confirmpass' onblur="checkPasswordEquality()"
                required>
        </div>
    </div>

    <legend>Personal Information: </legend>

    <div class="control-group">
        <label class="control-label"><b>Surname: </b></label>
        <div class="controls">
            <input type='text' name='surname' <?php if (isset($_smarty_tpl->tpl_vars['s_name']->value)){?>value="<?php echo $_smarty_tpl->tpl_vars['s_name']->value;?>
" <?php }?> pattern="[A-Za-z\s\-]+"
                required title="Letters and spaces only">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><b>First Name: </b></label>
        <div class="controls">
            <input type='text' name='firstname' <?php if (isset($_smarty_tpl->tpl_vars['f_name']->value)){?>value="<?php echo $_smarty_tpl->tpl_vars['f_name']->value;?>
" <?php }?> pattern="[A-Za-z\s\.\-]+"
                required title="Letters and spaces only">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><b>Middle Initial: </b></label>
        <div class="controls">
            <input type='text' name='middleName' maxlength="1" <?php if (isset($_smarty_tpl->tpl_vars['m_name']->value)){?>value="<?php echo $_smarty_tpl->tpl_vars['m_name']->value;?>
" <?php }?>
                pattern="[A-Z\s]+" required title="Letters and spaces only">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><b>Email Address: </b></label>
        <div class="controls">
            <input type='text' name='emailAdd' <?php if (isset($_smarty_tpl->tpl_vars['e_add']->value)){?>value="<?php echo $_smarty_tpl->tpl_vars['e_add']->value;?>
" <?php }?> required>
        </div>
    </div>

    <legend>Advance Information: </legend>

    <div class="control-group">
        <label class="control-label"><b>Year Level: </b></label>
        <div class="controls">
            <select id="year_level" name="year_level" required onchange="changeCourses()">
                <option></option>
                <option value="1">First Year</option>
                <option value="2">Second Year</option>
                <option value="3">Third Year</option>
                <option value="4">Fourth Year</option>
                <option value="5">Fifth Year</option>
            </select>
        </div>
    </div>

    <div class="control-group form-inline">
        <div class="controls form-inline">
            <input type="radio" checked name="gender" value="Male"> <label><b>Male</b></label> &nbsp; &nbsp;
            <input type="radio" name="gender" value="Female"> <label><b>Female </b></label>
        </div>
    </div>

    <div class="control-group form-inline">
        <div class="controls form-inline">
            <input type="radio" id="prog_day" checked name="program" value="Day" onclick="changeCourses()">
            <label><b>Day</b></label> &nbsp; &nbsp; &nbsp;
            <input type="radio" id="prog_evening" name="program" value="Evening" onclick="changeCourses()">
            <label><b>Evening </b></label>
        </div>
    </div>

    <div class="control-group form-inline">
        <div class="controls form-inline">
            <input type="radio" checked name="Status" id="stud_status1" onclick="changeCourses()"
                value="Under Graduate"> <label><b>Under Graduate</b></label> &nbsp; &nbsp; &nbsp;
            <input type="radio" name="Status" id="stud_status2" onclick="changeCourses()" value="Graduate">
            <label><b>Graduate </b></label>
        </div>
    </div>


    <div class="control-group">
        <label class="control-label"><b>Department: </b></label>
        <div class="controls">
            <select id="dept" name="dept" onchange="changeOptions()" required>

                <option></option>

                <?php if (!isset($_smarty_tpl->tpl_vars['depts']->value)){?>
                    <?php $_smarty_tpl->tpl_vars['depts'] = new Smarty_variable(array("CT - College of Technology","CAS - College of Arts and Sciences","IC - Institute of Computing","CE - College of Engineering"), null, 0);?>
                <?php }?>

                <?php  $_smarty_tpl->tpl_vars['dept'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dept']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['depts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dept']->key => $_smarty_tpl->tpl_vars['dept']->value){
$_smarty_tpl->tpl_vars['dept']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['dept']->key;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['dept_ID']->value[$_smarty_tpl->tpl_vars['k']->value];?>
"><?php echo $_smarty_tpl->tpl_vars['dept']->value;?>
</option>
                <?php } ?>
                <h1><?php echo $_smarty_tpl->tpl_vars['depts']->value;?>
 h1 </h1>

            </select>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><b>Course: </b></label>
        <div class="controls">
            <select id="course" name="course" required>
                <option value="accounting">accounting</option>
            </select>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><b>Section: </b></label>
        <div class="controls">
            <input id="section" type='text' name='section' value="" pattern="[0-9A-Za-z\s\-\_\(\)]+" required
                title="Letters and spaces only">
        </div>
    </div>

    <legend>Personal Identification: </legend>

    <div class="control-group">
        <label class="control-label"><b>Upload Picture: </b></label>
        <div class="controls">
            <input type="file" name="photo">
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <input class="btn btn-primary" type='Submit' value='Save' name='Save'>
            <a href='/SOCS/index.php'>Cancel</a>
        </div>
    </div>
</form><?php }} ?>