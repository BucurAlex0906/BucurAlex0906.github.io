<?php

include('includes/functions.php');

$conn = db_connect();

$review_data = array(
      'show_reviews_form' => false
);

if (!$conn) {
      //die("Connection failed: " . mysqli_connect_error());
      $review_data['show_reviews_form'] = false;
}

$sql = "CREATE TABLE IF NOT EXISTS reviews(
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      firstname tinytext NOT NULL,
      lastname tinytext NOT NULL,
      email varchar(100) NOT NULL,
      review TEXT NOT NULL
      )";

if(mysqli_query($conn, $sql)){
      //$sqp_data = "SELECT firstname, lastname, email, review FROM reviews";
      //$review_list = mysqli_query($conn, $sql_data);
      
      $review_data ['show_reviews_form'] = true;

      if(isset($_POST['reviews_form'])){
            $sql = "INSERT INTO reviews (firstname, lastname, email, review)
            VALUES ('".$_POST['firstname']."', '". $_POST['lastname']."', '". $_POST['email']."', '". $_POST['review']."')";
      
            if(mysqli_query($conn, $sql)){
                  $review_data['show_reviews_form'] = false;
                  $review_data['alert'] = 'success';
                  $review_data['message'] = 'The form was sent successfully';
            }else{
                  $review_data['alert'] = 'danger';
                  $review_data['message'] = 'The form wasn&#39t sent successfully';
            }
      }
}

?>

<?php if(isset($review_data['message']) && isset($review_data['alert'])) { ?>
<div class="d-flex justify-content-center mb-3">
      <div class="alert text-center col-lg-6 my-3 alert-<?php echo $review_data['alert']; ?>" role="alert">
            <?php echo $review_data['message']; ?>
      </div>
</div>
<?php } ?>

<?php if($review_data['show_reviews_form'] == true){ ?>
      <div class="container my-4 py-4">
            <div class="d-flex justify-content-center mb-3">
                  <form class="row g-3 col-lg-6 shadow-lg bg-dark-80 cardpres" action="" method="POST" >
                        <div class="col-md-6 text-white">
                              <label for="firstname" class="form-label">First Name</label>
                              <input type="text" id="firstname" class="form-control" placeholder="First name" aria-label="First name" name="firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname']?>" required>
                        </div>
                        <div class="col-md-6 text-white">
                              <label for="lastname" class="form-label">Last Name</label>
                              <input type="text" id="lastname" class="form-control" placeholder="Last name" aria-label="Last name" name= "lastname" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname']?>" required>
                        </div>
                        <div class="col-12 text-white">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']?>" required>
                        </div>
                        <div class="form-floating">
                              <textarea class="form-control" placeholder="Leave a comment here" id="review" name="review" style="height: 100px" required><?php if(isset($_POST['review'])) echo $_POST['review']?></textarea>
                              <label for="review">Comments</label>
                        </div>
                        <div class="col-12 text-white">
                              <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck" name="gridCheck" value="gridCheck" required>
                                    <label class="form-check-label" for="gridCheck">
                                          Check me out
                                    </label>
                              </div>
                        </div>
                        <div class="col-12 text-center">
                              <input type="submit" class="btn btn-success" name="reviews_form" value="Send">
                        </div>
                  </form>
            </div>
      </div>
<?php } ?>