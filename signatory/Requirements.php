<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Requirements
 *
 * @author ronversa09
 */
require_once '../config/config.php';

class Requirements extends Controller{
    private $template;
    private $schoolYearSem_model;
    private $requirement_model;
    private $signatorialList_model;
    private $signatory_model;
    private $course_model;
    
    
    public function __construct() {
        parent::__construct();
        $this->template = new Template();
        $this->schoolYearSem_model = new SchoolYearSem_Model();
        $this->requirement_model = new Requirements_Model();
        $this->signatorialList_model = new SignatorialList_Model(); 
        $this->signatory_model = new Signatory_Model();
        $this->course_model = new Course_Model();
        
        $listOfSchoolYear = $this->schoolYearSem_model->getSchool_Year();
        $currentSemester = $this->schoolYearSem_model->getCurSemester();
        $currentSchool_Year = $this->schoolYearSem_model->getCurSchool_Year();
            
        $this->template->setPageName('Requirements Page');
        
        $this->template->set_username(Session::get_user());
        $this->template->set_surname(Session::get_Surname());
        $this->template->set_firstname(Session::get_Firstname());
        $this->template->set_middlename(Session::get_Middlename());
        $this->template->set_account_type(Session::get_Account_type() . " in Charge -");

        $this->template->setContent('RequirementsPage.tpl');
        $this->template->setCalendar('Calendar.tpl');
        $this->template->setSchool_YearSemContent('SchoolYear_Sem.tpl');
        $this->template->assign('assign_sign', ", " . Session::get_AssignSignatory());
        $this->template->assign('mySchool_Year', $listOfSchoolYear);
        $this->template->assign('currentSemester', $currentSemester);
        $this->template->assign('currentSchool_Year', $currentSchool_Year);
        
        $this->template->set_photo(Session::get_photo());
        
        $this->displayTable('', 1, "default");
    }
    
    public function deleted() {
        $this->template->setAlert('Selected requirements were deleted successfully.', Template::ALERT_SUCCESS, 'alert');
    }

    public function delete($selected) {
        $explode = explode("-", $selected);
        
        foreach ($explode as $value) {
            $this->requirement_model->deleteRequirements($value);
        }
        $HOST = $explode[0] != null ? HOST . "/signatory/requirements.php?action=deleted" : HOST . "/signatory/bulletin.php";
        header('Location: ' . $HOST);
    }
    
    public function filter($filterName) {
        $this->displayTable(trim($filterName), 1);
    }

    public function displayTable($searchName, $page, $finder) {
        if (isset($_POST['GO'])) {
            $sy_id = $this->schoolYearSem_model->getSy_ID(trim($_POST['school_year']), trim($_POST['semester']));
            $this->template->assign('currentSemester', trim($_POST['semester']));
            $this->template->assign('currentSchool_Year', trim($_POST['school_year']));
        } else if (isset($_GET['sy']) && isset($_GET['sem'])) {
            $sy_id = $this->schoolYearSem_model->getSy_ID(trim($_GET['sy']), trim($_GET['sem']));
            $this->template->assign('currentSemester', trim($_GET['sem']));
            $this->template->assign('currentSchool_Year', trim($_GET['sy']));
        } else {
            $sy_id = $this->schoolYearSem_model->getSy_ID($this->schoolYearSem_model->getCurSchool_Year(), $this->schoolYearSem_model->getCurSemester());
        }

        $this->template->assign('pre_sy', $this->schoolYearSem_model->getCurSchool_Year());
        $this->template->assign('pre_sem', $this->schoolYearSem_model->getCurSemester());
        
        $t_sign_id = $this->signatorialList_model->getSignId(Session::get_AssignSignatory());
        $this->requirement_model->filterRequirements($t_sign_id, $sy_id, $page, $searchName);
        
        $numOfPages = $this->requirement_model->getRequirement_PageSize($t_sign_id, $sy_id, $searchName);
        $getListofID = $this->requirement_model->getID();
        $getListofTitle =  $this->getListofName($this->requirement_model->getTitle(), $searchName, $finder);
        $getListofDesc = $this->requirement_model->getDescription();

        $numOfResults = count($getListofTitle);

        $this->template->assign('requirement_ID', $getListofID);
        $this->template->assign('myDesc_requirements', $this->getMaximumStrLen($getListofDesc));
        $this->template->assign('myName_requirements', $getListofTitle);
        $this->template->assign('filter', $searchName);
        $this->template->assign('requirement_length', $numOfPages);
        $this->template->assign('rowCount_requirement', $numOfResults);

        if ($numOfResults == 0) {
            $this->template->setAlert('No Results Found.', Template::ALERT_ERROR, 'alert');
        }
    }
    
     /*----------- For Adding Requirements Page ------------*/

