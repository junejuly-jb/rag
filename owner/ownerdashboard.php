<?php
    session_start();
    $id = $_SESSION['id'];

    require '../dbowner/db.php';
    $sql = "SELECT * FROM gadgets WHERE owner_id =".$id;
    $result = mysqli_query($con, $sql);
    $rows = mysqli_num_rows($result);

    $sql1 = "SELECT * FROM users WHERE id=".$id;
    $result1 = mysqli_query($con, $sql1);
    while ($data = mysqli_fetch_assoc($result1)) {
        $pro_pic = $data['pro_pic'];
        $account = $data['account'];
    }

    $sql2 = "SELECT * FROM validation WHERE user_id = ".$id;
    $result2 = mysqli_query($con, $sql2);
    $rows1 = mysqli_num_rows($result2);
    while($data = mysqli_fetch_assoc($result2)){
        $val_status = $data['val_status'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAG</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/favicon.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
</head>
<body style="transition: 0.5s">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
  <a class="navbar-brand" href="ownerdashboard.php"><img src="../assets/images/logo.png" alt="" width="100"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="ownerdashboard.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="owner_transaction.php" id="view2">Transactions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="devices.php" id="view1">My Devices</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="owner_profile.php">Profile</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="../signout.php">Signout</a>
      </li>
    </ul>
  </div>
</div>
</nav>

<main>
    <input type="text" id="stats" value="<?php echo $val_status;?>" hidden>
    <?php
        if ($rows1 > 0) {
            if ($val_status === 'pending') {
            echo "<div class='container alert alert-primary alert-dismissible fade show' role='alert'>
            <strong>Attention!</strong> Requirements sent! Please wait for admin verification.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }
            else {
                echo "";
            }
        }
        else {
            echo "";
        }
        
        if (!$pro_pic) {
           echo "<div class='container alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Warning!</strong> Change your profile picture for security purposes. <a href='editpic.php' class='btn btn-warning btn-sm text-white'>Change Profile Picture</a>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }
        else {
            echo "";
        }
        if ($account === 'unverified') {
            echo "<div class='container alert alert-warning alert-dismissible fade show' role='alert' id='alertHide'>
            <strong>Warning!</strong> Validate your account to unlock some features. <a href='validate.php' class='btn btn-warning btn-sm text-white'>Validate Now</a>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }else{
            echo "";
        }
    ?>
    <input type="text" id="hidden" value="<?php echo $account ?>" hidden>
    <div class="container" id="view">
        <div class="row">
            <div class="col m-auto">
                <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Gadgets</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><span class="badge badge-danger"><?php echo $rows;?></span> registered devices</h6>
                    
                    <div class="text-center py-3"><img src="../assets/images/smartphone.svg" alt="" width="150"></div>
                    <a href="devices.php" class="btn btn-primary btn-block mt-2">View</a>
                </div>
                </div>
            </div>
            <div class="col m-auto">
                <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Transactions</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><span class="badge badge-danger">2</span> on going transaction</h6>
                    
                    <div class="text-center py-3"><img src="../assets/images/transfer.svg" alt="" width="150"></div>
                    <a href="#" class="btn btn-primary btn-block mt-2">View</a>
                </div>
                </div>
            </div>
            <div class="col m-auto">
                <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Approval Requests</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><span class="badge badge-danger">9</span> approval request</h6>
                    
                    <div class="text-center py-3"><img src="../assets/images/request.svg" alt="" width="150"></div>
                    <a href="#" class="btn btn-primary btn-block mt-2">View</a>
                </div>
                </div>
            </div>
        </div>
        <div class="row mt-2 mb-5">
            <div class="col m-auto">
                <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Finished</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><span class="badge badge-danger">20</span> Finished Transactions</h6>
                    
                    <div class="text-center py-3"><img src="../assets/images/tick.svg" alt="" width="150"></div>
                    <a href="#" class="btn btn-primary btn-block mt-2">View</a>
                </div>
                </div>
            </div>
            <div class="col m-auto">
                <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Revenue</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Check your revenue</h6>
                    
                    <div class="text-center py-3"><img src="../assets/images/money.svg" alt="" width="150"></div>
                    <a href="#" class="btn btn-primary btn-block mt-2">View</a>
                </div>
                </div>
            </div>
            <div class="col m-auto">
                <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Cancelled Transactions</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><span class="badge badge-danger">20</span> Cancelled transactions</h6>
                    
                    <div class="text-center py-3"><img src="../assets/images/cancel.svg" alt="" width="150"></div>
                    <a href="#" class="btn btn-primary btn-block mt-2">View</a>
                </div>
                </div>
            </div>
        </div>
    </div>

</main>
<script type="text/javascript" src="../assets/js/jquery.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.bundle.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.bundle.js.map"></script>
<script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.bundle.min.js.map"></script>
<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.js.map"></script>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.min.js.map"></script>
<script>
var hidden = document.getElementById("hidden").value;
if(hidden === "unverified") {
    document.getElementById("view").hidden = true;
    document.getElementById("view1").hidden = true;
    document.getElementById("view2").hidden = true;
} else {
    document.getElementById("view").hidden = false;
    document.getElementById("view1").hidden = false;
    document.getElementById("view2").hidden = false;
}

var stats = document.getElementById("stats").value;
if (stats === 'pending') {
    document.getElementById("alertHide").hidden = true;
}
else{
    document.getElementById("alertHide").hidden = false;
}
</script>
</body>
</html>