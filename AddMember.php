<?php
    $FirstName = $_POST["FirstName"];
    $LastName = $_POST["LastName"];
    $Gender = $_POST["Gender"];
    $address = $_POST["address"];
    $contact = $_POST["contact"];
    $Type = $_POST["Type"];
    $yearlevel = $_POST["yearlevel"];
    $status = $_POST["status"];
    $conn = new mysqli("localhost","root","","library"); 
    if($conn->connect_error){
        echo "Connection error";
        exit();
    }
    $sql = "SELECT MAX(Member_ID) as max_id FROM member";
    $MaxID_query = $conn->query($sql);
    while($row = $MaxID_query->fetch_array()){
    $NewID = (int)$row[0] + 1;
    }
    $stmt = $conn->prepare("INSERT INTO member(Member_ID,FirstName,LastName,Gender,Address,Contact,Type,YearLevel,Status) Values(?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("issssisss", $NewID,$FirstName,$LastName,$Gender,$address,$contact,$Type,$yearlevel,$status);
    $stmt->execute();
    header("location: librarypage.php?addmem=InsertComplete");
?>