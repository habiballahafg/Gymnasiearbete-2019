https://getbootstrap.com/docs/4.0/components/carousel/

The above link will be used for adding slider in the index page.

https://getbootstrap.com/docs/4.0/components/list-group/#javascript-behavior

The above link will be used for profile page.


Articles:
<div class="jumbotron jumbotron-fluid px-2 article">
    <div class="container">
    
    <h1>Fluid jumbotron</h1>
    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
    <footer>
        <button class="btn btn-primary float-right">Read More</button>
    </footer>
    </div>
</div> 


The article page: 

if (isset($_GET['id'])){
    $articleID = test_input($_GET['id']);
    $sql = "SELECT * FROM article WHERE id = '$articleID'";
    $result = $conn->query($sql);
    if ($result->num_rows != 0) {
        while ($rows = $result->fetch_assoc()) {
            ?>
                
            <?php
        }
    } else {
        echo "The article you are looking for is not found.";
    }
} else {
    header("Location: explore.php");
}


Article: 

<h1>Hello World</h1>
        <p>Below is a sample of “Lorem ipsum dolor sit” dummy copy text often used to show font face samples, for page layout and design as sample layout text by printers, graphic designers, Web designers, people creating Microsoft Word templates, and many other uses. It mimics the look of real text quite well as you design and set up your page layouts.

People search for this Lorem ipsum dummy copy text using all kinds of names, such as Lorem ipsum, lorem ipsum dolor sit amet, Lorem, dummy text, loren ipsum (yes, spelled wrong), Lorem ipsum sample textipsum loremlorem ipsum sample, Latin copy text, Lorem ipsum text, Latin dummy text, template text, sample text, dummy copy text, Latin sample text, HTML dummy text, Lorem ipsum dummy text, filler text or copy filling text, and many other names. Regardless of what you wish to call it, this text possibly originated in the </p>
    <div>
    <img class="img-fluid" src="img/article.jpg">
    <p class="img-text">text will be shown here.</p>
    </div>
    <hr>
    <p>Below is a sample of “Lorem ipsum dolor sit” dummy copy text often used to show font face samples, for page layout and design as sample layout text by printers, graphic designers, Web designers, people creating Microsoft Word templates, and many other uses. It mimics the look of real text quite well as you design and set up your page layouts.

People search for this Lorem ipsum dummy copy text using all kinds of names, such as Lorem ipsum, lorem ipsum dolor sit amet, Lorem, dummy text, loren ipsum (yes, spelled wrong), Lorem ipsum sample textipsum loremlorem ipsum sample, Latin copy text, Lorem ipsum text, Latin dummy text, template text, sample text, dummy copy text, Latin sample text, HTML dummy text, Lorem ipsum dummy text, filler text or copy filling text, and many other names. Regardless of what you wish to call it, this text possibly originated in the </p>
