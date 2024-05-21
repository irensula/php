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

    <script>
        
         function changeBackgroundColor() {
            let correctAnswer = document.getElementById("correct");
            let allChoices = document.querySelectorAll('.answer-choice');
            let correct = correctAnswer.value;
            let selectedValue = document.querySelector('input[name="choice"]:checked');
            console.log(selectedValue);
            event.preventDefault();
            
            for (let i = 0; i < allChoices.length; i++) {
                let correct = correctAnswer.value;
                let userChoice = allChoices[i].checked;

                if(userChoice) {
                    console.log(correct);
                    console.log(userChoice);
                }
            }
            function checkButton() {  
            var getSelectedValue = document.querySelector( 
                'input[name="choice"]:checked'); 
              
            if(getSelectedValue != null) { 
                document.getElementById("disp").innerHTML 
                    = getSelectedValue.value 
                    + " season is selected"; 
            } 
            else { 
                document.getElementById("error").innerHTML 
                    = "*You have not selected any season"; 
            } 
        }  
            // for (let i = 0; i < allChoices.length; i++) {
            //     
            //     let userChoice = allChoices[i].checked;

            //     if (correct === userChoice) {
            //         event.preventDefault();
            //         correct.classList.add('rightAnswer');
            //         document.getElementById("result").innerHTML = "You have selected: " + inputContainer[i].value;
                    
                    
                // } else {
                //     userChoice.parentElement.classList.add('wrongAnswer');
                    
                }
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
</head>
<body>
    <img class="center" src="friends.webp" alt="">
    <div class="container">
        <h1>TIETOVISA</h1>
        <h2>How well do you know Friends?</h2>
        
        <form action="test.php" method="get">
            <ul>
                <?php
                
                    $question = getQuestionById(1);

                    // foreach($questions as $question) {
                        
                    // echo "<li>" . $question["question"];
                    ?>
                    </li>
                        <div id="input-container_1">
                            <input class="answer-choice" type='radio' id='answer_1' name='choice' value='<?=$question["answerA"]?>' />
                            <label for='choice'><?= $question["answerA"] ?></label>
                        </div>
                        
                        <div id="input-container_2">
                            <input class="answer-choice" type='radio' id='answer_2' name='choice' value='<?=$question["answerB"]?>' />
                            <label for='choice'><?= $question["answerB"] ?></label>
                        </div>
                        
                        <div id="input-container_3">
                            <input class="answer-choice" type='radio' id='answer_3' name='choice' value='<?=$question["answerC"]?>' />
                            <label for='choice'><?= $question["answerC"] ?></label>
                        </div>
                        
                        <div id="input-container_4">
                            <input class="answer-choice" type='radio' id='answer_4' name='choice' value='<?=$question["answerD"]?>' />
                            <label for='choice'><?= $question["answerD"] ?></label>
                        </div>
                        <div id="input-container_5" class="hidden">
                            <input class="correct" type='hidden' id='correct' name='correct' value='<?=$question["correct"]?>' />
                            <label for='correct'></label>
                        </div>

                        <div id="result">Answer:</div>
                        <div id="score">Score:</div>
                        
                        <button onclick="checkButton()" id="submit" class="button" type="submit">Tarkista</button>
                                  
                <?php //} ?>
            </ul>
        </form>

        <br><b> Choose your favroite season: </b><br>
<input type="radio" name="season" id="summer" value="Summer"> 1 <br> 
<input type="radio" name="season" id="winter" value="Winter"> 2 <br> 
<input type="radio" name="season" id="rainy" value="Rainy"> 3 <br>
<input type="radio" name="season" id="autumn" value="Autumn"> 4<br><br>     

<button type="button" onclick=" checkButton()"> Submit </button> 
    
<h3 id="disp" style= "color:green"> </h3>
<h4 id="error" style= "color:red"> </h4>
</body>

<script>
    function checkButton() {  
            var getSelectedValue = document.querySelector( 
                'input[name="season"]:checked'); 
              
            if(getSelectedValue != null) { 
                document.getElementById("disp").innerHTML 
                    = getSelectedValue.value 
                    + " season is selected"; 
            } 
            else { 
                document.getElementById("error").innerHTML 
                    = "*You have not selected any season"; 
            } 
        }  
    </script> 
    </div>