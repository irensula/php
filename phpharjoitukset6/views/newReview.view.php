<?php require "../partials/header.php"; ?>

<h2 class="update-title centered">Syötä arvostelu</h2>

<div class="inputarea">

    <form class="update-form" action="/add_review" method="post" >
        
        <label for="nimi">Nimi:</label>
        <input id="nimi" type="text" name="reviewName" maxlength="30">
        
        <label for="arvostelu">Arvostelu:</label>
        <textarea id="arvostelu" name="reviewText" rows="10" cols="30"></textarea>     
        
        <label for="arvosana">Arvosana: </label>
        <input id="arvosana" type="number" min="1" max="5" name="reviewGrade">
        
        <label for="tyyppi">Valitse osasto:</label>
        <select id="tyyppi" name="type">
            <option value="kirja">Kirja</option>
            <option value="elokuva">Elokuva</option>
            <option value="peli">Peli</option>
            <option value="sarja">Sarja</option>
        </select>
        
        <button id="sendbutton" class="yellow-button" type="submit" value="Lähetä">Lähetä</button>

    </form>
</div>

<?php require "../partials/footer.php"; ?>