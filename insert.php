<?php

if(isset($_POST['submit_btn']))
{
$Name = $_POST['Name'];
$Email = $_POST['Email'];
$Number = $_POST['Number']
$Massage = $_POST['Massage']
}

if (!empty($Name)|| !empty($Email) || !empty($Number) || !empty($Massage))
{
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword ="";
    $dbname="Register";

    //create connection 

    $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

    if (mysqli_connect_error())
    {
        die('Connect Error('. mysqli_connect_error() .')'. mysqli_connect_error());
    }
    else
    {
        $SELECT = "SELECT Email From Register Where Email = ? Limit 1 ";
        $INSERT = "INSERT Into Register (Name,Email,Number,Massage) values (?,?,?,?)";

        //prepare statement
        $stmt = $conn -> prepare($SELECT);
        $stmt->bind_param("s",$Email);
        $stmt->execute();
        $stmt->bind_result($Email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum==0)
        {
            $stmt -> close();
            $stmt = $conn->prepare($INSERT);
            $stmt ->blind_param("ssis",$Name,$Email,$Number,$Massage);
            $stmt->execute();
            echo "New Record Inserted Sucessfully";
        }
    }
    $stmt->close();
    $conn->close();
}
else
{
    echo"All field are required ";
    die();
}

?>