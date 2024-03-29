<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student_Model
 *
 * @author ronversa09
 */
class Student_Model extends Model {

    private $query;
    private $stud_name;
    private $stud_course;
    private $stud_courseID;
    private $stud_deptName;
    private $stud_deptID;
    private $stud_gender;
    private $stud_yearLevel;
    private $stud_program;
    private $stud_section;
    private $stud_photo;
    private $stud_status;
    private $stud_last_attended_sy_sem = '20';

    public function __construct() {
        parent::__construct();

        $this->query = "";
    }

    public function getStud_Name() {
        return $this->stud_name;
    }

    public function getStud_Course() {
        return $this->stud_course;
    }

    public function getStud_CourseID() {
        return $this->stud_courseID;
    }

    public function getStud_DeptName() {
        return $this->stud_deptName;
    }

    public function getStud_DeptID() {
        return $this->stud_deptID;
    }

    public function getStud_Gender() {
        return $this->stud_gender;
    }

    public function getStud_Yearlevel() {
        return $this->stud_yearLevel;
    }

    public function getStud_Program() {
        return $this->stud_program;
    }

    public function getStud_Section() {
        return $this->stud_section;
    }

    public function getStud_Photo() {
        return $this->stud_photo;
    }

    public function getStud_Status() {
        return $this->stud_status;
    }

    public function get_last_attended_sy_sem() {
        return $this->stud_last_attended_sy_sem;
    }

    public function queryStudent_Info($student_id) {
        $this->query = mysqli_query($this->connectdb,"select concat(Surname, ', ', First_Name, ' ', Middle_Name) as Name,
                                    courses.course_name, courses.course_id, departments.department_name, departments.department_id,
                                    Gender, Year_Level, Program, Section, Picture, Status from students
                                    inner join users on students.username = users.username
                                    inner join courses on students.course_id = courses.course_id
                                    inner join departments on courses.Department_ID = departments.Department_ID
                                    where students.username = '$student_id'");

        $row = mysqli_fetch_array($this->query);

        $this->stud_name = $row['0'];
        $this->stud_course = $row['1'];
        $this->stud_courseID = $row['2'];
        $this->stud_deptName = $row['3'];
        $this->stud_deptID = $row['4'];
        $this->stud_gender = $row['5'];
        $this->stud_yearLevel = $row['6'];
        $this->stud_program = $row['7'];
        $this->stud_section = $row['8'];
        $this->stud_photo = $row['9'];
        $this->stud_status = $row['10'];
        $query = mysqli_query($this->connectdb,"SELECT SY_SEM_ID FROM students WHERE Username='$student_id'");
        $row2 = mysqli_fetch_array($query);
        $this->stud_last_attended_sy_sem = $row2['0'];
    }

    public function insert($uname, $gender, $yr_level, $program, $section, $courseID, $status) {
        $this->query = mysqli_query($this->connectdb,"INSERT INTO `socs`.`students` (`Username`, `Gender`, `Year_Level`, `Program`, `Section`, `Course_ID`, `Status`) 
                        VALUES 
                        ('$uname', '$gender', '$yr_level', '$program', '$section', '$courseID', '$status')");
    }

    public function advance_update($key, $gender, $yr_level, $program, $section, $courseID, $status) {
        mysqli_query($this->connectdb,"UPDATE  `socs`.`students` SET  
                    `Gender` =  '$gender',
                    `Year_Level` =  '$yr_level',
                    `Program` =  '$program',
                    `Section` =  '$section',
                    `Course_ID` =  '$courseID',
                    `Status` =  '$status' 
                     WHERE  `students`.`Username` =  '$key'");
    }
    
    public function updateSY_SEM_ID($id, $username){
        mysqli_query($this->connectdb,"UPDATE students SET SY_SEM_ID = '$id' WHERE Username = '$username'");
        mysqli_error();
    }

    /* -------------------------------------- */

    /*
      public function getStudent_name($student_id){
      $this->query = mysqli_query($this->connectdb,"select concat(Surname, ', ', First_Name, ' ', Middle_Name) as Name from students
      inner join users on students.username = users.username
      where students.username = '$student_id'");
      $row = mysqli_fetch_array($this->query);

      return $row['Name'];
      }

      public function getStudent_course($student_id){
      $this->query = mysqli_query($this->connectdb,"select courses.course_name as course_name from students
      inner join courses on students.course_id = courses.course_id
      where students.username = '$student_id'");
      $row = mysqli_fetch_array($this->query);

      return $row['course_name'];
      }

      public function getStudent_department($student_id){
      $this->query = mysqli_query($this->connectdb,"select departments.department_name as dept_name from students
      inner join courses on students.course_id = courses.course_id
      inner join departments on courses.Department_ID = departments.Department_ID
      where students.username = '$student_id'");
      $row = mysqli_fetch_array($this->query);

      return $row['dept_name'];
      }

      public function getStudent_deptID($student_id){
      $this->query = mysqli_query($this->connectdb,"select departments.department_id as dept_id from students
      inner join courses on students.course_id = courses.course_id
      inner join departments on courses.Department_ID = departments.Department_ID
      where students.username = '$student_id'");
      $row = mysqli_fetch_array($this->query);

      return $row['dept_id'];
      }

      public function getStudent_gender($student_id){
      $this->query = mysqli_query($this->connectdb,"select Gender from students where students.username = '$student_id'");
      $row = mysqli_fetch_array($this->query);

      return $row['Gender'];
      }

      public function getStudent_yr_level($student_id){
      $this->query = mysqli_query($this->connectdb,"select Year_Level from students where students.username = '$student_id'");
      $row = mysqli_fetch_array($this->query);

      return $row['Year_Level'];
      }

      public function getStudent_program($student_id){
      $this->query = mysqli_query($this->connectdb,"select Program from students where students.username = '$student_id'");
      $row = mysqli_fetch_array($this->query);

      return $row['Program'];
      }

      public function getStudent_section($student_id){
      $this->query = mysqli_query($this->connectdb,"select Section from students where students.username = '$student_id'");
      $row = mysqli_fetch_array($this->query);

      return $row['Section'];
      }

      public function getStudent_clearance_status($student_id){
      $this->query = mysqli_query($this->connectdb,"select Cleared from users
      inner join clearancestatus on clearancestatus.student = users.username
      where username = '$student_id'");
      $row = mysqli_fetch_array($this->query);

      return $row['Cleared'];
      }

     */

    /* -------------------------------------- */
}

?>
