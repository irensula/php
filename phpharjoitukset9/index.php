<?php 
    require_once "./dbfunctions.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="styles/reset.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="styles/main.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <img src="friends.webp" alt="">
    <div class="container">
        <h1>TIETOVISA</h1>
        <h2>How well do you know Friends?</h2>
        
        <form action="index.php" method="get">
            <ul>
                <?php
                    $answers = getAllAnswers();
                    $arr = array();
                    foreach ($answers as $answer) {
                        array_push($arr, $answer["questionID"], $answer["questionText"], $answer["answerID"], $answer["answerText"], $answer["correct"]);
                    }
                    print_r($arr);
                    
                    $unique_data = array_unique($arr);
                    print_r($unique_data);
                    // now use foreach loop on unique data
                    foreach($unique_data as $unique) {
                        echo "<li>" . $unique["questionText"]; ?>
                        </li>
                        <?php } ?>
                        <?php
                    foreach($answers as $answer) { 
                        
                        echo "<li>" . $answer["questionText"];
                        ?>
                        </li>
                            <div class="input-container">
                                <input class="answer-choice" type='radio' id='<?=$answer["answerID"]?>' name='choice' value='<?=$answer["answerText"]?>' />
                                <label for='choice'><?=$answer["answerText"]?></label>
                            </div>
                        
                        <button id="submit" class="button" type="submit">Tarkista</button>
                                  
                <?php } ?>
            </ul>
        </form>
        <?php
                        
                        // $_SESSION["score"] = 0;

                        // if(isset($_GET['choice'], $_GET['correct'])) {
                        //     $choice = htmlspecialchars($_GET['choice']);
                        //     $correct = htmlspecialchars($_GET['correct']);  
                           
                        //     if($choice == $correct) {
                        //         echo "<br>This is right answer.<br><br>";

                        //         $_SESSION["score"] += 1;
                        //         echo "Your score is " . $_SESSION["score"] . ".";
                                
                        //     } else {
                        //         echo "<br>The right answer is <i>" . $correct . "</i>.";
                        //     }   
                        // }
                    ?>
        
    </div>