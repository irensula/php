<?php
session_start();
set_include_path(dirname(__FILE__) . '/../');

$route = explode("?", $_SERVER['REQUEST_URI'])[0];
$method = strtolower($_SERVER['REQUEST_METHOD']);

require_once "libraries/auth.php";
require_once "Controller/pageManagement.php";
require_once "Controller/userManagement.php";
require_once "Controller/addReservationManagement.php";
require_once "Controller/reservationManagement.php";
require_once "Controller/reservationCalendarManagement.php";
require_once "Controller/computerManagement.php";
require_once "Controller/classManagement.php";
require_once "Controller/contactsController.php";

switch ($route) {
  case '/':
    if (isLoggedIn()) {
      if (getMainUserByID($_SESSION["userID"])) {
        viewReservationsController();
      } else {
        mainpageController();
      }
    } else {
      mainpageController();
    }
    break;

  case "/add_application": // add reservation
    if (isLoggedIn()) {
      makeApplicationController();
    } else {
      loginController();
    }
    break;
    
  // case "/add_reservation":
  //   if (isLoggedIn()) {
  //     addReservationController();
  //   } else {
  //     loginController();
  //   }
  //   break;

  case "/profile":
    if (isLoggedIn()) {
      profileController();
    } else {
      loginController();
    }
    break;

  case "/register":
    if (isLoggedIn()) {
      profileController();
    } else {
      registerController();
    }
    break;

  case "/login":
    if (isLoggedIn()) {
      profileController();
    } else {
      loginController();
    }
    break;

  case "/logout":
    logoutController();
    break;

  case "/reservations":
    viewReservationsController();
    break;

  case "/singleReservation":
    viewSingleReservationController();
    break;

  case "/approveSuperReservation":
    approveSuperReservationController();
    break;

    case "/edit-info":
      if (isLoggedIn()) {
          editInfoController();
      } else {
        loginController();
      }
      break;
    
  case "/approve":
    if (isLoggedIn()) {
      approveReservationController();
    } else {
      loginController();
    }
    break;

  case "/cancel":
    if (isLoggedIn()) {
      cancelReservationController();
    } else {
      loginController();
    }
    break;

  case "/absent":
    if (isLoggedIn()) {
      studentIsAbsentController();
    } else {
      loginController();
    }
    break;

  case "/present":
    if (isLoggedIn()) {
      studentIsPresentController();
    } else {
      loginController();
    }
    break;

  case "/students":
    if (isLoggedIn()) {
      userController();
    } else {
      mainpageController();
    }
    break;

  case "/student":
    if (isLoggedIn()) {
      studentController();
    } else {
      mainpageController();
    }
    break;

  case "/deactivate":
    if (isLoggedIn()) {
      deactivateUserController();
    } else {
      loginController();
    }
    break;

  case "/activate":
    if (isLoggedIn()) {
      activateUserController();
    } else {
      loginController();
    }
    break;

  case "/delete":
    if (isLoggedIn()) {
      deleteUserController();
    } else {
      loginController();
    }
    break;

  case "/accept":
    if (isLoggedIn()) {
      acceptUserController();
    } else {
      loginController();
    }
    break;

    //Rekisteröinnin tarkistaminen
  /*case "/verify":
    if (!isLoggedIn()) {
      verifyController();
    } else {
      profileController();
    }
    break;*/

  case "/reservationcalendar":
    if (isLoggedIn()) {
      reservationCalendarController();
    } else {
      loginController();
    }
    break;

  case "/reservation_history":
    if (isLoggedIn()) {
      reservationHistoryController();
    } else {
      loginController();
    }
    break;
  
  case "/reservation_card":
    if (isLoggedIn()) {
      reservationCardController();
    } else {
      loginController();
    }
    break;

  case "/computers":
    if (isLoggedIn()) {
      ComputersController();
    } else {
      loginController();
    }
    break;
  
  case "/classes":
    if (isLoggedIn()) {
      classController();
    } else {
      loginController();
    }
    break;

  case "/edit_class":
    if (isLoggedIn()) {
      editClassController();
    } else {
      loginController();
    }
    break;
    
  case "/update_class":
    if (isLoggedIn()) {
      updateClassController()();
    } else {
      loginController();
    }
    break;

  case "/delete_class":
    if (isLoggedIn()) {
      classController();
    } else {
      loginController();
    }
    break;

  case "/delete_reservation":
    if (isLoggedIn()) {
      deleteReservationController();
    } else {
      loginController();
    }
    break;
  
  case "/contacts":
    // if (isLoggedIn()) {
    //   contactsController();
    // } else {
    //   loginController();
    // }
    require '../View/contacts.view.php';
    break;

  default:
    errorController();
}
