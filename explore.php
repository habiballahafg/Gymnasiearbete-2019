<?php include 'header.php'; ?>
    <div class="container">
<?php
$sql = "SELECT * FROM article";
$result = $conn->query($sql);
if ($result->num_rows != 0) {
    while ($rows = $result->fetch_assoc()) {
        ?>
        <div class="jumbotron jumbotron-fluid px-2 article">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 float-left">
                        <img width="220px" height="150px" src="<?php echo $rows['img'] ?>"
                             alt="<?php echo $rows['title'] ?>">
                    </div>
                    <div class="col-sm-9 ">
                        <h1><?php echo $rows['title'] ?></h1>
                        <p class="text"><?php echo substr($rows['post'], 0, 300); ?></p>
                        <footer>
                            <button class="btn btn-primary float-right"><a href="article.php?id=<?php echo $rows['id'] ?>"
                                                                           class="text-white">Read More</a></button>
                        </footer>
                    </div>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
        <?php
    }
}
?>
    
<?php include 'footer.php'; ?>