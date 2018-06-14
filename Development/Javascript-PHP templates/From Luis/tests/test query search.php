
  <!DOCTYPE html>
  <html>
  <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Page Title</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script>
          function refresh(){
            window.location = 'http://akaiotagamma.org/test_get.php';
          }
      </script>
  </head>

  <body>
      
  <div class="search">
    <form name="search" method="get">
        <input name="searchTerm" type="text" class="searchTerm" placeholder="Type your search here">
        <button name="search" type="submit" class="searchButton">submit
            <i class="fa fa-search"></i> 
        </button>
        <button name="reset" type="reset" onClick="refresh();">reset</button>
    </form>
   </div>

   <?php 
        include 'dir.php';
        
        if(isset($_GET['searchTerm'])){
            directory('search',$_GET['searchTerm']);
        }
        else {
            directory(NULL, NULL);
        }
    ?>
  </body>
  </html>