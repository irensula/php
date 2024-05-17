<?php

session_start();

set_include_path(dirname(__FILE__) . '/../');

$route = explode("?", $_SERVER["REQUEST_URI"])[0];
$method = strtolower($_SERVER["REQUEST_METHOD"]);

require_once 'libraries/auth.php';
require_once 'controllers/userManagement.php';
require_once 'controllers/recipeManagement.php';

switch($route) {
    case "/":
      require '.././views/home.view.php';
    break;
    
    case '' :
      require '.././views/home.view.php';
    break;

    case "/home":
      require '.././views/home.view.php';
    break;

    case "/recipes":
        viewRecipesController();
    break;

    case "/recipe":
        viewRecipeController();  
    break;

    case "/register":
        registerController();
    break;

    case "/login":
        loginController();
    break;

    case "/logout":
        logoutController();
    break;

    case "/add_recipe":
      if(isLoggedIn()){
        addRecipeController();
      } else {
        loginController();
      }
    break;

    case "/delete_recipe":
      if(isLoggedIn()){
        deleteRecipeController();
      } else {
        loginController();
      }
    break;

    case "/update_recipe":
      if(isLoggedIn()){
        if($method == "get"){
          editRecipeController();  
        } else {
          updateRecipeController();
        }
      } else {
        loginController();
      }
    break;
    
    case "/user_page":
      if(isLoggedIn()){
        viewUserPageController();
      } else {
        loginController();
      }
    break;

    case "/update_userInfo":
      if(isLoggedIn()){
        if($method == "get"){
          editUserInfoController();  
        } else {
          updateUserInfoController();
        }
      } else {
        loginController();
      }
    break;
    
    case "/contacts":
      require '.././views/contacts.view.php';
    break;

    case "/print_recipe":
      printRecipeController();
    break;

    default:
      echo "Error 404";
  }
