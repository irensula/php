document.addEventListener("DOMContentLoaded", function () {
    let startDate = null;
    let endDate = null;
    let timeValue = null; // Add a variable to store the selected time

    // Function to parse and compare dates
    function parseDate(dateStr) {
        return new Date(dateStr);
    }

    document.querySelectorAll('.calendar .day a').forEach(dayElement => {
        dayElement.addEventListener('click', function (event) {
            event.preventDefault(); 
            let selectedDate = this.getAttribute('data-date');
            if (!selectedDate) return; // Skip if invalid date

            // Toggle start and end dates
            if (!startDate || (startDate && endDate)) {
                startDate = selectedDate;
                endDate = null; // Reset end date
            } else if (startDate && !endDate) {
                if (parseDate(selectedDate) > parseDate(startDate)) {
                    endDate = selectedDate;
                } else {
                    startDate = selectedDate;
                    endDate = null;
                }
            }

            updateInputFields();
            updateCalendarHighlighting();
            updateURL();
        });
    });

    function updateInputFields() {
        let startInput = document.getElementById('start_date');
        let endInput = document.getElementById('end_date');
        let timeSelect = document.getElementById('time');

        if(startInput) startInput.value = startDate || '';
        if (endInput) endInput.value = endDate || '';

        if (startDate && endDate) {
            timeSelect.value = "supervaraus";
            disableOtherTimeOptions(true);
        } else {
            disableOtherTimeOptions(false);
        }

        // Ensure time is also updated when the user selects a time from the dropdown
        timeValue = timeSelect.value; 
    }

    function disableOtherTimeOptions(disable) {
        let timeSelect = document.getElementById('time');
        let options = timeSelect.options;

        for (let i = 0; i < options.length; i++) {
            if (options[i].value !== "supervaraus") {
                options[i].disabled = disable;
            }
        }
    }

    function updateCalendarHighlighting() {
        // Reset all highlights
        document.querySelectorAll('.calendar .day').forEach(dayElement => {
            dayElement.classList.remove('start-date', 'end-date', 'in-range');
        });

        // Highlight start date
        if (startDate) {
            let startElement = document.querySelector(`.calendar .day a[data-date="${startDate}"]`);
            if (startElement) startElement.parentElement.classList.add('start-date');
        }

        // Highlight end date
        if (endDate) {
            let endElement = document.querySelector(`.calendar .day a[data-date="${endDate}"]`);
            if (endElement) endElement.parentElement.classList.add('end-date');
        }

        // Highlight in-range dates
        if (startDate && endDate) {
            document.querySelectorAll('.calendar .day a').forEach(dayElement => {
                let dayDate = dayElement.getAttribute('data-date');
                if (parseDate(dayDate) > parseDate(startDate) && parseDate(dayDate) < parseDate(endDate)) {
                    dayElement.parentElement.classList.add('in-range');
                }
            });
        }
    }

    function updateURL() {
        let url = new URL(window.location.href);
        url.searchParams.set('start_date', startDate);
        if (endDate) {
            url.searchParams.set('end_date', endDate);
        } else {
            url.searchParams.delete('end_date');
        }

        // Add time to the URL as well
        if (timeValue) {
            url.searchParams.set('time', timeValue);
        } else {
            url.searchParams.delete('time'); // Remove time if no value selected
        }

        history.pushState({}, '', url.toString()); // Update URL without reloading
    }
});
//     function updatePHP() {
//         fetch('update_dates.php', {
//             method: 'POST',
//             headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
//             body: `start_date=${startDate}&end_date=${endDate || ''}`
//         })
//         .then(response => response.text())
//         .then(data => {
//             console.log("Server response:", data); // Debugging
//             document.getElementById('start_date').value = startDate;
//             if (endDate) {
//                 document.getElementById('end_date').value = endDate;
//             }
//         })
//         .catch(error => console.error('Error:', error));
//     }