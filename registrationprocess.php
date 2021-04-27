
<?php

session_start();

$useremail = $_POST['email'];
$userpassword = $_POST['password'];

if (!empty($useremail) || !empty($userpassword)){
    //create a conection 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "zuritask6";

   
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection

    if ($conn->connect_error) {

        die("Connection failed: " . $conn->connect_error);

    }else{
      
        // Check if the inputs provided exist in the DB
         $user_check_query = "SELECT * FROM users WHERE email = '$useremail' LIMIT 1";

         $user_e = mysqli_query($conn, $user_check_query);

         if (mysqli_num_rows ($user_e) > 0){

             //session message account exist please login
             $_SESSION['message'] = "Email exist please Login";
             header("location: index.php");

        }else{
             //input the provided inputs to the database

            $query = "INSERT INTO users (email, password) 
                        VALUES ('$useremail', '$userpassword')";
            
            $result = mysqli_query($conn, $query);
            
            //session message and redirect user to loginpage
            $_SESSION['message'] = "Account is created please Login"; 

            header("location: login.php");

        }

    }

    $conn->close();


}else {
    //prompt the user to fill in all the fields
    $_SESSION['error'] = "Please fill in all the fields";
    header("location: index.php");
}

?>
