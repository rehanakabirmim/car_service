<?php
require_once("functions/function.php");
needLogged();
if($_SESSION['role']=='1'){
get_header();
get_sitebar();
$id = $_GET['e'];
$selupd = "SELECT * FROM users WHERE user_id = $id";
$Q = mysqli_query($con, $selupd);
$data = mysqli_fetch_assoc($Q);

if (!empty($_POST)) {
  // print_r($_POST);
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $image = $_FILES['pic'];




  $update = "UPDATE users SET user_name=' $name', user_phone='$phone',user_email='$email',role_id='$role' WHERE user_id='$id'";
  if (!empty($name)) {
    if (!empty($email)) {
      if (!empty($role)) {
        if (mysqli_query($con, $update)) {

          // echo " successfully update user information.";
          if ($image['name'] != '') {
            $imageName = 'user_' . time() . '_' . rand(100000, 1000000) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
            $updimage = "UPDATE users SET user_image='$image' WHERE user_id='$id'";
            if (mysqli_query($con, $updimage)) {
              move_uploaded_file($image['tmp_name'], 'uploads/' . $imageName);
            }
              header('Location:view-user.php?v=' . $id);
            } else {
              "User image update failed";
            }
          
          header('Location:view-user.php?v=' . $id);
        } else {
          echo "oops! User information update failed!";
        }
      } else {
        echo "Please select  user role.";
      }
    } else {
      echo "Please enter your email adress.";
    }
  
  } else {
    echo "Please enter your name.";
  }
  }



?>



<div class="row">
  <div class="col-md-12 ">
    <form method="POST" action="" enctype="multipart/form-data">
      <div class="card mb-3">
        <div class="card-header">
          <div class="row">
            <div class="col-md-8 card_title_part">
              <i class="fab fa-gg-circle"></i>UPDATE USER INFORMATION
            </div>
            <div class="col-md-4 card_button_part">
              <a href="all-user.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All User</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Name<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="name" value="<?= $data['user_name']; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Phone:</label>
            <div class="col-sm-7">
              <input type="text" class="form-control form_control" id="" name="phone" value="<?= $data['user_phone']; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Email<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
              <input type="email" class="form-control form_control" id="" name="email" value="<?= $data['user_email']; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Username<span class="req_star">*</span>:</label>
            <div class="col-sm-7">
          <input type="text" class="form-control form_control" id="" name="username" value="<?= $data['user_username']; ?>" disabled>
             </div>
          </div>  


          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">User Role<span class="req_star">*</span>:</label>
            <div class="col-sm-4">
              <select class="form-control form_control" id="" name="role">
                <option value="">Select Role</option>
                <?php
                $selr = "SELECT * FROM roles ORDER BY role_id ASC";
                $Qr = mysqli_query($con, $selr);
                while ($urole = mysqli_fetch_assoc($Qr)) {
                ?>
                  <option value="<?= $urole['role_id']; ?>" <?php if ($urole['role_id'] == $data['role_id']) {echo 'selected';}
                                                              
                    ?>><?= $urole['role_name']; ?></option>

                <?php } ?>

              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label col_form_label">Photo:</label>
            <div class="col-sm-4">
              <input type="file" class="form-control form_control" id="" name="pic">
            </div>
          </div>
        </div>
        <div class="col-md-2 offset-5">
          <?php if ($data['user_photo'] != '') { ?>
            <img height="50" class="img200" src="uploads/<?= $data['user_photo']; ?>" alt="user" />
          <?php } else { ?>

            <img height="50" src="images/avatar.jpg" alt="avatar" />
          <?php } ?>
        </div>
        <div class="card-footer text-center">
          <button type="submit" class="btn btn-sm btn-dark">UPDATE</button>
        </div>
        <?php
        get_footer();
      }else{
        header('Location:index.php');
      }
        ?>