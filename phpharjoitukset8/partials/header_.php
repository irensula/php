<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href=".././styles/reset.css">
    <link rel="stylesheet" href=".././styles/main.css">
    
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Eagle+Lake&family=Gloock&family=MedievalSharp&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Reseptipankki</title>
</head>
<body>
<script>
    function confirmDelete(id) {
        const answer = confirm("Poistetaanko resepti?");
        if(!answer){
            document.getElementById('deleteNews' + id).href = '/';
        }
        return answer;
    }
</script>
    <header class="header_">
        
        <div class="header-container">
        <div class="title-container">
            <nav>
                <ul class="navbar">
                <li class="navbutton"><a href="/recipes"><sapn class="yellow">Receptit</span></a></li>
                    <?php if(!isLoggedIn()): ?>  
                    <li class="navbutton"><a href="/register">Rekisteröidy</a></li>
                    <li class="navbutton"><a id="login-button" href="/login">Login</a></li>
                    <?php else: ?>
                    <li class="navbutton"><a href="/add_recipe">Uusi recepti</a></li>
                    <li class="navbutton"><a href="/user_page">Oma sivu</a></li>
                    <li class="navbutton"><a href="/logout">Logout</a></li>
                    <?php endif ?>
                </ul>
            </nav>
            <h1>Reseptipankki</h1>
            <p>Tämä on loistava paikka, jossa voit jakaa maukkaita reseptejäsi tai löytää hyviä reseptejä itsellesi.<br>
                Anna elämäsi maistua herkulliselta!</p>
            <button class="yellow-button"><a href="/recipes">Hae resepti</a></button>
        </div>
        <div class="img-container"></div>
        </div>
    </header>
    <main>