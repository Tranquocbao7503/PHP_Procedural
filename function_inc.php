<?php

function emptyInputSignup($name, $eamil, $userName, $pwd, $pwdRepeat)
{
    $result = true;

    if (empty($name) || empty($eamil) || empty($userName || empty($pwd) || empty($pwdRepeat))) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function invalidUid($userName)
{
    $result = true;

    if (!preg_match("/^[a-zA-Z0-9]*$/", $userName)) {

        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function invalidEmail($email)
{
    $result = true;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function pwdMatch($pwd, $pwdRepeat)
{
    $result = true;

    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function uIDExits($connection, $userName, $email)
{ // Truy vấn để kiểm tra UID hoặc email có tồn tại trong cơ sở dữ liệu hay không

    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    // tạo sẵn một khuôn dòng lệnh truy vấn SQL đối tượng là usersUid và usersEmail, và dấu '?' đại diện cho các giá trị được truyền vào câu truy vấn

    $stmt = mysqli_stmt_init($connection);
    // khởi tạo đối tượng statement (câu lệnh) cho việc thực thi truy vấn SQL

    // Chuẩn bị prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // hàm mysql_stmt_prepare có vai trò :  + kiểm tra cú pháp câu truy vấn SQL
        //                                      + chuẩn bị câu lệnh truy vấn  msql gửi câu lệnh đến database 
        //                                      + gán câu lệnh truy cấn cho đối tượng $stmt
        header("location: signup.php?error=stmtfailed");
        exit();
    }

    // gán giá trị vào tham số của đối tượng câu lệnh $stmt
    mysqli_stmt_bind_param($stmt, "ss", $userName, $email);

    // Thực thi câu lệnh SQL
    mysqli_stmt_execute($stmt);

    // Lấy kết quả từ prepared statement, hàm trả về một đối tượng stmt
    $resolveData = mysqli_stmt_get_result($stmt);

    // Kiểm tra kết quả , nếu đúng sẽ trả về một asociative array
    if ($row = mysqli_fetch_assoc($resolveData)) {
        // Nếu có dòng dữ liệu trả về, trả về dòng đầu tiên
        return $row;
    } else {
        // Nếu không có dòng dữ liệu trả về, trả về false
        $result = false;
        return $result;
    }

    // Đóng prepared statement
    mysqli_stmt_close($stmt);
}


function createUser($connection, $name, $email, $userName, $pwd)
{
    // để check UID exist hay không, ta phải truy cập vào data base để kiểm tra 
    $sql = "INSERT INTO users (userName,userEmail,userUid,userPwd) VALUE (?,?,?);";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: signup.php?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $userName, $hashedPwd);
    mysqli_stmt_execute($stmt);
    header("location: signup.php?error=usernametaken");
    exit();
}