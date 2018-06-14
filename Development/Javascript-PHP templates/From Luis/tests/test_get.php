
  <!DOCTYPE html>
  <html>
  <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Page Title</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
      <script src="main.js"></script>
  </head>
  <body>
      
  <div class="search">
    <form method="get">
        <input name="searchTerm" type="text" class="searchTerm" placeholder="Type your search here">
        <button name="search" type="submit" class="searchButton">submit
            <i class="fa fa-search"></i> 
        </button>
    </form>
   </div>

   <?php 
        echo "this is php <br>";
        if(isset($_GET['searchTerm'])){
            echo "my search term is ";
            echo $_GET['searchTerm'];
        }
        else {
            echo "my searchterm is not set";
        }
    ?>
  </body>
  </html>