    public function viewAdd_Requirements(){ 
        //$sign_usability = Session::get_signatory_usability();
        $sign_id = $this->signatorialList_model->getSignId(Session::get_AssignSignatory());
        
        $listOfSignatory = $this->signatorialList_model->getListofSignatory();
        $listOfSignatoryID = $this->signatorialList_model->getListofSignatoryID();
        
        $listOfDepartmentsUnder =  $this->signatorialList_model->getListOfDept_underSignName($sign_id);
        $listOfDepartmentsUnderID =  $this->signatorialList_model->getListOfDept_underSignNameID($sign_id);
        
        $listOfCourse_UnderSign = $this->signatorialList_model->getListOfCourse_Sign($sign_id);
        $listOfCourse_UnderSignID = $this->signatorialList_model->getListOfCourse_SignID($sign_id);
        //var_dump($sign_id);
        $thisSignatory = Session::get_AssignSignatory();
        
        $this->template->setPageName("Adding Requirements Page");
        $this->template->setContent("Add_Requirements.tpl"); 
        
        $this->template->assign('listOfSignatory', $listOfSignatory);
        $this->template->assign('listOfSignatoryID', $listOfSignatoryID);
        
        $this->template->assign('listOfDepartments', $listOfDepartmentsUnder);
        $this->template->assign('listOfDepartmentsID', $listOfDepartmentsUnderID);
        
        $this->template->assign('listOfCourse_UnderSign', $listOfCourse_UnderSign);
        $this->template->assign('listOfCourse_UnderSignID', $listOfCourse_UnderSignID);
        
        $this->template->assign('thisSignatory', $thisSignatory);
        
        
        
       // var_dump($school_year . " " . $semester . " " . $requirement_title . " " . 
             //   $requirement_desc . " " . $requirement_type . " " . $signatory);
        
//        var_dump($school_year . " " . $semester . " " . $requirement_title . " " . 
//                $requirement_desc . " " . $requirement_type . " " . $signatory);
//        
//        //var_dump($_POST);
//        if(isset($_POST['Next'])){
//            
//            if(trim($_POST['requirement_title']) != "" && trim($_POST['requirement_description']) != ""){
//                /// procceed to the next page
//                
//                
//                //header('Location: ../signatory/requirements.php?action=viewNext_Add_Requirements&T_title=' .trim($_POST['requirement_title']) .'&T_desc=' .trim($_POST['requirement_description']));
//                
//                
//            }else{
//                $this->template->setAlert("Cannot Procceed if a field is empty!... ", Template::ALERT_ERROR);
//            }
//        }
    }
    
    public function viewAdd_Requirements_submit(){
        
        $school_year  = $_POST['school_year'];
        $semester = $_POST['semester'];
        $sy_sem = $this->schoolYearSem_model->getSy_ID($school_year, $semester);
        
        $requirement_title = $_POST['requirement_title'];
        $requirement_desc = $_POST['requirement_description']; 
        $requirement_type = $_POST['requirement_type'];
        if ($requirement_type == "Textual")
            $signatory = "NULL" ;
        else {
            $signatory = $_POST['signatory']; 
        }
        
        $thisSignantory = $this->signatorialList_model->getSignId(Session::get_AssignSignatory());
        
        $requirement_application = $_POST['req_appliesTo']; 
        
        $department = "NULL";
        $courses = "NULL";
        $year_level = "NULL";
        $program = "NULL";
        
        switch ($requirement_application) {
            case "By Department":
                $department = $_POST['Departments'];
                break;
            case "By Course":
                $courses = $_POST['Courses'];
                break;
            case "By Year Level":
                $year_level = $_POST['Year_level'];
                break;
            case "By Program":
                $program = $_POST['Program'];
                break;
        }
        
        
        
        /*
        var_dump("sy-sem:'$sy_sem' title:'$requirement_title' desc:'$requirement_desc' type:'$requirement_type' sig:'$signatory' ".
                 "appl:'$requirement_application' department:'$department' course:'$courses' yearlevel:'$year_level' program:'$program'");
        */
        
        $this->requirement_model->addRequirement($requirement_title, $requirement_desc, $thisSignantory, $sy_sem, $requirement_application, $department, $courses, $year_level, $program, $requirement_type, $signatory);
    
        header("location:requirements.php");
        
    }
    
    
     /*----------- For Editing Requirements Page ------------*/

