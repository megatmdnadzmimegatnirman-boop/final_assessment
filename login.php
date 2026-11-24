<?php
include 'db.php';

if (isset($_POST['login'])) {
    $username = $_POST['name'];
    $password = $_POST['password'];

  if ($username == "" || $password == "") {
    $error = "Please fill in all fields.";
    }else {
        $sql = $conn->prepare("SELECT * FROM users WHERE username = '$username'");
        $sql->execute();
        $user = $sql->get_result()->fetch_assoc();

        if($user && password_verify($password, $user['password'])) {
         $_SESSION['user_id'] = $user['id'];
         $_SESSION['name'] = $user['name'];
         header("Location: index.php");
         exit();

        } else {
            $error = "Invalid name or password.";
    
  }
}

}

?>


<h2> STUDENT GRADING SYSTEM</h2>

<h3>Login</h3>
<form method="post">
    <label for="name">name:</label>
    <input style="width: 200px;" type="text" name="name" placeholder="USE NAME NOT PASSWORD"><br><br>

    <label for="password">Password:</label>
    <input style="width: 200px;" type="password" name="password" placeholder="only password not email"><br><br>

    <input type="submit" >Login</button>
</form>