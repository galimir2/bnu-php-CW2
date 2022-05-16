<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


echo template("templates/partials/header.php");
echo template("templates/partials/nav.php");

if (isset($_POST['submit']) && count($_FILES) > 0)
{
    if (is_uploaded_file($_FILES['studentphotos']['tmp_name'])) 
    {
        $imgData = addslashes(file_get_contents($_FILES['studentphotos']['tmp_name']));
        $imageProperties = getimageSize($_FILES['studentphotos']['tmp_name']);

        $studentID = mysqli_real_escape_string($conn, $_POST['studentid']);
        $password = $_POST['password'];
        //HASHED THE PASSWORD
        $hashPassword = mysqli_real_escape_string($conn,password_hash($password,PASSWORD_DEFAULT));
        $DOB = mysqli_real_escape_string($conn,$_POST['dob']);
        $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']) ;
        $house = mysqli_real_escape_string($conn, $_POST['house']);
        $town = mysqli_real_escape_string($conn,$_POST['town']) ;
        $county = mysqli_real_escape_string($conn, $_POST['county']);
        $country = mysqli_real_escape_string($conn,$_POST['country']);
        $postcode = mysqli_real_escape_string($conn,$_POST['postcode']);

        $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, studentphoto)
        VALUES ('$studentID', '$hashPassword', '$DOB','$firstname', '$lastname', '$house','$town', '$county', '$country','$postcode', '{$imgData}')";
        
        $duplication_sql_id = "SELECT studentid FROM student WHERE studentid = $studentID";

        $result = mysqli_query($conn, $sql);
        $resultTwo = mysqli_query($conn, $duplication_sql_id);

        if ($result) 
        {
        echo "<h2>You have added a new record!</h2>";
        }
        elseif($resultTwo)
        {
            echo "The ID you are trying to create already exists!";
        }
        else 
        {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        mysqli_close($conn);
        }
    
    }
}
?>
<h2>Add New Student</h2>
<form name="frmLogin" action="addstudent.php" method="post" enctype= "multipart/form-data"><br/>
        Student ID:
        <input name="studentid" type="text" value= "" maxlength ="8"/><br/> 
        Student Password:  
        <input name="password" type="text" value= ""/><br/>
        Student DOB:
        <input type="date" name="dob" value=""/><br/>
        First Name :
        <input name="firstname" type="text" value="" /><br/>
        Surname :
        <input name="lastname" type="text"  value="" /><br/>
        Number and Street :
        <input name="house" type="text"  value="" /><br/>
        Town :
        <input name="town" type="text"  value="" /><br/>
        County :
        <input name="county" type="text"  value="" /><br/>
        Country :
        <input name="country" type="text"  value="" /><br/>
        Postcode :
        <input name="postcode" type="text"  value="" /><br/>
        <input type="file" name = "studentphotos" id="studentphotos" accept="image/png, image/jpeg " value = "Browse"><br/>
        <input type='submit' name='submit' value='Submit' class='submitButton'/>
        </form>