<?php
session_start();
include("../../config.php");

$userId = $_SESSION['userId']; 
$keyword = '%' . $_GET["query"] . '%'; 
$sql = "SELECT DISTINCT
    u.userId,
    u.firstName,
    u.lastName,
    u.email,
    c.courseName,
    CASE
        WHEN mentor.userId IS NOT NULL THEN 'Mentor'
        WHEN mentee.userId IS NOT NULL THEN 'Mentee'
    END AS role
FROM
    user u
JOIN
    mentorshipcourseregistration mcr ON u.userId = mcr.mentorId
JOIN
    course c ON mcr.courseId = c.courseId
LEFT JOIN
    mentor ON u.userId = mentor.userId
LEFT JOIN
    mentee ON u.userId = mentee.userId
WHERE
    (
        mcr.courseId IN (
            SELECT courseId FROM mentorshipcourseregistration WHERE mentorId = $userId
            UNION
            SELECT courseId FROM menteecourseregistration WHERE menteeId = $userId
        )
        OR
        mentor.userId IN (
            SELECT mentorId FROM mentorshipcourseregistration WHERE courseId IN (
                SELECT courseId FROM mentorshipcourseregistration WHERE mentorId = $userId
                UNION
                SELECT courseId FROM menteecourseregistration WHERE menteeId = $userId
            )
        )
        OR
        mentee.userId IN (
            SELECT menteeId FROM menteecourseregistration WHERE courseId IN (
                SELECT courseId FROM mentorshipcourseregistration WHERE mentorId = $userId
                UNION
                SELECT courseId FROM menteecourseregistration WHERE menteeId = $userId
            )
        )

        OR u.firstName LIKE ?
        OR u.lastName LIKE ?
        OR c.courseName LIKE ?
    )

    AND u.userId != $userId";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Error in prepared statement: " . $conn->error;
    exit();
}


$stmt->bind_param("sss", $keyword, $keyword, $keyword);


$stmt->execute();


$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $mentors = array();
    while ($row = $result->fetch_assoc()) {
        $mentors[] = $row;
    }
    echo json_encode($mentors);
} else {
    echo json_encode(array());
}

$stmt->close();
$conn->close();

?>
