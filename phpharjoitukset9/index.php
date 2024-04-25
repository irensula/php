<?php
    require "./dbfunctions.php";
    
    if(isset($_GET['answer_1'], $_GET['answer_2'], $_GET['answer_3'], $_GET['answer_4'])) {
        $answer_1 = htmlspecialchars($_GET['answer_1']);
        $answer_2 = htmlspecialchars($_GET['answer_2']);  
        $answer_3 = htmlspecialchars($_GET['answer_3']);
        $answer_4 = htmlspecialchars($_GET['answer_4']);
        echo $answer_1;
        echo $answer_2;
        echo $answer_3;
        echo $answer_4;
    }
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
                    $id = 1;

                    $questions = getAllQuestions();
                    foreach($questions as $question) {
                    echo "<li>" . $question["quizID"] . ". " . $question["question"] ?>
                    </li>
                    
                        <input type='radio' id='answer_1' name='answer_1' value='answer_1' />
                        <label for='answer_1'><?= $question["answerA"] ?></label>
                        
                        <input type='radio' id='answer_2' name='answer_2' value='answer_2' />
                        <label for='answer_2'><?= $question["answerB"] ?></label>
                        
                        <input type='radio' id='answer_3' name='answer_3' value='answer_3' />
                        <label for='answer_3'><?= $question["answerC"] ?></label>
                        
                        <input type='radio' id='answer_4' name='answer_4' value='answer_4' />
                        <label for='answer_4'><?= $question["answerD"] ?></label>
                              
                    <?php } ?>
                    <button class="button" type="submit">Lähetä</button>
            </ul>
        </form>
    </div>