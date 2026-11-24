<?php
include "header.php";
include "db.php";   

if (isset($_POST['submit'])) {
    $student_name = $_POST['student_name'];
    $matric_number = $_POST['matric_number'];
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code'];
    $test1 = $_POST['test1'];
    $test2 = $_POST['test2'];
    $final = $_POST['final'];  

$total = $test1 + $test2 + $final;
//80-100-A
//60-79-B

    if ($total >= 70) {
        $grade = "A";
    } elseif ($total >= 60) {
        $grade = "B";
    } elseif ($total >= 50) {
        $grade = "C";
    } elseif ($total >= 40) {
        $grade = "D";
    } else {
        $grade = "E";
    }

    
   $sql = $conn->prepare
   ("INSERT INTO results (student_name, matric_number,subject_name,subject_code,
    test1, test2, final,total,grade) VALUES
    ('$student_name','$matric_number','$subject_name','$subject_code',
   $test1,$test2,$final,$total,'$grade')");

   if ($sql->execute()) {
    header("Location: index.php");
   }
}   
    
     $student_name = "";
    $matric_number = "";
    $subject_name = "";
    $subject_code = "";
    $test_1 = "";
    $test_2 = "";
    $final = "";

    ?>


?>
<style>
    label {
        display: inline-block;
        width: 150px;
    }
</style>

<h2>ADD RESULTS</h2>

<?php
include "form.php";
include "footer.php";

?>

   
    