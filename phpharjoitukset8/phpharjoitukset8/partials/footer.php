</main>
<footer>
    <div class="some">
        <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
        <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
        <a href="mailto:someone@example.com"><i class="fa-solid fa-envelope"></i></a>
        <a href="tel:358-46-9395395"><i class="fa-solid fa-phone"></i></a>
    </div>
    <nav class="footer-nav">
        <ul class="footer-navbar">
            <li class="footer-navbutton"><a href="/recipes">Receptit</a></li>
            <?php if(!isLoggedIn()): ?>  
            <li class="footer-navbutton"><a href="/register">Rekisteröidy</a></li>
            <li class="footer-navbutton"><a href="/login">Login</a></li>
            <?php else: ?>
            <li class="footer-navbutton"><a href="/add_recipe">Uusi recepti</a></li>
            <li class="footer-navbutton"><a href="/user_page">Oma sivu</a></li>
            <li class="footer-navbutton"><a href="/logout">Logout</a></li>
            <?php endif ?>
        </ul>
    </nav>
    <div class="footer-bottom">
        <span id="year"></span><span class="copyright"> © All rights reserved.</span>
    </div> 
</footer>

    <!-- js scripts -->
    <script>document.getElementById("year").innerHTML = new Date().getFullYear();</script>
    <script src="https://kit.fontawesome.com/02135387da.js" crossorigin="anonymous"></script>

    </body>
</html>