<?php require "../partials/header.php"; ?>

<div class="reviews-container">
    <select id="type" name="type">
                <option value="Kaikki tyypit">Kaikki tyypit</option>
                <option value="kirja">Kirjat</option>
                <option value="peli">Pelit</option>
                <option value="elokuva">Elokuva</option>
                <option value="sarja">Sarjat</option>
            </select>
            <button type="submit" class="submit-button">Submit</button>
    <div class = "review-container">
        <form action="/" method="POST">
            <label for="type"></label>
            
        </form>

        <?php
        foreach($allReviews as $review): ?>
            
            <div class='review'>
                <p class="review-type"><?=$review["type"]?></p>
                <h3><?=$review["name"] ?></h3>
                <!-- stars -->
                <div class="star-rating">
                    <ul class="list-inline">
                    <?php 
                    $start = 1;
                    while ($start <= 5) {
                        if ($review["grade"] < $start) { ?>
                            <li class=list-inline-item><i class="fa-regular fa-star"></i></li>
                            
                            <?php } else { ?>
                                <li class=list-inline-item><i class="fa-solid fa-star"></i></li>
                            <?php } ?>
                        
                    <?php $start++; } ?>
                    </ul>
                </div>
                <!-- stars -->
                <p><?=$review["text"]?></p>
                <p class="strong">By user: <?=$review["userName"]?></p>
                <p><?=$review["date"]?></p>
                <?php
                if(isLoggedIn() && ($review["userID"] == $_SESSION['userid'])):
                    $id = $review['reviewID'];
                    $reviewid = 'deleteNews' . $id; ?>

                    <a class="edit-button" href='/update_review?id=<?=$id?>'>Päivitä</a> |

                    <a class="delete-button" id=<?=$reviewid ?> onClick='confirmDelete(<?=$id?>)' href='/delete_review?id=<?=$id?>'>Poista</a>
                <?php endif; ?>
            </div>
        <?php endforeach ?>
    </div>
</div>
<?php 
require ".././partials/footer.php"; ?>