    public function viewEdit_Requirements($reqID){ 
        
        $requirement_Data = $this->requirement_model->getRequirement($reqID);
        $this->signatory_model->getSign_Info($requirement_Data['Prerequisite_Signatory']);
        $this->course_model->getCourse_Info($requirement_Data['Course_ID']);
        
        //$sign_usability = Session::get_signatory_usability();
        $sign_id = $this->signatorialList_model->getSignId(Session::get_AssignSignatory());
        
        $listOfSignatory = $this->signatorialList_model->getListofSignatory();
        $listOfSignatoryID = $this->signatorialList_model->getListofSignatoryID();
        
        $listOfDepartmentsUnder =  $this->signatorialList_model->getListOfDept_underSignName($sign_id);
        $listOfDepartmentsUnderID =  $this->signatorialList_model->getListOfDept_underSignNameID($sign_id);
        
        $listOfCourse_UnderSign = $this->signatorialList_model->getListOfCourse_Sign($sign_id);
        $listOfCourse_UnderSignID = $this->signatorialList_model->getListOfCourse_SignID($sign_id);
        
        $thisSignatory = Session::get_AssignSignatory();
        
        $this->template->setPageName("Edit Requirements");
        $this->template->setContent("Edit_Requirements.tpl"); 
        
        $this->template->assign('listOfSignatory', $listOfSignatory);
        $this->template->assign('listOfSignatoryID', $listOfSignatoryID);
        
        $this->template->assign('listOfDepartments', $listOfDepartmentsUnder);
        $this->template->assign('listOfDepartmentsID', $listOfDepartmentsUnderID);
        
        $this->template->assign('listOfCourse_UnderSign', $listOfCourse_UnderSign);
        $this->template->assign('listOfCourse_UnderSignID', $listOfCourse_UnderSignID);
        
        $this->template->assign('thisSignatory', $thisSignatory);
        
        $this->template->assign('req_Title', $requirement_Data['Title']);
        $this->template->assign('req_Description', $requirement_Data['Description']);
        $this->template->assign('req_Type', $requirement_Data['Requirement_Type']);
        
        $this->template->assign('req_SY', $requirement_Data['School_Year']);
        $this->template->assign('req_Semester', $requirement_Data['Semester']);
        
        $this->template->assign('req_PrereqSignatory', $requirement_Data['Prerequisite_Signatory']);
        $this->template->assign('req_PrereqSignatory_Name', $this->signatory_model->getSign_Name());
        
        $this->template->assign('req_Visibility', $requirement_Data['Visibility']);
        
        $this->template->assign('req_Department', $requirement_Data['Department_ID']);
        $this->template->assign('req_Course', $requirement_Data['Course_ID']);
        $this->template->assign('req_Course_Name', $this->course_model->getCourse_Name());
        $this->template->assign('req_YearLevel', $requirement_Data['Year_Level']);
        $this->template->assign('req_Program', $requirement_Data['Program']);
        
        $this->template->assign('req_RequirementID', $reqID);
    }
    
    
    
    public function viewEdit_Requirements_submit($id){
        
        $school_year  = $_POST['school_year'];
        $semester = $_POST['semester'];
        $sy_sem = $this->schoolYearSem_model->getSy_ID($school_year, $semester);
        
        $requirement_title = $_POST['requirement_title'];
        $requirement_desc = $_POST['requirement_description']; 
        $requirement_type = $_POST['requirement_type'];
        if ($requirement_type == "Textual")
            $signatory = "NULL" ;
        else {
            $signatory = $_POST['signatory']; 
        }
        
        $thisSignantory = $this->signatorialList_model->getSignId(Session::get_AssignSignatory());
        
        $requirement_application = $_POST['req_appliesTo']; 
        
        $department = "NULL";
        $courses = "NULL";
        $year_level = "NULL";
        $program = "NULL";
        
        switch ($requirement_application) {
            case "By Department":
                $department = $_POST['Departments'];
                break;
            case "By Course":
                $courses = $_POST['Courses'];
                break;
            case "By Year Level":
                $year_level = $_POST['Year_level'];
                break;
            case "By Program":
                $program = $_POST['Program'];
                break;
        }
        
        
        
        /*
        var_dump("sy-sem:'$sy_sem' title:'$requirement_title' desc:'$requirement_desc' type:'$requirement_type' sig:'$signatory' ".
                 "appl:'$requirement_application' department:'$department' course:'$courses' yearlevel:'$year_level' program:'$program'");
        */
        
        //$this->requirement_model->addRequirement($requirement_title, $requirement_desc, $thisSignantory, $sy_sem, $requirement_application, $department, $courses, $year_level, $program, $requirement_type, $signatory);
    
        $this->requirement_model->editRequirement($id, $requirement_title, $requirement_desc, $thisSignantory, $sy_sem, $requirement_application, $department, $courses, $year_level, $program, $requirement_type, $signatory);
        
        header("location:requirements.php");
        
    }
    
    
    
    
    /*----------- For the next page for Adding Requirements ------------*/
    
    public function viewNext_Add_Requirements($T_title, $T_desc){
        $this->template->setPageName("Adding Requirements Page");
        $this->template->setContent("Next_Add_Requirements.tpl"); 
              
        
    }
    
    /*------------ Display UI -----------------*/
    public function display() {
        $this->template->display('bootstrap.tpl');
    }
    
    public function getMaximumStrLen($strArray) {
        $temp = array();

        foreach ($strArray as $value) {
            $hold = strlen($value) > 15 ? substr($value, 0, 15) . "........ .... ." : $value;
            array_push($temp, $hold);
        }

        return $temp;
    }
}

$controller = new Requirements();
$controller->perform_actions();
$controller->display();
?>
