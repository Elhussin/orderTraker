
<nav class="navbar navbar-light">
        <form class="container-fluid justify-content-center">
            <a class="btn btn-cstm mt-3 m-3 btn-sadow fw-bolder"  href="index.php">Home</a>
            <a class="btn btn-cstm mt-3 m-3" href="sendOrder.php">Factory</a>
            <a class="btn btn-cstm mt-3 m-3" href="inShop.php">Branch</a>
            <a class="btn btn-cstm mt-3 m-3" href="delivered.php">Delivered</a>

        </form>
    </nav>
<?php
    $navData = [
        'title' => 'Home',
        'display' => 'none',
        
        'holder' => 'Search Order',
    ];


        include 'nav.php';
        include 'functian.php';
        require_once './datapass.php';

        // Start output buffering
        ob_start();
        $query = $databass->prepare('SELECT `STATA`, COUNT(*) as count FROM `shop` GROUP BY `STATA`');
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $countInShop = 0;
        $countInLap = 0;
        $countDone = 0;
        
        foreach ($results as $row) {
            if ($row['STATA'] === "IN SHOP") {
                $countInShop = $row['count'];
            } elseif ($row['STATA'] === "IN LAP") {
                $countInLap = $row['count'];
            } elseif ($row['STATA'] === "DONE") {
                $countDone = $row['count'];
            }
        }

        echo '<table class="table table-bordered table-striped table-responsive mt-3">';
        echo '<tr class="table-success">';
        echo '<th>In Factory</th><th class="table-light">' . $countInLap . '</th>';
        echo '<th>In Branch</th><th class="table-light">' . $countInShop . '</th>';
        echo '<th>Delivered</th><th class="table-light">' . $countDone . '</th>';
        echo '</tr>';
        echo '</table>';

        if (isset($_GET['search'])) {
            $search = $databass->prepare("SELECT * FROM `shop` WHERE `NUMBER` LIKE :VALUE1");
            $searchValue = "%" . $_GET['searchv'] . "%";
            $search->bindParam('VALUE1', $searchValue);
            $search->execute();


        }else{
            $search = $databass->prepare("SELECT * FROM `shop`");
            $search->execute();
        }



        echo '
        <div style="overflow-x: auto; max-height: 700px;">
 
        <table class="table mt-3"  style="min-width: 800px;">
       <thead class="table-primary">
            <tr>
                <th><a class="btn" >NO</a></th>
                <th><a class="btn" ">SERIAL</a></th>
                <th><a class="btn">SEND DATE</a></th>
                <th><a class="btn">RECEIVE DATE</a></th>
                <th><a class="btn">Dilvery DATE</a></th>
                <th><a class="btn" >STATUS</a></th>
                <th ><a  class="btn"> DEALET</a></th>
                 <th><a class="btn" >Note</a></th>
            </tr>
        </thead>';


        if ($search->rowCount() > 0) {

            foreach ($search as $row) {
                echo '<tr class="table-light">';
                echo '<td>' . $row["ID"] . '</td>';
                echo '<td>' . $row["NUMBER"] . '</td>';
                echo '<td>' . $row["SEND_DATA"] . '</td>';
                echo '<td>' . $row["RECIVE_DATE"] . '</td>';
                echo '<td>' . $row["DONE_DATE"] . '</td>';
                echo '<td  class="table-wrning">' . $row["STATA"] . '</td>';
                echo '<td><form><button name="delet" class="btn btn-error" value="' . $row["ID"] . '">Delete</button></form></td>';
                echo '<td>';
                if ($row["NOTE"] != null) {
                    echo '<form>
                    <div class="input-group">
                        <input class="form-control" type="text" value="' . $row["NOTE"] . '" readonly >
                        <button name="add" class="btn btn-wern" value="' . $row["ID"] . '">Edit</button>
                    </div>
                  </form>';

                } else {
echo '<form>
                            <div class="input-group">
                                <input class="form-control" type="text"  name="note"  placeholder="Add Note" >
                                <button name="add" class="btn btn-wern" value="' . $row["ID"] . '">Note</button>
                            </div>
                          </form>';
                                        }
                echo '</td></tr>';
            }

        } else {
            echo '<div class="alert alert-warning" role="alert">Not Found</div>';
        }
        echo '</table>';

         
        // Delete Item
        if (isset($_GET['delet'])) {
 
            $delat=delateIteam($databass,$_GET['delet'], 'index.php') ;
            if ($delat){
                
                echo '<div class="alert alert-success" role="alert">Deleted Successfully</div>';
            }else{
                echo '<div class="alert alert-danger" role="alert">Error</div>';
            }
        }
        if (isset($_GET['add'])){
            $addNoteIteam=addNoteIteam($databass,$_GET['add'],$_GET['note'],'index.php');
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