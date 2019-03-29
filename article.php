<?php include 'header.php'; ?>
<div class="container">
    <div class="px-2 py-2 text-center">
        <?php
            if (isset($_GET['id'])) {
                $articleID = test_input($_GET['id']);
                $sql = "SELECT * FROM article WHERE id ='$articleID'";
                $result = $conn->query($sql);
                if ($result->num_rows != 0) {
                    while ($rows = $result->fetch_assoc()) {
                        ?>
                            <h1><?php echo $rows['title']; ?></h1>
        <p><?php echo $rows['post'] ?></p>
        <div>
    <img class="img-fluid" src="<?php echo $rows['img'] ?>">
    </div>
    <footer>
                        <p class="float-left my-2 btn btn-primary">published on:  <?php echo $rows['articledate'] ?></>
    </footer>
    <br>
    
                        <?php
                    }
                }
            }
        ?>
    </div>
</div>
<?php include 'footer.php'; ?>