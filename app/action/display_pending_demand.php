<?php
session_start();
include("../../config.php");

function getMentorData($conn, $mentorId) {
    $mentorData = array();

    $sql = "SELECT firstName, lastName, email, matchingId FROM user INNER JOIN  matching ON  user.userId = matching.mentorId  WHERE matching.menteeId = ? And matching.status = 'Pending'" ;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $mentorId);
    $stmt->execute();
    $result = $stmt->get_result();
       $mentorData = array();
    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()){

            $mentorData[] = $row;
    
           };
      
    }

    return $mentorData;
}


if (isset($_SESSION['userId'])) {
  
    $mentorId =$_SESSION['userId'] ;

    $mentorData = getMentorData($conn, $mentorId);

    echo json_encode($mentorData);
} else {
   
    echo json_encode(array("error" => "User not logged in"));
}

$conn->close();
?>