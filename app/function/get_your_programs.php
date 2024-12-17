<?php
session_start();
function isMentor($conn,$userId){

    $sql = "SELECT * FROM mentor where userId =$userId";

    $result = $conn->query($sql);

    if($result->num_rows>0){

        echo "<div class='details'>
        p> Mentor </p>
        <p>Status : registered </p>
        <button class='mentor'>Withdraw</button>
 </div> ";

    }

    else{

        echo "<div class='details'>
        <p>Mentor </p>
        <p>Status : unregistered </p>
        <button onclick= 'registerMentor($userId)'>register</button>
 </div> ";


    }
}


function isMentee($conn,$userId){

    $sql = "SELECT * FROM mentee where userId =$userId";

    $result = $conn->query($sql);

    if($result->num_rows>0){

        echo "<div class='details'>
        <p> Mentee</p>
        <p>Status : registered</p>
        <button class='mentee'>Withdraw</button>
 </div> ";

    }
    else{


        echo "<div class='details'>
        <p> Mentee </p>
        <p>Status : unregistered </p>
        <button onclick= 'registerMentee($userId)'>register</button>
 </div> ";


    }

}


function displayCourse($conn){

$sql = "SELECT * FROM course"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

       echo '<option name = "courseId"  value=' . $row['courseId'] . '>'.$row['courseName'].'  '.$row['courseLevel'].' </option>';
        
    }
}
}


function displayCourseMentoring($conn,$userId){

    

    $sql = "SELECT course.courseId, course.courseName, course.courseLevel FROM course  INNER JOIN mentorshipcourseregistration ON course.courseId = mentorshipcourseregistration.CourseId WHERE mentorshipcourseregistration.mentorId =$userId"; 
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
    
           echo '<option name = "courseId"  value=' . $row['courseId'] . '>'.$row['courseName'].'  '.$row['courseLevel'].' </option>';
            
        }
    }

}


function displayCourseMenteeing($conn,$userId){

    

    $sql = "SELECT course.courseId, course.courseName, course.courseLevel FROM course  INNER JOIN menteecourseregistration ON course.courseId = menteecourseregistration.CourseId WHERE menteecourseregistration.menteeId =$userId"; 
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
    
           echo '<option name = "courseId"  value=' . $row['courseId'] . '>'.$row['courseName'].'  '.$row['courseLevel'].' </option>';
            
        }
    }

}






