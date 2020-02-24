<?php 

function db() {
    return new PDO("mysql:host=localhost;dbname=rag","root","");
}

function registerUser($fname, $lname, $gender, $bdate, $address, $contactno, $email, $password, $type, $status) {
    $db = db();
    $sql = "INSERT INTO users (fname, lname, gender, bdate, address, contactno, email, password, type, status) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($fname, $lname, $gender, $bdate, $address, $contactno, $email, $password, $type, $status));
    $db = null;

    return "Registration Success";
}

function getUserProfile($fetch_id) {
    // session_start();
    $db = db();
    $sql = "SELECT * FROM users WHERE id = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($fetch_id));
    $row = $cmd->fetchAll();
    $db = null;

    return $row;
}

function getUserUpdate($id) {
    $db = db();
    $sql = "SELECT * FROM users WHERE id = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($id));
    $row = $cmd->fetchAll();
    $db = null;

    return $row;
}

function updateUserInfo($gender, $address, $contactno, $id) {
    $db = db();
    $sql = "UPDATE users SET gender = ?, address = ?, contactno = ? WHERE id = ?"; 
    $cmd = $db->prepare($sql);
    $cmd->execute(array($gender, $address, $contactno, $id));
    $db = null;

    return "UPDATED";
}

function getUserEmail($id) {
    $db = db();
    $sql = "SELECT * FROM users WHERE id = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($id));
    $row = $cmd->fetchAll();
    $db = null;

    return $row;
}

function updateUserEmail($email, $id) {
    $db = db();
    $sql = "UPDATE users SET email = ? WHERE id = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($email, $id));
    $db = null;

    return "UPDATED";
}

function updateUserPassword($password, $id) {
    $db = db();
    $sql = "UPDATE users SET password = ? WHERE id = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($password, $id));
    $db = null;

    return "UPDATED";
}

function getAllGadget() {
    $db = db();
    $sql = "SELECT * FROM gadgets";
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $row = $cmd->fetchAll();
    $db = null;

    return $row;
}

function updateProfileImage($profile, $id) {
    $db = db();
    $sql = "UPDATE users SET pro_pic = ? WHERE id = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($profile, $id));
    $db = null;

    return "UPDATED";
}

?>