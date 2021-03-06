<?php 

function db() {
    return new PDO("mysql:host=localhost;dbname=rag","root","");
}

function registerUser($fname, $lname, $gender, $bdate, $address, $contactno, $email, $password, $type, $status, $account) {
    $db = db();
    $sql = "INSERT INTO users (fname, lname, gender, bdate, address, contactno, email, password, type, status, account) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($fname, $lname, $gender, $bdate, $address, $contactno, $email, $password, $type, $status, $account));
    $db = null;

    return "Registration Success";
}

function checkVerified($id) {
    $db = db();
    $sql = "SELECT * FROM users WHERE id = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($id));
    $row = $cmd->fetchAll();
    $db = null;

    return $row;
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

function getGadgetId($id) {
    $db = db();
    $sql = "SELECT gadgets.owner_id, gadgets.g_id, gadgets.g_pic, gadgets.g_model, 
            gadgets.g_brand, gadgets.g_price, gadgets.g_desc, gadgets.g_category,
            users.fname, users.lname, users.address, users.contactno FROM gadgets
            LEFT JOIN users ON gadgets.owner_id = users.id
            WHERE g_id = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($id));
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

function sendVerification( $id, $file, $status) {
    $db = db();
    $sql = "INSERT INTO validation (user_id, val_pic, val_status) VALUES (?,?,?)";
    $cmd = $db->prepare($sql);
    $cmd->execute(array( $id, $file, $status ));
    $db = null;

    return "Verification Sent";
}

function addToCart($gad_id, $owner_id, $user_id, $tran_status){
    $db = db();
    $sql = "INSERT INTO transaction (gad_id, owner_id, user_id, tran_status) VALUES (?,?,?,?)";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($gad_id, $owner_id, $user_id, $tran_status));
    $db = null;

    return "Added to Cart";
}

function getTransaction($user_id) {
    $db = db();
    $sql = "SELECT tran_id, tran_date, tran_status, 
            gadgets.g_model, gadgets.g_brand, gadgets.g_price,
            users.fname, users.lname FROM transaction 
            LEFT JOIN gadgets ON transaction.gad_id = gadgets.g_id 
            LEFT JOIN users ON transaction.owner_id = users.id 
            WHERE user_id = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($user_id));
    $row = $cmd->fetchAll();
    $db = null;

    return $row;
}

function trapValidation($user_id) {
    $db = db();
    $sql = "SELECT * FROM validation WHERE user_id = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($user_id));
    $row = $cmd->fetchAll();
    $db = null;

    return $row;
}

function cancelTransaction($id) {
    $db = db();
    $sql = "DELETE FROM transaction WHERE tran_id = ?";
    $cmd = $db->prepare($sql);
    $cmd->execute(array($id));
    $db = null;

    return "Canceled";
}

?>