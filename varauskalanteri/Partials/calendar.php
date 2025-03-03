<?php
// Get the current month and year
if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];
} else {
    $month = date('m');
    $year = date('Y');
}

// Calculate the previous and next month
$prev_month = $month - 1;
$next_month = $month + 1;
$prev_year = $year;
$next_year = $year;

if ($prev_month < 1) {
    $prev_month = 12;
    $prev_year--;
}

if ($next_month > 12) {
    $next_month = 1;
    $next_year++;
}

// CALENDAR where student can choose the date
function generate_calendar($month, $year, $start_date = null, $end_date = null)
{
    // Array containing the names of the days of the week
    $days_of_week = array('Ma', 'Ti', 'Ke', 'To', 'Pe', 'La', 'Su');

    // Number of days in the month
    $number_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // Get the first day of the month
    setlocale(LC_TIME, 'fi-FI');
    $date_info = getdate(mktime(0, 0, 0, $month, 1, $year));

    // Index value 0-6 of the first day of the month
    $first_day = ($date_info['wday'] + 6) % 7;

    // Create the calendar HTML
    $calendar = "<table class='calendar form'>";
    $calendar .= "<tr>";

    // Create the calendar headers
    foreach ($days_of_week as $day) {
        $calendar .= "<th class='days-of-week form'>$day</th>";
    }

    $calendar .= "</tr><tr>";

    // Fill in the blanks before the first day of the month
    if ($first_day > 0) {
        $calendar .= str_repeat("<td></td>", $first_day);
    }

    $current_day = 1;

    // sessionID, user, mainUser, activeStatus
    if (isLoggedIn()) {
        $user = GetUserByID($_SESSION["userID"]);
        $mainUser = getMainUserByID($_SESSION["userID"]);
        $activeStatus = checkStatusActive($_SESSION["userID"]);
        $today = date("Y-m-d");
    }

    // Fill the calendar with the days of the month
    while ($current_day <= $number_days) {
        // Start a new row each week
        if ($first_day == 7) {
            $first_day = 0;
            $calendar .= "</tr><tr>";
        }

        $table_date = $year . "-" . sprintf('%02d', $month) . "-" . sprintf('%02d', $current_day);
        $class = '';
        if ($table_date == $start_date) {
            $class = 'start-date';
        } elseif ($table_date == $end_date) {
            $class = 'end-date';
        }

        // Add a special class if it's a range of selected dates
        if ($start_date && $end_date && $table_date > $start_date && $table_date < $end_date) {
            $class = 'in-range';
        }

        // Display days based on conditions
        if (!isLoggedIn() || $today > $table_date) {
            $calendar .= "<td class='day-enable form'>$current_day</td>";
        } elseif ($table_date == date("Y-m-d") && $activeStatus) {
            $calendar .= "<td class='day form'>
                <a class='day-today' href='?date=" . urlencode($current_day) . "&month=" . urlencode($month) . "&year=" . urlencode($year) . "&start_date=$start_date&end_date=$end_date' data-date='$table_date'>" . $current_day . "</a>
                </td>";
        } else {
            if ($first_day >= 5) {
                $calendar .= "<td class='day-enable form'>$current_day</td>";
            } else {
                $calendar .= "<td class='day form'>
                    <a href='?date=" . urlencode($current_day) . "&month=" . urlencode($month) . "&year=" . urlencode($year) . "&start_date=$start_date&end_date=$end_date' data-date='$table_date'>" . $current_day . "</a>
                    </td>";
            }
        }

        $calendar .= "</td>";
        $current_day++;
        $first_day++;
    }

    // Complete the last row with empty cells
    if ($first_day != 7) {
        $remaining_days = 7 - $first_day;
        $calendar .= str_repeat("<td></td>", $remaining_days);
    }

    $calendar .= "</tr>";
    $calendar .= "</table>";

    return $calendar;
}

// months in finnish
$months = [
    1 => 'tammikuu',
    2 => 'helmikuu',
    3 => 'maaliskuu',
    4 => 'huhtikuu',
    5 => 'toukokuu',
    6 => 'kesäkuu',
    7 => 'heinäkuu',
    8 => 'elokuu',
    9 => 'syyskuu',
    10 => 'lokakuu',
    11 => 'marraskuu',
    12 => 'joulukuu'
];

?>

<div class="month form">
    <a href="?month=<?php echo $prev_month; ?>&year=<?php echo $prev_year; ?>"><i class="fa-solid fa-chevron-left"></i></a>
    <h2 class="month-title form"><?php echo ucfirst($months[(int)$month]) . " " . $year; ?></h2>
    <a href="?month=<?php echo $next_month; ?>&year=<?php echo $next_year; ?>"><i class="fa-solid fa-chevron-right"></i></a>
</div>

<?php
// Get the start and end dates from the URL (if available)
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

// Generate and display the calendar
echo generate_calendar($month, $year, $start_date, $end_date);
?>