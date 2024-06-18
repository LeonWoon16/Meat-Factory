<?php
    require_once 'database.php';

    if (isset($_SESSION['isLogin'])){
        header("LOCATION: index.php");
    }

    if (isset($_POST['inputEmail']) && isset($_POST['inputPass'])) {
        $userEmail = htmlspecialchars($_POST['inputEmail']);
        $userPass = $_POST['inputPass'];

        if (empty($userEmail) || empty($userPass)) {
            $_SESSION['error'] = 'Input email and password to login';
        } else {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a179904_pt2 WHERE (fld_staff_email = :staffEmail) LIMIT 1");
            $stmt->bindParam(':staffEmail', $userEmail);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (isset($user['fld_staff_email'])) {
                if ($user['fld_staff_password'] == $userPass) {
                    unset($user['fld_staff_password']);
                    $_SESSION['isLogin'] = true;
                    $_SESSION['userInfo'] = $user;
                    header("LOCATION: index.php");
                    exit();
                } else {
                    $_SESSION['error'] = 'Wrong password';
                }
        } else {
            $_SESSION['error'] = 'Account does not exists.';
        }
    }

    header("LOCATION: " . $_SERVER['REQUEST_URI']);
    exit();
    }
?>