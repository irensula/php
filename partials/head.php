<!DOCTYPE html>
<html lang="fi">
<head>
    <title>PHP</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/uutiset.css" type="text/css">
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
    <header>
        <h1>Receptit</h1>
    </header>
<nav>
    <ul class="navbar">
        <li class="navbutton"><a href="/">Receptit</a></li>
        <?php if(!isLoggedIn()): ?>
           <li class="navbutton"><a href="/login">Login</a></li> 
           <li class="navbutton"><a href="/register">Rekisteröidy</a></li>
        <?php else: ?>
           <li class="navbutton"><a href="/add_recipe">Uusi recepti</a></li>
           <li class="navbutton"><a href="/user_page">Oma sivu</a></li>
           <li class="navbutton"><a href="/logout">Logout</a></li>
        <?php endif ?>

    </ul>
</nav>