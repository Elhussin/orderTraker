<nav class="navbar navbar-light">
    <form class="container-fluid justify-content-center">
        <a class="btn mt-3 m-3 btn-cstm " href="index.php">Home</a>
        <a class="btn btn-cstm mt-3 m-3 " href="sendOrder.php">Factory</a>
        <a class="btn btn-cstm mt-3 m-3 " href="inShop.php">Branch</a>
        <a class="btn btn-cstm mt-3 m-3  btn-sadow fw-bolder " href="delivered.php">Delivered</a>

    </form>
</nav>

<?php
    $navData = [
      'title' => 'delivered',
      'holder' => 'Search in delivered Order',
      'send' => 'Add delivered Order'
  ];
        include 'nav.php';
        include 'functian.php';
        require_once './datapass.php';

        // Start output buffering
        ob_start();




//  get Total Number of Orders in Factory
$results = $databass->prepare('SELECT * FROM `shop` WHERE  `STATA`="Delivered" ORDER BY ID  DESC');
$results->execute();
$count = $results->rowCount();

echo   ' 
<table class="table table-bordered table-striped table-responsive mt-3" id="example">
  <tr class="table-success"> 
        <th  >No</th>
        <th >Dilvery Successfully</th>
        <th  >'.  $count .'</th>
     
      </tr>
    </table>';




//  ubdate stata 
if(isset($_GET['send'])){
  $addcheak=$databass->prepare("SELECT * FROM shop WHERE NUMBER=:NUMBR" );
  $addcheak->bindParam("NUMBR",$_GET['nmuber']);
  $addcheak->execute();
  if($addcheak->rowCount()>0){
    $addcheak=$addcheak->fetchObject();
    if($addcheak->STATA =="DONE"){
      echo' <div class="alert alert-warning" role="alert">
      Alredy dilvered at :'.
      $addcheak->DONE_DATE .'
      
      </div>';
    }else if ($addcheak->STATA =="IN SHOP"){
      $UBDATE = $databass->prepare("  UPDATE `shop` SET `STATA`='Delivered', DONE_DATE=CURRENT_TIMESTAMP WHERE NUMBER = :id");
      $UBDATE->bindParam('id',$_GET['nmuber']);
       $UBDATE->execute();

       echo' <div class="alert alert-success" role="alert">
       dilvered Successfully
       </div>';  
       echo '<script>
       setTimeout(() => {
           window.location.href = "delivered.php";
       }, 1000);
     </script>'; 
       
       
     
    }else if($addcheak->STATA =='IN LAP'){
      echo' <div class="alert alert-warning" role="alert">
      This Order In Lab </div>';
     
    }

  }else{
      echo' <div class="alert alert-warning" role="alert">
      This Order Not Found </div>';
 
  }
}


if (isset($_GET['search'])) {
  $results = $databass->prepare("SELECT * FROM shop  WHERE `STATA`='Delivered' AND  NUMBER LIKE :VALUE1  ORDER BY ID  DESC"); 
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
        viewIteam($results, 'DONE_DATE');

        // Include the function file to delete and add note


        // Delete Item
        if (isset($_GET['delet'])) {

          $delat=delateIteam($databass,$_GET['delet'], 'delivered.php') ;
          if ($delat){
              
              echo '<div class="alert alert-success" role="alert">Deleted Successfully</div>';
          }else{
              echo '<div class="alert alert-danger" role="alert">Error</div>';
          }
      }
      // Add Note
      if (isset($_GET['add'])){
          $addNoteIteam=addNoteIteam($databass,$_GET['add'],$_GET['note'],'delivered.php');
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