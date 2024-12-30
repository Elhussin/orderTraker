<nav class="navbar navbar-light">
        <form class="container-fluid justify-content-center">
            <a class="btn btn-cstm mt-3 m-3 "  href="index.php">Home</a>
            <a class="btn btn-cstm mt-3 m-3 " href="sendOrder.php">Factory</a>
            <a class="btn btn-cstm mt-3 m-3  btn-sadow fw-bolder" href="inShop.php">Branch</a>
            <a class="btn btn-cstm mt-3 m-3" href="delivered.php">Delivered</a>

        </form>
    </nav>

<?php

$navData = [
    'title' => 'In Shop',
    'holder' => 'Search  Order I shop',
    'send' => 'Get order from lap'
];

        include 'nav.php';
        include 'functian.php';
        require_once './datapass.php';

        // Start output buffering
        ob_start();
$results = $databass->prepare('SELECT * FROM `shop` WHERE  `STATA`="IN SHOP" ORDER BY ID  DESC');
$results->execute();
$count = $results->rowCount();
echo   ' <table class="table table-bordered table-striped table-responsive mt-3" id="example">';
 echo'  <tr class="table-success"> 
        <th  >No</th>
        <th >In Shop</th>
        <th  >'.  $count .'</th>
     
      </tr>
    </table>';

    // Update status
    if (isset($_GET['send'])) {
      $addcheak = $databass->prepare("SELECT * FROM shop WHERE NUMBER = :NUMBR");
      $addcheak->bindParam("NUMBR", $_GET['nmuber']);
      $addcheak->execute();
 
      if ($addcheak->rowCount() > 0) {
          $addcheak = $addcheak->fetchObject();

          if ($addcheak->STATA == "IN SHOP") {
              echo '<div class="alert alert-warning" role="alert">
              
                      Already in Shop From: ' . $addcheak-> RECIVE_DATE . '
                    </div>';
          } elseif ($addcheak->STATA == "IN LAP") {
              $UBDATE = $databass->prepare("UPDATE `shop` SET `STATA` = 'IN SHOP', RECIVE_DATE = CURRENT_TIMESTAMP WHERE NUMBER = :id");
              $UBDATE->bindParam('id', $_GET['nmuber']);
              $UBDATE->execute();

              echo '<div class="alert alert-success" role="alert">
                      Successfully Added to Shop
                    </div>';
              echo '<script>
                      setTimeout(() => {
                          window.location.href = "inShop.php";
                      }, 1000);
                    </script>';
              exit();
          } elseif ($addcheak->STATA == "DONE") {
              echo '<div class="alert alert-warning" role="alert">
                      Already delivered to the customer from: ' . $addcheak-> DONE_DATE . '
                    </div>';
          }
      } else {
          echo '<div class="alert alert-warning" role="alert">
                  This number not found
                </div>';
      }
    }



    if (isset($_GET['search'])) {
          $results = $databass->prepare("SELECT * FROM shop  WHERE `STATA`='IN SHOP' AND  NUMBER LIKE :VALUE1  ORDER BY ID  DESC"); 
          $searchValue = "%" . $_GET['searchv'] . "%";
          $results->bindParam('VALUE1', $searchValue);
          $results->execute();
      }
       else {
          $results =$results;
      }

      echo '
      <div style="overflow-x: auto; max-height: 700px;">

      <table class="table mt-3"  style="min-width: 800px;">
     <thead class="table-primary">
          <tr>
              <th><a class="btn" >NO</a></th>
              <th><a class="btn" ">SERIAL</a></th>
              <th><a class="btn"> RECIVE DATE</a></th>

              <th><a class="btn" >STATUS</a></th>
              <th ><a  class="btn"> DEALET</a></th>
               <th><a class="btn" >Note</a></th>
          </tr>
      </thead>';

        // Include the function file to view the item
        viewIteam($results, 'RECIVE_DATE');

        // Include the function file to delete and add note


        // Delete Item
        if (isset($_GET['delet'])) {

          $delat=delateIteam($databass,$_GET['delet'], 'sendOrder.php') ;
          if ($delat){
              
              echo '<div class="alert alert-success" role="alert">Deleted Successfully</div>';
          }else{
              echo '<div class="alert alert-danger" role="alert">Error</div>';
          }
      }
      // Add Note
      if (isset($_GET['add'])){
          $addNoteIteam=addNoteIteam($databass,$_GET['add'],$_GET['note'],'sendOrder.php');
          if ($addNoteIteam){
              echo '<div class="alert alert-success" role="alert">Note Added Successfully</div>';
          }else{
              echo '<div class="alert alert-danger" role="alert">Error</div>';
          }
      }
  
        // End output buffering and capture it to a variable
        ob_end_flush();
        
        ?>

<?php

// include 'footer.php';
include 'footer.php';

?>