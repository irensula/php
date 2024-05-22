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

        <form action="test.php" method="get">
            <ul>
                    <?php
                    
                        $questions = getTenQuestions();

                        foreach($questions as $question) {
                            
                        echo "<li>" . $question["question"];
                        ?>
                        </li>

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
            <div class="input-container hidden">
                <input class="correct" type='hidden' id='correct' name='correct' value='<?=$question["correct"]?>' />
                <label for='correct'></label>
            </div>
            <button class="button" type="button" onclick="checkButton()"> Submit </button>
            
            <div class="test-resutls">
                <p id="result"></p>
                <p id="rightAnswer"></p>
                <p id="error"></p>
                <p id="score"></p>
            </div>
            <?php } ?>
                </ul>
        </form>  

</body>

<script>
    function checkButton() {  
            let correctValue =  document.getElementById("correct");
            
            
            for (let i = 0; i < correctValue.length; i++) {
                let getSelectedValue = document.querySelector('input[name="choice"]:checked'); 
            let score = document.getElementById("score");
            let scoreNumber = 0;
            if(getSelectedValue != null) { 

                document.getElementById("result").innerHTML 
                    = "Your answer is " + getSelectedValue.value; 
                document.getElementById("rightAnswer").innerHTML 
                    = "Correct answer is " + correctValue[i].value; 
                    console.log(correctValue[i].value);
                    console.log(getSelectedValue.value);
                    
                    if (correctValue[i].value === getSelectedValue.value) {
                        getSelectedValue.parentElement.classList.add('rightAnswer');
                        scoreNumber++;
                        score.innerHTML = 'Your score is ' + scoreNumber; 
                    } else {
                        
                    getSelectedValue.parentElement.classList.add('wrongAnswer');
                    score.innerHTML = 'Your score is ' + scoreNumber;
                    }
            } 
            else { 
                document.getElementById("error").innerHTML 
                    = "*You have not selected any answer"; 
            } 
        }
    }  
    </script> 
    </body>
</html>

<script>
            // for (let i = 0; i < allChoices.length; i++) {
            //     
            //     let userChoice = allChoices[i].checked;

            //     if (correct === userChoice) {
            //         event.preventDefault();
            //         correct.classList.add('rightAnswer');
            //         document.getElementById("result").innerHTML = "You have selected: " + inputContainer[i].value;
                    
                    
                // } else {
                //     userChoice.parentElement.classList.add('wrongAnswer');
                    
                //}
        // }
        // }

    //     function selectedButton() {
    //         let inputContainer = document.querySelectorAll(".answer-choice");
    //         let correct = document.getElementById('correct').value;
    //         console.log(correct);
    //         for (let i = 0; i < inputContainer.length; i++) {
                
    //         if (inputContainer[i].checked) {
    //             inputContainer[i].parentElement.classList.add('selected');
    //             document.getElementById("result").innerHTML = "You have selected: " + inputContainer[i].value;
                
    //             document.getElementById("score").innerHTML = "Your score: ";
    //         } else {
    //             inputContainer[i].parentElement.classList.remove('selected');
    //             event.preventDefault();
    //         }
    //     }
    // }
    
    </script>