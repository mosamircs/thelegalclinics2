<?php
       require_once("header.php");
       require_once ("database.php");
       $database_instance = Database::getInstance();
       $connection = $database_instance->getConnection();  //connect to the database

       global $formdata;

       $formdata = array();

       if (isset($_POST["username"])) {
           $formdata["username"] = $_POST["username"];
       }
       if (isset($_POST["email"])) {
           $formdata["email"] = $_POST["email"];
           $sql = "SELECT * FROM users where email='".$formdata["email"]."'";

           $result = $connection->query($sql);
        //    $result = mysqli_query();
            $num_rows = mysqli_num_rows($result);
            if($num_rows >= 1){
                // echo "email exist";
            }else{
                $email = $formdata["email"];
                 $sql = "SELECT * FROM users where email='".$formdata["email"]."'";
                 $result = $connection->query($sql);
                // echo "Thank you for Submitting. Redirecting back to Home Page";
            }
       }
       if (isset($_POST["phone"])) {
           $formdata["phone"] = $_POST["phone"];
           $sql = "SELECT * FROM users where phone='".$formdata["phone"]."'";
        //    $result = mysqli_query();
           $result = $connection->query($sql);

           $num_rows = mysqli_num_rows($result);
           if($num_rows >= 1){
               // echo "email exist";
           }else{
             $phone = $formdata["phone"];
             $sql = "SELECT * FROM users where phone='".$formdata["phone"]."'";
             //    $result = mysqli_query();
                $result = $connection->query($sql);
            //    $sql = mysqli_query ("INSERT INTO users (phone) VALUES ('$phone')");
               // echo "Thank you for Submitting. Redirecting back to Home Page";
           }
       }


       
    if (isset($formdata["username"])&&isset($formdata["email"])&&isset($formdata["phone"])) {
        $insert_user = "INSERT INTO `users` (`name`, `email`, `phone`) VALUES ('".$formdata["username"]."', '".$formdata["email"]."', '".$formdata["phone"]."')";        
        $result = $connection->query($insert_user);

        $last_id = $connection->insert_id;
        $data = array(
            'status' => 200,
            'id' => $last_id
        );
        echo json_encode($data);
        header("Content-type: application/json");
        // echo json_encode($data);
        exit();
    }
?>


