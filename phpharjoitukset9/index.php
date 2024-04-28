<?php 

    require_once "./dbfunctions.php";
    require_once "./cleaners.php";
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
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="main.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <img class="center" src="friends.webp" alt="">
    <div class="container">
        <h1>TIETOVISA</h1>
        <h2>How well do you know Friends?</h2>
        
        <form action="index.php" method="get">
            <ul>
                <?php
                function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
                    $numbers = range($min, $max);
                    shuffle($numbers);
                    return array_slice($numbers, 0, $quantity);
                }
                $random_numbers = UniqueRandomNumbersWithinRange(1, 15, 10);
                $numbers = implode(", ", $random_numbers);
                echo $numbers;
                    
                $id = 1;
                    // $questions = getAllQuestions();
                    // foreach($questions as $question) {
                    
                    while ($id <= 10) {
                    $question = getQuestionById($id);
                    
                    echo "<li>" . $question["quizID"] . ". " . $question["question"];
                    ?>
                    </li>
                    
                        <input type='radio' id='answer_1' name='choice' value='<?=$question["answerA"]?>' />
                        <label for='answer_1'><?= $question["answerA"] ?></label>
                        
                        <input type='radio' id='answer_2' name='choice' value='<?=$question["answerB"]?>' />
                        <label for='answer_2'><?= $question["answerB"] ?></label>
                        
                        <input type='radio' id='answer_3' name='choice' value='<?=$question["answerC"]?>' />
                        <label for='answer_3'><?= $question["answerC"] ?></label>
                        
                        <input type='radio' id='answer_4' name='choice' value='<?=$question["answerD"]?>' />
                        <label for='answer_4'><?= $question["answerD"] ?></label>

                        <input type='hidden' id='correct' name='correct' value='<?=$question["correct"]?>' />
                        <label for='correct'></label>
                        
                        <button class="button" type="submit">Tarkista</button>
                                  
                    <?php 
                        $id++;
                    } ?>
                    </form>

                    <?php
                        
                        $_SESSION["score"] = 0;

                        if(isset($_GET['choice'], $_GET['correct'])) {
                            $choice = htmlspecialchars($_GET['choice']);
                            $correct = htmlspecialchars($_GET['correct']);  
                           
                            if($choice == $correct) {
                                echo "<br>This is right answer.<br><br>";

                                $_SESSION["score"] += 1;
                                echo "Your score is " . $_SESSION["score"] . ".";
                                
                            } else {
                                echo "<br>The right answer is <i>" . $correct . "</i>.";
                            }   
                        }
                    ?>
            </ul>
        
    </div>