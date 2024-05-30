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
                            <ul><hr>
                                <li>" . $question["questionText"];
                                ?></li>

                        <?php 
                        
                        $answers = getAllAnswers();
                         
                        foreach($answers as $answer) { 
                        
                            if ($question["questionID"] == $answer["questionID"]) { ?>
                                
                                <div class="input-container">
                                    
                                    <input class="answer-choice" type='radio' id='choice' name='choice' value='<?=$answer["answerText"]?>' />
                                    <label for='choice'><?= $answer["answerText"] ?></label>
                                    
                                </div>                       
                            <?php } ?>
                        <?php } ?>

                        <button class="button" type="submit" name="submit" onclick="checkButton()"> Submit </button>
                        </ul>
                        
                    </form>
                        <?php
                        
                        $_SESSION["score"] = 0;
                                
                        if(isset($_GET['submit'])) {
                            $choice = htmlspecialchars($_GET['choice']);                            
                            $id = $question["questionID"]; 
                            $correctFromDB = rightAnswer($id);
                            $correct = $correctFromDB["answerText"];
                            $score = $_SESSION["score"];     
                            echo "Correct answer is " . $correct . '<br>';
                            echo "Your answer is " . $choice . "</br>";
                             if ($choice == $correct) {
                                $score = $score + 1;
                                echo "Your score: " . $score;
                             } else {
                                echo "Your score: " . $score;
                             }
                        }
                    ?>
                    <?php } ?>
                          
</body>

<script>
    // function checkButton() {  
    //         let correctValue =  document.getElementById("correct");
            
            
    //         for (let i = 0; i < correctValue.length; i++) {
    //             let getSelectedValue = document.querySelector('input[name="choice"]:checked'); 
    //             let score = document.getElementById("score");
    //             let scoreNumber = 0;
    //             if(getSelectedValue != null) { 

    //             document.getElementById("result").innerHTML 
    //                 = "Your answer is " + getSelectedValue.value; 
    //             document.getElementById("rightAnswer").innerHTML 
    //                 = "Correct answer is " + correctValue[i].value; 
    //                 console.log(correctValue[i].value);
    //                 console.log(getSelectedValue.value);
                    
    //                 if (correctValue[i].value === getSelectedValue.value) {
    //                     getSelectedValue.parentElement.classList.add('rightAnswer');
    //                     scoreNumber++;
    //                     score.innerHTML = 'Your score is ' + scoreNumber; 
    //                 } else {
                        
    //                 getSelectedValue.parentElement.classList.add('wrongAnswer');
    //                 score.innerHTML = 'Your score is ' + scoreNumber;
    //                 }
    //         } 
    //         else { 
    //             document.getElementById("error").innerHTML 
    //                 = "*You have not selected any answer"; 
    //         } 
    //     }
    // }  
    // </script> 
    <?php
if(!empty($_POST['check_list']))
{
     foreach($_POST['check_list'] as $id){
        echo "<br>$id was checked! ";
     }
}


?>

<form method="post" name="frm">
<input type="radio" name="check_list[]" value="1"> 1
<input type="radio" name="check_list[]" value="2"> 2
<input type="radio" name="check_list[]" value="3"> 3
<input type="radio" name="check_list[]" value="4"> 4
<input type="submit" name="submit" />
</form>
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
