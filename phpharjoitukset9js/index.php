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
        ob_start();
        print_r($_SESSION['random_array']);
        ob_end_clean();
    } else {
        ob_start();
        print_r($_SESSION['random_array']);
        ob_end_clean();
    }?>
        <form action='index.php' method='post'>
        
            <?php
                $questions = getQuestionsArray($_SESSION['random_array']);
                foreach($questions as $question) {
                    echo "<ul class='radiogroup'>
                
                    <li>" . $question["questionID"] . " . " . $question["questionText"];
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
    
                    <button onclick="result(event)" class="button" name="submit"> Submit </button>
                    <p id="result"></p>
                    </ul>
    <?php } ?>
    </form>
                <hr>
        <!-- destroy session button -->
        <form action="index.php" method="POST" class="clear-form">
            <label for='clear'></label>
            <input class="button-clear" id='clear' name='clear' type="submit" value="Start Quiz Again">
        </form>
        <?php
            if(isset($_POST['clear'])) {
                session_destroy();
                header('Location: index.php');
                exit();
            }   
        ?>
        
        <script>
            document.querySelector('.radiogroup').addEventListener('change', (evt) => {
                evt.currentTarget
                    .querySelectorAll('.active')
                    .forEach(element => {
                    element.classList.remove('active')
                    })
                evt.target
                    .closest('.input-container')
                    .classList.add('active');
                }, true);

            // to prevent double submit on refreshing page
            if ( window.history.replaceState ) {
                // window.history.replaceState( null, null, window.location.href );
                window.history.replaceState( null, null, 'http://localhost:8888/index.php');
            }           
        </script>
        <script>
            function result(event) {
                event.preventDefault();
                document.getElementById("result").innerHTML = "Your answer is: ";
            }
            function resultButton(event) {
                document.getElementById(event.target.id).innerHTML = "Your answer is: ";
            }
            function sel(id) {
            var divs=document.getElementById('container').getElementsByTagName('div');  //get all divs from div called container
            for(var i=0;i<divs.length; i++) {
                if(divs[i]!=id) {  //if not selected div set .items css
                    divs[i].className='items';
                }
            }
            id.className='selitem';  //set different css for selected one
        }
        </script>
        <div id="container">
            <div class="items" onclick="sel(this)">one</div>
            <div class="items" onclick="sel(this)">one</div>
            <div class="items" onclick="sel(this)">one</div>
            <div class="items" onclick="sel(this)">one</div>
            <div class="items" onclick="sel(this)">one</div>
            <div class="items" onclick="sel(this)">one</div>
            <div class="items" onclick="sel(this)">one</div>
        </div>

        <button id="cell1" onclick="resultButton(event)">-</button>
        <button id="cell2" onclick="resultButton(event)">-</button>
        <button id="cell3" onclick="resultButton(event)">-</button>

        
    </body>
