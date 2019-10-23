
<div id="categorieSuppressionBody" >
        <h2>Supprimer une catégorie</h2>
    <?php if (isset($erreur)): ?>
        <p class="bg-danger banner"><?= $erreur ?> <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
    <?php endif; ?>
    <?php if (isset($succes)): ?>
        <p class="bg-success banner">La catégorie a été supprimée <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
    <?php endif; ?>

        <form action="<?= $_SERVER['PHP_SELF']?>" method="post" >
            <label for="cat">Nom de la catégorie </label>
            <select id="cat" name="cat" required>
                 <?php foreach ($cats as $cat){
                    echo "<option value=\"" . $cat['nom'] . "\">" . $cat['nom'] . "</option>";
                }
                ?>
            </select></br>
            <input type="submit" value="Envoyer" name="supprimerCat" />
        </form>
</div>
