// BURGER MENU
document.addEventListener("DOMContentLoaded", () => {
    const hamMenu = document.querySelector(".burger-spans");
    
    const offScreenMenu = document.querySelector(".off-screen-menu");
    
    hamMenu.addEventListener("click", () => {
        console.log("ham was clicked");
      hamMenu.classList.toggle("active");
      offScreenMenu.classList.toggle("active");
      });
    });
// TABS
function handleToggle() {
  let sliderToggle = document.getElementById('sliderToggle');
  if (sliderToggle.checked) {
    console.log("Slider is ON");
  } else {
    console.log("Slider is OFF");
  }
}  

    // Show or hide the endDay input based on the selected time option
    function singleSelectChangeStyle() {
      let selObj = document.getElementById("time");
      let selValue = selObj.options[selObj.selectedIndex].value;

      if (selValue === "supervaraus") {
          document.getElementById('hiddenEndDay').classList.add('visibleEndDay');
      } else {
          document.getElementById('hiddenEndDay').classList.remove('visibleEndDay');
      }
  }

  // Update the endDay input to match the day input by default
  function updateHiddenInput() {
      let visibleValue = document.getElementById('day').value;
      document.getElementById('endDay').value = visibleValue;
  }

  // show end day after submiiting date and time
      function showEndDay() {
          let day = document.getElementById("day").value;
          let endDay = document.getElementById("endDay").value;

          if(endDay > day) {
              document.getElementById('hiddenEndDay').classList.add('visibleEndDay');
              alert(endDay );
          } else {
            alert('else');
            document.getElementById('hiddenEndDay').classList.remove('visibleEndDay');
          }
      }
//   function DoSubmit(){
//     let day = document.getElementById("day").value;
//     let endDay = document.getElementById("endDay").value;
//     console.log(day);
//     console.log(endDay);
//     if (endDay !== day) {
//         document.getElementById("hiddenEndDay").classList.add('visibleEndDay');
//         document.getElementById("hiddenEndDay").classList.remove('hiddenEndDay');
//     }
// }
// LOAD
// window.addEventListener("load", function() {
//     // Minimum loading time of 3 seconds
//     const minLoadTime = 3000;
//     const startTime = new Date().getTime();

//     // Hide loader after the page is fully loaded but wait at least 3 seconds
//     const hideLoader = () => {
//         const currentTime = new Date().getTime();
//         const elapsedTime = currentTime - startTime;

//         if (elapsedTime >= minLoadTime) {
//             document.getElementById('loader').style.display = 'none';
//             document.getElementById('content').style.display = 'block';
//             document.body.style.overflow = 'auto'; // Restore scrolling
//         } else {
//             setTimeout(hideLoader, minLoadTime - elapsedTime);
//         }
//     };

//     hideLoader();
//   });

function optionChecked(that) {
  if (that.value == "other") {
      document.getElementById("other").style.display = "block";
  } else {
      document.getElementById("other").style.display = "none";
  }
}

function showSearchMenu() {
  const menu = document.getElementById("search-menu");
  menu.style.display = menu.style.display === "block" ? "none" : "block";
}

function showAll() {
  const showAllCheckbox = document.getElementById("showAll");
  const otherCheckboxes = document.querySelectorAll('#accept, #decline, #absent');

  if (showAllCheckbox.checked) {
      otherCheckboxes.forEach((checkbox) => {
          checkbox.checked = false;
      });
      showAllReservations();
  }
}

function toggleOtherSearchTerms() {
  const showAllCheckbox = document.getElementById("showAll");
  const anyOtherChecked = document.querySelectorAll('#accept:checked, #decline:checked, #absent:checked').length > 0;

  if (anyOtherChecked) {
      showAllCheckbox.checked = false;
  }

  filterReservations();
}

function acceptedResevations() {
  toggleOtherSearchTerms();
}

function declinedResevations() {
  toggleOtherSearchTerms();
}

function absentResevations() {
  toggleOtherSearchTerms();
}


function showAllReservations() {
  const reservationElements = document.querySelectorAll(".all-reservation");
  reservationElements.forEach((reservation) => {
      reservation.style.display = "block";
  });
}


function filterReservations() {
  const showAccepted = document.getElementById("accept").checked;
  const showDeclined = document.getElementById("decline").checked;
  const showAbsent = document.getElementById("absent").checked;

  const reservationElements = document.querySelectorAll(".all-reservation");

  reservationElements.forEach((reservation) => {
      const isAccepted = reservation.querySelector(".reservation-info:nth-child(5)").innerText.includes("Kyllä");
      const isDeclined = reservation.querySelector(".reservation-info:nth-child(6)").innerText.includes("Kyllä");
      const isAbsent = reservation.querySelector(".reservation-info:nth-child(7)").innerText.includes("Kyllä");

      let showReservation = true;


      if (showAccepted && !isAccepted) {
          showReservation = false;
      }
      if (showDeclined && !isDeclined) {
          showReservation = false;
      }
      if (showAbsent && !isAbsent) {
          showReservation = false;
      }

      if (showReservation) {
          reservation.style.display = "block";
      } else {
          reservation.style.display = "none";
      }
  });
}