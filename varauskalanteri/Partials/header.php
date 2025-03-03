<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/burger.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/pages.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ilmoittautumisjärjestelmä</title>
    <!-- js -->
    <script defer src="script.js"></script>
    <script defer src="calendar-script.js"></script>

</head>
<body>
    <?php
    require_once "../Database/Model/user.php";
    if(isLoggedIn()) {
        $user = GetUserByID($_SESSION["userID"]);
        $mainUser = getMainUserByID($_SESSION["userID"]);
    }
    ?>
    
    <!-- <div class="loader-container">
        <div id="loader"></div>
    </div>

    <div id="content"> -->

        <header class="header">
            <div class="header-container">

                <div class="logo">
                    <a href="/"><i class="fa-solid fa-computer"></i></a>
                </div>
                <div class="main-title">
                    <h1>Ilmoittautumisjärjestelmä</h1>
                </div>
                <nav class="menu">
                    <ul class="menu__list">
                    <?php if(isLoggedIn() && $mainUser) {?>
                        <li><a class="navbar-link" href="/students">Opiskelijat</a></li>
                        <li><a class="navbar-link" href="/computers">Tietokoneet</a></li>
                        <li><a class="navbar-link" href="/classes">Luokat</a></li>
                    <?php }?>
                    <?php if(isLoggedIn() && !$mainUser){?>
                        <li><a class="navbar-link" href="/reservation_history">Varaushistoria</a></li>
                    <?php }?>
                    <?php if(isLoggedIn()){?>
                        <li><a class="navbar-link" href="/profile">Profiili</a></li>
                        <li><a class="navbar-link" href="/logout">Logout</a></li>
                        
                    <?php } else { ?>
                        <li><a class="navbar-link" href="/login">Kirjaudu</a></li>
                        <li><a class="navbar-link" href="/register">Rekisteröityä</a></li>
                    <?php } ?>
                    <li><a class="navbar-link" href="/contacts">Yhteystiedot</a></li>
                    <li><a href="/"><button class="navbutton">Varaus</button></a></li>
                    </ul>
                </nav>
                <div class="off-screen-menu">
                    <ul>
                        <?php if(isLoggedIn() && $mainUser) {?>
                            <li><a class="burger__link" href="/reservations">Varaukset</a></li>
                            <li><a class="burger__link" href="/students">Opiskelijat</a></li>
                            <li><a class="burger__link" href="/computers">Tietokoneet</a></li>
                            <li><a class="burger__link" href="/classes">Luokat</a></li>
                        <?php }?>
                        <?php if(isLoggedIn() && !$mainUser){?>
                            <li><a class="burger__link" href="/reservation_history">Varaushistoria</a></li>
                        <?php }?>
                        <?php if(isLoggedIn()){?>
                            <li><a class="burger__link" href="/profile">Profiili</a></li>
                            <li><a class="burger__link" href="/logout">Kirjaudu ulos</a></li>
                            <li><a class="burger__link" href="/contacts">Yhteystiedot</a></li>
                        <?php } else { ?>
                            <li><a class="burger__link" href="/login">Kirjaudu</a></li>
                            <li><a class="burger__link" href="/register">Rekisteröityä</a></li>
                            <li><a class="burger__link" href="/contacts">Yhteystiedot</a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="burger">
                    <div class="burger-spans">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
        </div>
    </header>

    <main>
        
