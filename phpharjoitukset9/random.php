<?php session_start(); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>
<?php 

if (!isset($_SESSION['_article_id'])){
$_SESSION['_article_id'] = rand(1,10);
echo $_SESSION['_article_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Random numbers</h1>
    <p>Random number: <?php $_SESSION['_article_id'];?></p>

</body>
</html>

