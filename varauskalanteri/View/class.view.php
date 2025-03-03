<?php require "../Partials/header.php"; ?>
<div class="container-wide">
    <div class="flex-space-between">
        <h1 class="title">Luokat</h1>
         <!-- search bar -->
        <form action="" method="GET">
            <label for="search"></label>
            <input type="text" name="search" id="search" placeholder="">
            <button type="submit">Hae luokka</button>
        </form>
        <button id="addClassButton" onclick="showForm()"><i class="fa-solid fa-plus"></i></button>
    </div>
    
    <?php if (isset($_SESSION['message'])): ?>
            <div class="reservation-result">
                <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
                ?>
            </div>
    <?php endif; ?>

    <form class="hidden" id="addClassForm" method="POST">
        <label class="label" for="className">Luokan tunnus:</label>
        <input class="input" type="text" id="className" name="className" required>

        <label class="label" for="classDescription">Luokan kuvaus:</label>
        <input class="input" type="text" id="classDescription" name="classDescription" required>

        <button class="button" type="submit">Lisää</button>
    </form>

        <?php if(empty($paginatedClasses)): ?>
            <p>Hakutermillä "<?=htmlspecialchars($searchQuery)?>" ei löytynyt luokkia</p>
        <?php else: ?>

    <?php foreach($paginatedClasses as $class): ?>
        <div class="card" method="POST" action="/edit_form">
            <h3 class="inner-title">Luokka: <?php echo htmlspecialchars($class['luokantunnus']);?></h3>
            <p>Luokan kuvaus: <?php echo htmlspecialchars($class['kuvaus']);?></p>
            <input type="hidden" value="<?=$class['luokkaID']?>">
            <button>
                <?php 
                    echo "<a href='/edit_class?classID=" . htmlspecialchars($class['luokkaID']) . "'>Edit</a>";
                ?>
            </button>            
            <a id=<?=$class['luokkaID']?> href='/delete_class?id=<?=$class['luokkaID']?>'>Poista</a>
        </div>
    <?php endforeach ?>
    <?php endif; ?>
    <!-- Pagination links -->
    <div class="pagination">
        <!-- First Page Button -->
        <?php if ($page > 1): ?>
            <a class="pagination-button" href="?page-nr=1">Ensimmäinen</a>
        <?php endif; ?>

        <!-- Previous Page Button -->
        <?php if ($page > 1): ?>
            <a class="pagination-button" href="?page-nr=<?= $page - 1 ?>">Edellinen</a>
        <?php endif; ?>

        <!-- Page Number Links -->
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a class="pagination-button <?= $i == $page ? 'active' : '' ?>" href="?page-nr=<?= $i ?>"><?= $i ?></a>
        <?php endfor; ?>

        <!-- Next Page Button -->
        <?php if ($page < $pages): ?>
            <a class="pagination-button" href="?page-nr=<?= $page + 1 ?>">Seuraava</a>
        <?php endif; ?>

        <!-- Last Page Button -->
        <?php if ($page < $pages): ?>
            <a class="pagination-button" href="?page-nr=<?= $pages ?>">Viimeinen</a>
        <?php endif; ?>
    </div>
</div>

<?php require "../Partials/footer.php"; ?>

<script>
    function showForm(){
        let form = document.getElementById('addClassForm');
        form.classList.toggle('visible');
    }
    function hideForm(){
        let form = document.getElementById('addClassForm');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            form.classList.add('hidden');
            form.classList.remove('visible');
            }
        )
    }   
    // to clean the URL after searching
    window.onload = function() {
        if (window.location.search.indexOf('search=') !== -1) {
            // Use the history API to remove the query string without reloading
            const url = new URL(window.location);
            url.searchParams.delete('search');
            window.history.replaceState({}, document.title, url.pathname);
        }
    };
</script>
