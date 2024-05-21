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

<body>
<form action="test.php" method="get">
<?php
                
    $question = getQuestionById(1); ?>

    <div class="input-container">
        <input class="answer-choice" type='radio' id='answer_1' name='choice' value='<?=$question["answerA"]?>' />
        <label for='choice'><?= $question["answerA"] ?></label>
    </div>
    
    <div class="input-container">
        <input class="answer-choice" type='radio' id='answer_2' name='choice' value='<?=$question["answerB"]?>' />
        <label for='choice'><?= $question["answerB"] ?></label>
    </div>
    
    <div class="input-container">
        <input class="answer-choice" type='radio' id='answer_3' name='choice' value='<?=$question["answerC"]?>' />
        <label for='choice'><?= $question["answerC"] ?></label>
    </div>
    
    <div class="input-container">
        <input class="answer-choice" type='radio' id='answer_4' name='choice' value='<?=$question["answerD"]?>' />
        <label for='choice'><?= $question["answerD"] ?></label>
    </div>
    <div class="input-container" class="hidden">
        <input class="correct" type='hidden' id='correct' name='correct' value='<?=$question["correct"]?>' />
        <label for='correct'></label>
    </div>
    <button type="button" onclick=" checkButton()"> Submit </button>
</form>
    <div id="result"></div>
    <div id="rightAnswer"></div>
    <div id="error"></div>
    <div id="win"></div>
    <div id="score">Score:</div>

</body>

<script>
    function checkButton() {  
            let correctValue =  document.getElementById("correct");
            
            let getSelectedValue = document.querySelector( 
                'input[name="choice"]:checked'); 
            
              
            if(getSelectedValue != null) { 
                
                

                document.getElementById("result").innerHTML 
                    = getSelectedValue.value 
                    + " is your answer."; 
                document.getElementById("rightAnswer").innerHTML 
                    = correct.value 
                    + " is correct answer."; 
                    console.log(correctValue.value);
                    console.log(getSelectedValue.value);
                    
                    if (correctValue.value === getSelectedValue.value) {
                        
                        document.getElementById("win").innerHTML 
                    = getSelectedValue.value 
                    + " You win."; 
                    } else {
                        document.getElementById("win").innerHTML 
                    = getSelectedValue.value 
                    + " No win."; 
                    }
            } 
            else { 
                document.getElementById("error").innerHTML 
                    = "*You have not selected any answer"; 
            } 
        }  
    </script> 
    </body>
</html>
