<!-- quiz

id (PK)
quiz_name (text)
quiz_question

id (PK)
quiz_id (FK)
question (text)
quiz_question_option

id (PK)
quiz_question_id (FK)
quiz_option (text)
is_correct (enum 0, 1)
-->
<div id="quiz"> 
  <?php

    // aggregate an array of options
    $option_results = mysqli_query($conn, "SELECT qo.* FROM quiz_question_option qo
        LEFT JOIN quiz_question q ON (qo.quiz_question_id = q.id)
        WHERE q.quiz_id = 1");
    $options = [];
    while ($option = mysqli_fetch_assoc($option_results)) {
        $options[$option['quiz_question_id']] = $option;
    }
    mysqli_free_result($option_results);

    $number = $_POST['number'];
    $sql = "SELECT * FROM quiz_question WHERE quiz_id = 1 ORDER BY RAND() LIMIT $number";
    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0)
    {
         while ($question = mysqli_fetch_assoc($result)) {
             echo "<p>";
             echo $question['question'];
             echo "</p>";
         }

         if (isset($options[$question['id']])) {
             echo "<ul>";
             foreach ($options[$question['id']] as $option) {
                 echo $option['quiz_option'];
             }
             echo "</ul>";
         }
    }
  ?>
</div>

<div id="quiz">
  <?php
    $number = $_POST['number'] ?? 10000;
    $quiz_id = 1;

    // aggregate an array of all questions' options of a quiz
    $option_stmts = mysqli_prepare($conn, "SELECT qo.* FROM quiz_question_option qo
        LEFT JOIN quiz_question q ON (qo.quiz_question_id = q.id)
        WHERE q.quiz_id = ?");
    $option_stmts->bind_param('i', $quiz_id);
    $option_results = $option_stmts->execute();
    $options = [];
    while ($option = mysqli_fetch_assoc($option_results)) {
        $options[$option['quiz_question_id']] = $option;
    }
    mysqli_free_result($option_results);
    mysqli_stmt_close($option_stmts);

    // query for all the questions of a quiz
    $stmt = mysqli_prepare($conn, "SELECT * FROM quiz_question WHERE quiz_id = ? ORDER BY RAND() LIMIT ?");
    $stmt->bind_param('ii', $quiz_id, $number);
    $result = $stmt->execute();

    if (mysqli_num_rows($result) > 0)
    {
         while ($question = mysqli_fetch_assoc($result)) {
             echo "<p>";
             echo $question['question'];
             echo "</p>";
         }

         if (isset($options[$question['id']])) {
             echo "<ul>";
             foreach ($options[$question['id']] as $option) {
                 echo $option['quiz_option'];
             }
             echo "</ul>";
         }
    }
  ?>
</div>

<!-- https://beproblemsolver.com/online-quiz-system-in-php/ -->