<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title><?php echo $navData['title'] ?? "Ordr Trak"; ?> </title>


    <style>
        body {
            background-color: #f0f0f0;
            height: 100%;
        }
        nav {
            background-color: #8080803d;
        }
        .btn-cstm {
            background: #90ab90;
            color: white;
            width: 150px;
        }
        .btn-sadow {
            box-shadow: 0 0 5px 5px rgb(233, 230, 230);
            border:2px solid rgb(171, 144, 144);

        }
        main{
           max-width:80%;
            margin:auto;"
            height: 100vh;
        }
        .btn-error {
            background: rgb(169 27 27);
            color: white;
        }
        .btn-wern {
            background: rgb(149 113 30 / 91%);
            color: white;
        }
        .custnContinear{
            max-width: 80%;
            margin: auto;
            height: 100vh;
        }

    </style>
</head>

<body >

    <div>
        <div class="custnContinear">
    <main class="container mt-3" >
        <!-- Send Box -->
        <div class="navbar navbar-light bg-light"  style="display: <?php echo $navData['display'] ?? 'block'; ?>">
            <form class="container-fluid" method="GET">
                <div class="input-group">
                <input 
                    class="form-control text-center" 
                    style=" margin: 0 auto;" 
                    placeholder="<?php echo $navData['send'] ?? 'Add Order'; ?>" 
                    type="number" 
                    name="nmuber" 
                    min="1111" 
                    max="9999999999" 
                    required 
                    autofocus 
                >
                    <button class="input-group-text btn btn-outline-success" type="submit" name="send">Add </button>
                </div>
            </form>
        </div>

        <!-- Search Box -->
        <div class="navbar navbar-light bg-light">
            <form class="container-fluid">
                <div class="input-group">
                    <input class="form-control" style="text-align: center;" type="number" name="searchv"
                           placeholder="<?php echo $navData['holder'] ?? 'Search...'; ?>">
                    <button class="input-group-text btn btn-outline-success" type="submit" name="search">Search</button>
                </div>
            </form>
        </div>

