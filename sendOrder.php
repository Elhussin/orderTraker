<nav class="navbar navbar-light">
    <form class="container-fluid justify-content-center">
        <a class="btn mt-3 m-3 btn-cstm " href="index.php">Home</a>
        <a class="btn btn-cstm btn-sadow fw-bolder mt-3 m-3 " href="sendOrder.php">Factory</a>
        <a class="btn btn-cstm mt-3 m-3 " href="inShop.php">Branch</a>
        <a class="btn btn-cstm mt-3 m-3 " href="delivered.php">Delivered</a>

    </form>
</nav>

<?php
    $navData = [
        'title' => 'Send To Lap',
        'holder' => 'Home in Order at lab',
        'send' => 'Send Order To Lab'
    ];

        include 'nav.php';
        include 'functian.php';
        require_once './datapass.php';

        // Start output buffering
        ob_start();


//  get Total Number of Orders in Factory
        $results = $databass->prepare('SELECT * FROM `shop` WHERE `STATA`="IN LAP" ORDER BY ID  DESC');
        $results->execute();
        $count = $results->rowCount();
        echo '<table class="table table-bordered table-striped table-responsive mt-3">
        <tr class="table-success"> 
                <th>No</th>
                <th>In Factory</th>
                <th>' . $count . '</th>
             </tr>
        </table>';

        // Add Item
        if (isset($_GET['send'])) {
            $number = $_GET['nmuber'] ?? '';
 
            if (!empty($number)) {
                $result = addItem($databass, $number,'Ordr Send Successfully !', "This Order Already Sent", );
                // عرض الرسالة بناءً على الحالة
                echo '<div class="alert alert-' . $result['status'] . '" role="alert">' . $result['message'] . '</div>';

                // إعادة التوجيه في حالة النجاح
                if ($result['status'] === 'success') {
                    echo '<script>
                    setTimeout(() => {
                        window.location.href = "sendOrder.php";
                    }, 1000); // تأخير 3 ثواني
                      </script>';
                    // header("Location: sendOrder.php");
                    exit();

                }
            } else {
                echo '<div class="alert alert-warning" role="alert">Number is required!</div>';
            }
        }

        

        // Home Query
        if (isset($_GET['search'])) {
            $results = $databass->prepare("SELECT * FROM shop WHERE NUMBER LIKE :VALUE1  ORDER BY ID  DESC"); 
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
                <th><a class="btn">SEND DATE</a></th>

                <th><a class="btn" >STATUS</a></th>
                <th ><a  class="btn"> DEALET</a></th>
                 <th><a class="btn" >Note</a></th>
            </tr>
        </thead>';

        // Include the function file to view the item
        viewIteam($results , 'SEND_DATA');
        // DONE_DATE SEND_DATA NOTE S TATA RECIVE_DATE
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