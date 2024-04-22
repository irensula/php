<h2 class="centered">Tietovisa</h2>

<div class = "news">

    <?php

    foreach($allnews as $newsitem): ?>
        
        <div class='newsitem'>
            <h3><?=$newsitem["title"] ?></h3>
            <p><?=$newsitem["text"]?></p>
            <p><?=$newsitem["created"]?> By user: <?=$newsitem["userid"]?></p>
            <p><?=$newsitem["section"]?></p>
            <?php
            if(isLoggedIn() && ($newsitem["userid"] == $_SESSION["userid"])):
                $id = $newsitem['articleid'];
                $newsid = 'deleteNews' . $id; ?>
                
                
            <?php endif; ?>
        </div>
    <?php endforeach ?>
</div>

