<?php
   $firstname = $_POST['firstname'];
   $middlename = $_POST['middlename'];
   $lastname = $_POST['lastname'];
   $AsAdopter = $_POST['AsAdopter'];
   $gender = $_POST['gender'];
   $phone = $_POST['phone'];
   $email = $_POST['email'];
   $Username = $_POST['Username'];
   $psw = $_POST['psw'];

   if (!empty($firstname) ||  !empty($middlename) ||  !empty($lastname) ||  !empty($AsAdopter) ||  !empty($gender) ||  !empty($phone) || !empty($email) ||  !empty($Username) ||  !empty($psw)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "adots2";
 
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
 
    if (mysqli_connect_error()){
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
 
    } else {
        $SELECT = "SELECT email From register Where email = ? Limit 1";
        $INSERT= "INSERT Info register (firstname, middlename, lastname, AsAdopter, gender, phone, email, Username, psw) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
 
     //prepare statement
     $stmt =$conn->prepare($SELECT);
     $stmt->$stmt->bind_param("s", $email);  
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
 
     if ($rnum==0) {
         $stmt->close();
 
         $stmt = $conn->prepare($INSERT);
         $stmt->bind_param("sssssssss", $firstname, $middlename, $lastname, $AsAdopter, $gender, $phone, $email, $Username, $psw);
         $stmt->execute(); 
         echo "New record inserted sucessfully";
      } else {
         echo "Someone is already registerd with this email";
      }
      $stmt->close();
      $conn->close();
    }
 } else {
     echo "All fields are required";
     die();
     }




 ?>



   


