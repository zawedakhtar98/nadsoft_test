
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require_once('config/config.php');
        require_once('config/connection.php');
    ?>
    <title>Business Listing</title>
    <link rel="stylesheet" href="<?= BASE_URL?>assets/css/bootstrap.min.css">    
    <link rel="stylesheet" href="<?= BASE_URL?>assets/css/raty.css"> 
    <link rel="stylesheet" href="<?= BASE_URL?>assets/css/dataTables.min.css"> 

    <style>
        div.rating{
            cursor: pointer;
        }
        .dataTables_length{
            margin-bottom: 12px;
        }
    </style>
       
</head>
<body class="bg-light">