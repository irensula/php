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

<body>
    <img src="friends.webp" alt="">
    <h1>TIETOVISA</h1>
    <h2>How well do you know Friends?</h2>

<?php
    if (!isset($_SESSION['random_array'])) {
        $array_numbers = range(1, 15);
        shuffle($array_numbers);
        $array_numbers = array_slice($array_numbers,0,10);
        $_SESSION['random_array'] = $array_numbers;
        echo print_r($_SESSION['random_array']); 
    } else {
        echo print_r($_SESSION['random_array']);
    }

        // $arr = [1,2,3,4,5,6,7,8,9,10];
        // $questions = getQuestionsArray($arr);
        $questions = getQuestionsArray($_SESSION['random_array']);
        foreach($questions as $question) {
                
            echo "<div>";?>
            
            
            <form action='# . <?=$question['questionID']?>' method='post'>
            <a id='<?=$question['questionID']?>'></a>
                <ul>
                    <li><?php $question["questionID"] . ". " . $question["questionText"];
                    ?></li>
            <?php 
            
            $answers = getAllAnswers();
                        
                    foreach($answers as $answer) { 
                    
                        if ($question["questionID"] == $answer["questionID"]) { ?>
                            
                            <div class="input-container">
                                
                                <input class="answer-choice" type='radio' id='choice' name='choice' value='<?=$answer["answerText"]?>' />
                                <label for='choice'><?= $answer["answerText"] ?></label>
                                <input class="answer-choice" type='hidden' id='questionIDa' name='questionIDa' value='<?=$answer["questionID"]?>' />
                                <label for='questionIDa'></label>
                                
                            </div>                       
                        <?php } ?>
                    <?php } ?>
    
                    <button class="button" type="submit" name="submit"> Submit </button>
                    </ul>
                    
                </form>
                </div>
                <hr>
                    <?php
                    if(!isset($_SESSION['score'])) {
                        $_SESSION['score'] = 0;
                        $_SESSION['numberOfQuestions'] = 0;
                    }     
                        
                    if($_SERVER["REQUEST_METHOD"] == "POST") {
                        if(isset($_POST['choice'], $_POST['questionIDa'], $_SESSION["score"])) {
                            $choice = htmlspecialchars($_POST['choice']); 
                            $questionIDa = htmlspecialchars($_POST['questionIDa']);  // question ID from the Answers table                        
                            $questionIDq = $question["questionID"]; // question ID from the Questions table
                            $correctFromDB = rightAnswer($questionIDq); 
                            $correct = $correctFromDB["answerText"];
    
                        if($questionIDa == $questionIDq) {
                            
                            echo "Correct answer is " . $correct . '<br>';
                            echo "Your answer is " . $choice . "</br>";
    
                            if ($choice == $correct) {
                                $_SESSION['numberOfQuestions']++;
                                $_SESSION["score"]++;
                                echo "Your score: " . $_SESSION["score"] . "/" . $_SESSION['numberOfQuestions'] . "<hr>";
                                    } else {
                                        $_SESSION['numberOfQuestions']++;
                                        echo "Your score: " . $_SESSION["score"] . "/" . $_SESSION['numberOfQuestions'] . "<hr>";
                                    }
                                        if($_SESSION['numberOfQuestions'] == 10) {
                                            if($_SESSION["score"] <= 3) {
                                                echo "Your score is " . $_SESSION["score"] . ". Maybe it's not your favourite TV-series.<br>";
                                            } elseif ($_SESSION["score"] > 3 && $_SESSION["score"] <= 6) {
                                                echo "Your score is " . $_SESSION["score"] . ". Well done!<br>";
                                            } elseif ($_SESSION["score"] > 6 && $_SESSION["score"] < 10) {
                                                echo "Your score is " . $_SESSION["score"] . ". Congratulations!<br>";
                                            } elseif ($_SESSION["score"] = 10 ) {
                                                echo "Your score is " . $_SESSION["score"] . ". Congratulations! You are 'Friends' expert! <br>";
                                            }
                                        }
                             
                        } 
                    }
                    }
                ?>
                
    <?php //}} ?>
    <?php } ?>
    
        <!-- destroy session button -->
        <form action="indexPHPJS.php" method="POST" class="clear-form">
            <label for='clear'></label>
            <input class="button-clear" id='clear' name='clear' type="submit" value="Start Quiz Again">
        </form>
        <?php
            if(isset($_POST['clear'])) {
                session_destroy();
            }   
        ?>
        <!-- to prevent double submit on refreshing page -->
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }           
        </script>
    </body>