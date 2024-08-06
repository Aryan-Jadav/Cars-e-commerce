<?php include 'header.php';?>
<main>
  <div class="container">
    <h1>Latest News</h1>
    <div class="row">
      <?php
      include 'admin/db.php';
      // Retrieve data from database in descending order by date
      $sql = "SELECT *, DAY(news_date) AS day, MONTH(news_date) AS month FROM news ORDER BY news_date DESC";
      $result = mysqli_query($conn, $sql);

      // Loop through results and generate HTML for each card
      while ($row = mysqli_fetch_assoc($result)) {
        $months = array("1" => "Jan", "2" => "Feb", "3" => "Mar", "4" => "Apr", "5" => "May", "6" => "Jun", "7" => "Jul", "8" => "Aug", "9" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");
        $month_name = $months[$row['month']];
        ?>
        <div class="col-md-3">
          <div class='post-module'>
            <div class='thumbnail'>
              <div class='date'>
                <div class='day'><?= $row['day'] ?></div>
                <div class='month'><?= $month_name ?></div>
              </div>
              <img src="admin/Add news/<?= $row['image'] ?>">
            </div>
            <div class='post-content'>
              <div class='category'>photos</div>
              <h1 class='title'><?= $row['title'] ?></h1>
              <h2 class='sub-title'><?= $row['sub_title'] ?></h2>
              <p class='description'><?= $row['description'] ?></p>
            </div>
          </div>
        </div>
        <?php
      }
      // Close database connection
      mysqli_close($conn);
      ?>
    </div>
  </div>
</main>
<?php include 'footer.php';?>