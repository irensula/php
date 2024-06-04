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
                    $questions = getAllQuestions();
                        
                    foreach($questions as $question) {
                            
                        echo "<form action='index.php' method='get'>
                            <ul>
                                <li>" . $question["questionText"];
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

                        <button class="button" type="submit" name="submit" onclick="checkButton()"> Submit </button>
                        </ul>
                        
                    </form>
                    <hr>
                        <?php
                              
                        if(isset($_GET['submit'], $_SESSION["score"])) {
                            $choice = htmlspecialchars($_GET['choice']); 
                            $questionIDa = htmlspecialchars($_GET['questionIDa']);                           
                            $questionIDq = $question["questionID"]; 
                            $correctFromDB = rightAnswer($questionIDq);
                            $correct = $correctFromDB["answerText"];
       
                            if($questionIDa == $questionIDq) {
                                
                                echo "Correct answer is " . $correct . '<br>';
                                echo "Your answer is " . $choice . "</br>";

                                if ($choice == $correct) {
                                    $_SESSION["score"]++;
                                    echo "Your score: " . $_SESSION["score"] . "<hr>";;
                             } else {
                                echo "Your score: " . $_SESSION["score"] . "<hr>";
                             }
                            } 
                        }
                    ?>
                    <?php } ?>
                          
</body>
