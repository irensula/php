<?php 
    require_once "./dbfunctions.php";
    // session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php 
  

    $arr = [5, 6, 4];
    function arrayByValue($arr) {        
        // Update the array va;ue 
        $arr[0] = 100; 
        
        return $arr; 
    }    
    // Driver code   
    $newArr = arrayByValue($arr);  
    // print_r($newArr);
    foreach($newArr as $item){
        echo $item . "\n";
    } 
?>



<?php 
function processArr() { 
    $args = func_get_args(); 
    print_r($args); 
}  
// Driver code 
processArr(5, 6, 8); 
?>

<?php 
    // $id= '2';
    // $question = getQuestionById($id);   
    // echo "<p>" . $question["question"] . "</p>";
?>
<?php
        $arr = range(11, 20);

        $key = array_rand($arr);
        
        // echo $arr[$key];
     
        
        function button() { 
            echo $arr[$key]; 
        } 
    ?> 
  
    <form method="post"> 
        <input type="submit" name="button" class="button" value="Button" />  
    </form> 

<?php 
    $arr = [7, 8, 9];
    
    $questions = getQuestionsArray($arr);
        
    foreach($questions as $question) {
            
        echo "<form action='index.php' method='POST'>
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

        <button class="button" type="submit" name="submit"> Submit </button>
        </ul>
        
    </form>
    <?php } ?>