<?php
include "db.php";
include 
"header.php";

//fallback, ?? equal to if else
$id = $_GET['id'] ?? 0;
?>

<?
$sql = $conn->prepare("SELECT * FROM results WHERE id = $id");

$sql->execute();

$row = $sql->get_result()->fetch_assoc();
//$row = lid,student_name,matric_number,subject_name,subject_code,test1,test2,final_exam,total_marks,grade

$student_name = $row['student_name'];
$matric_number = $row['matric_number']; 
$subject_name = $row['subject_name'];
$subject_code = $row['subject_code'];
$test1 = $row['test_1'];
$test2 = $row['test_2'];
$final_exam = $row['final_exam'];

if (isset($_POST['submit'])) {
    $student_name = $_POST['student_name'];
    $matric_number = $_POST['matric_number'];
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code'];
    $test1 = $_POST['test_1'];
    $test2 = $_POST['test_2'];
    $final_exam = $_POST['final_exam'];

    $total = $test1 + $test2 + $final_exam;

    if ($total >= 80) {
        $grade = "A";
    } elseif ($total >= 65) {
        $grade = "B";
    } elseif ($total >= 50) {
        $grade = "C";
    } elseif ($total >= 40) {
        $grade = "D";
    } else {
        $grade = "E";
    }

   $sql = $conn->prepare("UPDATE results SET 
   student_name='$student_name', 
   matric_number='$matric_number',
   subject_name='$subject_name', 
   subject_code='$subject_code',
    test1=$test1,
   test2=$test2,
    final_exam=$final_exam, 
    total_marks=$total, 
    grade='$grade' 
    WHERE id=$id");

   if ($sql->execute()) {
    header("Location: index.php");
   }
}

?>




