<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require "../Partials/header.php";

    // Initialize time with a default value or from POST request
    $time = isset($_POST['time']) ? $_POST['time'] : '';

    // Initialize start_date and end_date similarly
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

    // Check if the button was pressed and if free computers are available
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $time = $_POST['time'];

        // Get available computers based on the POST data
        $freeComputers = getFreeComputers($start_date, $end_date, $time);
    } else {
        $freeComputers = [];  // If the button was not pressed, don't show any computers
    }
?>

<!-- form for making reservation -->
<div class="application-container">

    <h2 class="form-title">Ilmoitus</h2>

    <div class="application-inputarea">

        <?php if (isset($_SESSION['message'])): ?>
            <div class="reservation-result">
                <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']); // Clear the message after displaying it
                ?>
            </div>
        <?php endif; ?>

        <form id="reservation-form" class="application-form" action="" method="post">
            <?php include "../Partials/calendar.php"; ?>
            
            <label class="label" for="start_date"></label>
            <input id="start_date" class="input" type="date" name="start_date" value="<?php echo htmlentities($start_date ?? '');?>" min="<?php echo date('Y-m-d'); ?>" required>
           
            <label class="label" for="end_date">Lopetus päivä</label><br>
            <input class="input" id="end_date" type="date" name="end_date" value="<?php echo htmlentities($end_date ?? '');?>" min="<?php echo date('Y-m-d'); ?>">
                 
            <label class="label" for="time">Aika</label>
            <select id="time" name="time">
                <option value="aamupäivä" <?php echo ($time == "aamupäivä") ? "selected" : ""; ?>>Aamupäivä</option>
                <option value="iltapäivä" <?php echo ($time == "iltapäivä") ? "selected" : ""; ?>>Iltapäivä</option>
                <option value="kokopäivä" <?php echo ($time == "kokopäivä") ? "selected" : ""; ?>>Kokopäivä</option>
                <option value="supervaraus" <?php echo ($time == "supervaraus") ? "selected" : ""; ?>>Supervaraus</option>
            </select><br>
            
            <input id="approved" type="hidden" name="approved" value="0">
            
            <button class="free-computers-button" id="sendbutton" type="submit" value="Lähetä" name="submit">Katso vapaita tietokoneita</button>           
                                  
        </form>

        <?php if (isset($freeComputers) && count($freeComputers) > 0): ?>
            <div class="available-computers">
                <form method="POST" action="/add_application">
                    <label for="computer">Valitse tietokone</label>
                    <select id="computer" name="computer" required>
                        <?php foreach ($freeComputers as $computer): ?>    
                            <?php if($computer['päivä'] == NULL 
                                    && $computer['loppuPäivä'] == NULL 
                                    && $computer['varaustyyppi'] !== $time
                                    && $computer['varaustyyppi'] !== 'kokopäivä'
                                    && $computer['varaustyyppi'] !== 'supervaraus') { ?> 
                            <option value="<?php echo $computer['tietokoneID']; ?>">
                                Tietokone <?php echo $computer['numero']; ?> (<?php echo $computer['tietoja'] . " - " . $computer['varaustyyppi']; ?>)
                            </option>
                        <?php } ?>
                        <?php endforeach; ?>
                    </select>
                    <br>
                    <label class="label" for="description">Selitys</label><br>
                    <textarea name="description" id="description" required></textarea> 
                    <!-- Pass the selected dates and time to the form -->
                    <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
                    <input type="hidden" name="end_date" value="<?php echo $end_date; ?>">
                    <input type="hidden" name="time" value="<?php echo $time; ?>">
                        
                    <button class="button" type="submit" value="Varata tietokone">Varata tietokone</button>
                </form>
            </div>
        <?php elseif (isset($freeComputers) && count($freeComputers) == 0): ?>
            <p>Ilmaisia ​​tietokoneita ei ole saatavilla valitulle päivämäärälle ja kellonajalle.</p>
        <?php endif; ?>

    </div>
</div>

<?php require "../Partials/footer.php"; ?>
