<?php 
require_once "../Database/connection.php";

// student can make reservation
function makeApplication($studentID, $computerID, $start_date, $end_date, $time, $description){
    $pdo = connect();
    $approved = ($time === 'supervaraus') ? 0 : 1;
    $data = [$studentID, $computerID, $start_date, $end_date, $time, $description, $approved];
    $sql = "INSERT INTO varaus (opiskelijaID, tietokoneID, päivä, loppuPäivä, varaustyyppi, selitekenttä, hyväksytty) VALUES(?,?,?,?,?,?,?);";
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

// student can see free computers for concrete time
function getFreeComputers($start_date, $end_date, $time) {
    $pdo = connect();

    // Convert empty string to NULL for end_date
    $end_date = !empty($end_date) ? $end_date : null;

    $sql = "SELECT  
                tietokone.tietokoneID, 
                tietokone.numero, 
                tietokone.tietoja, 
                tietokone.tilaID, 
                varaus.päivä, 
                varaus.loppuPäivä, 
                varaus.varaustyyppi
            FROM 
                tietokone
            LEFT JOIN 
                varaus 
                ON tietokone.tietokoneID = varaus.tietokoneID
                AND (
                    -- Reservation period includes the specific day, handles partial overlaps
                    (varaus.päivä <= :end_date AND varaus.loppuPäivä >= :start_date)
                )
                AND (
                    -- Filtering by reservation type
                    varaus.varaustyyppi = :time 
                    OR varaus.varaustyyppi = 'kokopäivä' 
                    OR varaus.varaustyyppi = 'supervaraus'
                )
            INNER JOIN
                tila
                ON tietokone.tilaID = tila.tilaID
            WHERE tietokone.tilaID = 1;
            ";

    // Prepare the SQL statement
    $stm = $pdo->prepare($sql);

    // Bind the parameters
    $stm->bindValue(':start_date', $start_date, PDO::PARAM_STR);
    // If $end_date is null, bind as PDO::PARAM_NULL, otherwise as string
    $stm->bindValue(':end_date', $end_date, $end_date === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $stm->bindValue(':time', $time, PDO::PARAM_STR);

    // Execute the statement
    $stm->execute();

    // Fetch the results
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

// student can reserve only 1 computer for concrete time
function oneComputerForOneStudent($studentID, $start_date, $end_date, $time) {
    $pdo = connect();  
    $sql = "SELECT COUNT(*) as conflicts
                FROM varaus
                WHERE opiskelijaID = :studentID
                AND (
                    (päivä BETWEEN :start_date AND :end_date) 
                    OR (loppuPäivä BETWEEN :start_date AND :end_date)
                    OR (:end_date BETWEEN päivä AND loppuPäivä)
                )
                AND varaustyyppi = :time
            ;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':studentID' => $studentID,
        ':start_date' => $start_date,
        ':end_date' => $end_date,
        ':time' => $time
    ]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['conflicts'] > 0;  
}

// check if there is only one reservation for the computer for concrete time
function checkReservationData($computerID, $start_date, $end_date, $varaustyyppi) {
    $pdo = connect();
    $sql = "SELECT COUNT(*) as conflicts
            FROM varaus
            WHERE tietokoneID = :computerID
            AND päivä = :start_date
            AND loppuPäivä = :end_date
            AND varaustyyppi = :varaustyyppi;";
    $stm = $pdo->prepare($sql);
    $stm->execute([
        ':computerID' => $computerID,
        ':start_date' => $start_date,
        ':end_date' => $end_date,
        ':varaustyyppi' => $varaustyyppi
    ]);
    $result = $stm->fetch(PDO::FETCH_ASSOC);
    return $result['conflicts'];
}
function checkIfWholeDay($computerID, $start_date, $end_date) {
    $pdo = connect();
    $sql = "SELECT COUNT(*) as conflicts
            FROM varaus
            WHERE tietokoneID = :computerID
            AND päivä = :start_date
            AND loppuPäivä = :end_date
            AND (varaustyyppi = 'aamupäivä' OR varaustyyppi = 'iltapäivä')";
    $stm = $pdo->prepare($sql);
    $stm->execute([
        ':computerID' => $computerID,
        ':start_date' => $start_date,
        ':end_date' => $end_date
    ]);
    $result = $stm->fetch(PDO::FETCH_ASSOC);
    return $result['conflicts'];
}
function checkIfDays($computerID, $start_date, $end_date) {
    $pdo = connect();  
    $sql = "SELECT COUNT(*) as conflicts
        FROM varaus
        WHERE tietokoneID = :computerID
        AND (
            (päivä BETWEEN :start_date AND :end_date) 
            OR (loppuPäivä BETWEEN :start_date AND :end_date)
            OR (:end_date BETWEEN päivä AND loppuPäivä)
        );";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':computerID' => $computerID,
        ':start_date' => $start_date,
        ':end_date' => $end_date
    ]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['conflicts'] > 0;  
}
function checkComputerStatus($computerID) {
    $pdo = connect();
    $sql = "SELECT COUNT(*) as conflicts
            FROM varaus
            WHERE tietokoneID = :computerID
            AND päivä = :start_date
            AND loppuPäivä = :end_date
            AND varaustyyppi = :varaustyyppi
            ;";
    $stm = $pdo->prepare($sql);
    $stm->execute([
        ':computerID' => $computerID,
        ':start_date' => $start_date,
        ':end_date' => $end_date,
        ':varaustyyppi' => $varaustyyppi
    ]);
    $result = $stm->fetch(PDO::FETCH_ASSOC);
    return $result['conflicts'];
}