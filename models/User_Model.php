<?php

/**
 * Administrator Model
 *
 * @author ronversa09, Ozy
 */
class User_Model extends Model {

    public $Username;
    public $Password;
    public $Surname;
    public $First_Name;
    public $Middle_Name;
    public $email_add;
    public $Account_Type;
    public $Picture;
    public $Assigned_Signatory;
    public $Signatory_Usability;
    public $validation_status;
    
    private $query;
    private $itemsPerPage = 30;
    private $filter_ID;
    private $filter_Name;
    private $filter_Picture;
    private $filter_Type;
    private $filter_AssignSignName;
    private $filter_courseORsign;
    private $filter_sign_usability;
    private $stud_status_sign_usability;

    public function __construct() {
        parent::__construct();
        @$this->Username = Session::get_user();
    }
    
    public function verifyStudent($uname, $hashing){
         $this->query = mysqli_query($this->connectdb,"UPDATE `socs`.`users` SET `Validation_Status` = 'Confirmed',
                `Hash` = '$hashing' WHERE `users`.`Username` = '$uname'");
    }

    public function insertStudent($uname, $pass, $sname, $fname, $mname, $email, $pic, $hash) {
            $this->query = mysqli_query($this->connectdb,"INSERT INTO `socs`.`users` (`Username`, `Password`, `Surname`, `First_Name`, `Middle_Name`, `email_address`, `Picture`, `Account_Type`, `Assigned_Signatory`, `Validation_Status`, `Hash`) 
                VALUES 
                ('$uname', '$pass', '$sname', '$fname', '$mname', '$email', '$pic', 'Student', NULL, 'Unconfirmed', '$hash')");
            
//        $this->query = mysqli_query($this->connectdb,"INSERT INTO `socs`.`users` (`Username`, `Password`, `Surname`, `First_Name`, `Middle_Name`, `Account_Type`) 
//                        VALUES 
//                        ('$uname', '$pass', '$sname', '$fname', '$mname', '$user_type')");
    }

    public function insertSignatory_User() {

        $q = "INSERT INTO `socs`.`users` (`Username`, `Password`, `Surname`, `First_Name`, `Middle_Name`, `email_address`, `Picture`, `Account_Type`, `Assigned_Signatory`, `Validation_Status`) 
                            VALUES 
                            ('$this->Username', '$this->Password', '$this->Surname', '$this->First_Name', '$this->Middle_Name', '$this->email_add', '$this->Picture', 'Signatory', '$this->Assigned_Signatory', 'Unconfirmed')";
        
        $this->query = mysqli_query($this->connectdb,$q);
        
        if ($this->query){
            return true;
        }else{
            return false;
        }
    }
    
    public function insertSignatory_UserByAdmin(){
        $this->query = mysqli_query($this->connectdb,"INSERT INTO `socs`.`users` (`Username`, `Password`, `Surname`, `First_Name`, `Middle_Name`, `Picture`, `Account_Type`, `Assigned_Signatory`, `Validation_Status`) 
                            VALUES 
                            ('$this->Username', '$this->Password', '$this->Surname', '$this->First_Name', '$this->Middle_Name', NULL, 'Signatory', '$this->Assigned_Signatory', 'Confirmed')");
    }

    // mutator

    public function getUser($tempUser, $tempPass) {

        return mysqli_query($this->connectdb,"SELECT * FROM users WHERE username='$tempUser'and password='$tempPass' ");
    }
    
    public function getUserPassword($key){
        $this->query = mysqli_query($this->connectdb,"SELECT First_Name, Password, email_address FROM users  WHERE username='$key'");
        $row = mysqli_fetch_array($this->query);

        //return $row['Department_ID'];
        
        $this->First_Name = $row['First_Name'];
        $this->Password = $row['Password'];
        $this->email_add = $row['email_address'];
        
    }

    public function isExist($tempUser, $tempPass) {

        $this->query = mysqli_query($this->connectdb,"SELECT * FROM users WHERE username='$tempUser'and password='$tempPass' "); // where username = '$tempUser' and password = '$tempPass'");

        $rows = mysqli_num_rows($this->query);


        //echo $this->getAccount_Type($tempUser, $tempPass) . ", " .$rows;

        if ($rows == 1) {
            return true;
        } else {
            //echo $tempPass;
            return false;
        }
    }

    public function queryUser_Type($tempUser, $tempPass) {
        $this->query = mysqli_query($this->connectdb,"SELECT Account_Type, Validation_Status FROM users WHERE username='$tempUser'and password='$tempPass' ");

        $sample = mysqli_fetch_array($this->query);

        $this->Account_Type = $sample['0'];
        $this->validation_status = $sample['1'];
    }

    public function updatePassword($key, $hash, $newPassword){
        mysqli_query($this->connectdb,"Update users SET Password='$newPassword' where Username='$key' and Hash='$hash'");
    }
    
    public function updateHash($key, $newHash){
        mysqli_query($this->connectdb,"Update users SET Hash='$newHash' where Username='$key'");
    }
    
    public function update() {
        if(Session::get_Account_type() == "Signatory"){
            $sql = "UPDATE users SET Picture='" . $this->Picture . "', Surname='" . $this->Surname . "', First_Name='" . $this->First_Name . "', Middle_Name='" . $this->Middle_Name ."', email_address='" .$this->email_add . "', Password='" . $this->Password . "',Assigned_Signatory = '$this->Assigned_Signatory' Where Username='" . $this->Username . "'";      
        }else{
            $sql = "UPDATE users SET Picture='" . $this->Picture . "', Surname='" . $this->Surname . "', First_Name='" . $this->First_Name . "', Middle_Name='" . $this->Middle_Name ."', email_address='" .$this->email_add . "', Password='" . $this->Password . "' Where Username='" . $this->Username . "'";
        }
        
        
        if (mysqli_query($this->connectdb,$sql)) {
            Session::set_password($this->Password);
            Session::set_firstname($this->First_Name);
            Session::set_middlename($this->Middle_Name);
            Session::set_surname($this->Surname);
            Session::set_photo($this->Picture);
            Session::set_emailAdd($this->email_add);           
            return true;
        } else {
            return false;
        }
    }

    public function getValidation_status($uname) {
        $this->query = mysqli_query($this->connectdb,"select Validation_Status FROM users WHERE username = '$uname'");
        $sample = mysqli_fetch_array($this->query);
        return $sample['0'];
    }

    public function getFilter_ID() {
        return $this->filter_ID;
    }

    public function getFilter_Name() {
        return $this->filter_Name;
    }

    public function getFilter_Picture() {
        return $this->filter_Picture;
    }

    public function getFilter_Type() {
        return $this->filter_Type;
    }

    public function getFilter_AssignSignName() {
        return $this->filter_AssignSignName;
    }

    public function getFilter_courseORsign() {
        return $this->filter_courseORsign;
    }
    
    public function getStud_Status_Sign_Usability(){
        return $this->stud_status_sign_usability;
    }
    


    /* ----------------------------------------------- */

    public function filter($t_searchName, $t_page, $t_type) {
        //$valid = $t_type == 'Student' ? "and `Validation_Status` IS NULL" : "and `Validation_Status` = 'confirmed'";
        $select = $t_type == 'Student' ? "course_name, Status" : "signatory_name";
        $join = $t_type == 'Student' ? "inner join students on students.username = users.username
                                        inner join courses on courses .course_id = students.course_id " :
                "inner join signatories on signatories.signatory_id = users.Assigned_Signatory ";

        $this->query = mysqli_query($this->connectdb,"select users.username, Picture, concat(Surname, ', ', First_Name, ' ', Middle_Name) 
                        as Name, Account_Type, " . $select . " from users " . $join
                . "where (First_name like '%$t_searchName%' OR Surname like '%$t_searchName%' OR 
                        Middle_Name like '%$t_searchName%') AND Account_Type = '$t_type' and `Validation_Status` = 'Confirmed' order by Name
                        LIMIT " . (($t_page - 1) * $this->itemsPerPage) . ", " . $this->itemsPerPage);

        $this->filter_ID = array();
        $this->filter_Name = array();
        $this->filter_Picture = array();
        $this->filter_Type = array();
        $this->filter_courseORsign = array();
        $this->stud_status_sign_usability = array();
        $this->filter_sign_usability = array();
        while ($row = mysqli_fetch_array($this->query)) {
            array_push($this->filter_ID, $row['0']);
            array_push($this->filter_Name, $row['2']);
            array_push($this->filter_Picture, $row['1']);
            array_push($this->filter_Type, $row['3']);
            array_push($this->filter_courseORsign, $row['4']);
            if($t_type == 'Student'){array_push($this->stud_status_sign_usability, $row['5']);}   
        }
    }

    public function getQueryPageSize($searchName, $type) {
        //$valid = $type == 'Student' ? "and `Validation_Status` IS NULL" : "and `Validation_Status` = 'confirmed'";
        $join = $type == 'Student' ? "inner join students on students.username = users.username
                                        inner join courses on courses .course_id = students.course_id " :
                "inner join signatories on signatories.signatory_id = users.Assigned_Signatory ";
        
        $query = mysqli_query($this->connectdb,"select Picture, concat(Surname, ', ', First_Name, ' ', Middle_Name) 
                        as Name, Account_Type from users 
                        ". $join."
                        where (First_name like '%$searchName%' OR Surname like '%$searchName%' OR 
                        Middle_Name like '%$searchName%') AND Account_Type = '$type' and `Validation_Status` = 'Confirmed'");
        return mysqli_num_rows($query) / $this->itemsPerPage;
    }

    /* -------------- for unconfirmed signatory users -------------------------- */

    public function filterUnconfirmedSign($t_searchName, $t_page) {
        $this->query = mysqli_query($this->connectdb,"select Username, Picture, concat(Surname, ', ', First_Name, ' ', Middle_Name) 
                        as Name, Account_Type, Signatory_Name from users 
                        inner join signatories on signatories.signatory_id = users.Assigned_Signatory
                        where (First_name like '%$t_searchName%' OR Surname like '%$t_searchName%' OR 
                        Middle_Name like '%$t_searchName%') AND Account_Type = 'Signatory' and `Validation_Status` = 'Unconfirmed' order by Name
                        LIMIT " . (($t_page - 1) * $this->itemsPerPage) . ", " . $this->itemsPerPage);

        $this->filter_ID = array();
        $this->filter_Name = array();
        $this->filter_Picture = array();
        $this->filter_Type = array();
        $this->filter_AssignSignName = array();
        $this->page_row = mysqli_num_rows($this->query) / $this->itemsPerPage;
        while ($row = mysqli_fetch_array($this->query)) {
            array_push($this->filter_ID, $row['0']);
            array_push($this->filter_Name, $row['2']);
            array_push($this->filter_Picture, $row['1']);
            array_push($this->filter_Type, $row['3']);
            array_push($this->filter_AssignSignName, $row['4']);
        }
    }

    public function getQueryPageSizeUnconfirmedSign($searchName) {
        $query = mysqli_query($this->connectdb,"select Picture, concat(Surname, ', ', First_Name, ' ', Middle_Name) 
                        as Name, Account_Type from users 
                        where (First_name like '%$searchName%' OR Surname like '%$searchName%' OR 
                        Middle_Name like '%$searchName%') AND Account_Type = 'Signatory' and `Validation_Status` = 'Unconfirmed'");
        return mysqli_num_rows($query) / $this->itemsPerPage;
    }

    public function confirmed($uname) {
        mysqli_query($this->connectdb,"UPDATE `socs`.`users` SET `Validation_Status` = 'Confirmed' WHERE `users`.`Username` = '$uname'");
    }

    /* ------------------------------------------------ */

    public function deleteUser($key) {
        mysqli_query($this->connectdb,"delete from users where Username = '$key'");
    }
    
    /*---------------------- check username if it is existed --------------------------*/
   public function isUsername_Exist($username){
       $this->query = mysqli_query($this->connectdb,"SELECT count(*) FROM users WHERE username='$username'");
       $row = mysqli_fetch_array($this->query);
       
       return $row['0'] > 0 ? true : false;
   }

    /* --------- For Assigning Signatory ---------- */

    public function getListofSignatory() {
        $rowInfo = array();
        $this->query = mysqli_query($this->connectdb,"select signatory_name from signatories");

        while ($row = mysqli_fetch_array($this->query)) {
            array_push($rowInfo, $row['signatory_name']);
        }

        return $rowInfo;
    }

    public function getAssignSignatory($uname) {
        $this->query = mysqli_query($this->connectdb,"select Signatory_Name  from users
                                    inner join signatories
                                    on users.Assigned_Signatory = signatories.Signatory_ID
                                    where username = '$uname'");
        $row = mysqli_fetch_array($this->query);
        
        return $row['Signatory_Name'];
    }
    
    public function getAssignSignatory_SigIDOnly($uname) {
        $this->query = mysqli_query($this->connectdb,"select Assigned_Signatory from users where username='$uname'");
        $row = mysqli_fetch_array($this->query);
        
        return $row[0];
    }
    

    public function getSignatory_Usability($uname){
        $this->query = mysqli_query($this->connectdb,"select Signatory_Usability  from users where username = '$uname'");
        $row = mysqli_fetch_array($this->query);
        
        return $row['Signatory_Usability'];
    }
    
    /* --------------------------------------------------------------------------------------- */
    /* ------------ For Signatory Dashboard Part ---------------- */

    public function filterStudent($Tsign_id, $searchName, $page) {
        $this->query = mysqli_query($this->connectdb,"select students.username, concat(Surname, ', ', First_Name, ' ', Middle_Name) as Name, Picture from students
                                    inner join users on students.username = users.username
                                    
                                    inner join courses on students.course_id = courses.course_id
                                    inner join departments on courses.Department_ID = departments.Department_ID
                                    inner join signatorialList on departments.Department_ID = signatorialList.department_id
                                    inner join signatories on signatorialList.signatory_id = signatories.signatory_id
                                    where (First_name like '%$searchName%' OR Surname like '%$searchName%' OR 
                                    Middle_Name like '%$searchName%') AND Account_Type = 'student' AND `Validation_Status` = 'Confirmed'
                                    AND signatories.signatory_id = '$Tsign_id' group by Name order by Name
                                    LIMIT " . (($page - 1) * $this->itemsPerPage) . ", " . $this->itemsPerPage);


        $this->filter_ID = array();
        $this->filter_Name = array();
        $this->filter_Picture = array();
        while ($row = mysqli_fetch_array($this->query)) {
            array_push($this->filter_ID, $row['0']);
            array_push($this->filter_Name, $row['1']);
            array_push($this->filter_Picture, $row['2']);
        }
    }

    public function getStudent_PageSize($Tsign_id, $searchName) {
        $this->query = mysqli_query($this->connectdb,"select concat(Surname, ', ', First_Name, ' ', Middle_Name) as Name from students
                                    inner join users on students.username = users.username
                                    inner join clearancestatus on users.username = clearancestatus.student
                                    inner join courses on students.course_id = courses.course_id
                                    inner join departments on courses.Department_ID = departments.Department_ID
                                    inner join signatorialList on departments.Department_ID = signatorialList.department_id
                                    inner join signatories on signatorialList.signatory_id = signatories.signatory_id
                        where (First_name like '%$searchName%' OR Surname like '%$searchName%' OR 
                        Middle_Name like '%$searchName%') AND Account_Type = 'student' AND `Validation_Status` = 'Confirmed'
                        AND signatories.signatory_id = '$Tsign_id' group by Name");
        return mysqli_num_rows($this->query) / $this->itemsPerPage;
    }
    
    /*------------ for uploading student record ----------------------*/
    
    public function isValid($stud_id, $lname, $fname){
        $this->query = mysqli_query($this->connectdb,"select count(*) from users where username = '$stud_id' and Surname = '$lname' and First_Name = '$fname'");
        $row = mysqli_fetch_array($this->query);
        
        return $row['0'] == 0;
    }

}

?>
