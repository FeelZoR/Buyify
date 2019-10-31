<?php if(isset($filtres)){  foreach ($filtres as $clef => $valeur){ ?>
  <span class="badge badge-pill badge-primary"><?php echo "$clef : $valeur"; ?> </span>
<?php }} ?>

<?php if (isset($erreur)): ?>
    <p class="bg-danger banner"><?= $erreur ?> <button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span></button></p>
<?php endif; ?>


    <!-- Extra large modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".modal-filtre"">Filtres</button>

    <div class="modal fade modal-filtre" tabindex="-1" role="dialog" aria-labelledby="modal-filtres" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="<?= $_SERVER['PHP_SELF']?>" method="post" >
                    <div class="form-group">
                        <label for="categorie">Catégorie</label>
                        <select  class="form-control" id="categorie" name="categorie">
                            <?php foreach ($cats as $cat){ ?>
                                <option value="<?= $cat['nom'] ?>" <?php if($cat['nom'] == $filtres['categorie']) { echo "selected";} ?> ><?= $cat['nom'] ?>
                                </option>
                            <?php } ?>
                        </select></br>
                    </div>
                    <div class="form-group">
                        <label for="prixMin">Prix Min </label>
                        <input type="number" id="prixMin"  value="<?php if(isset($filtres['prixMin'])){ echo $filtres['prixMin'];} ?>"  name="prixMin" minlength="1" maxlength="6" size="7">
                        <label for="prixMax">Max</label>
                        <input type="number" id="prixMax" value="<?= $filtres['prixMax'] ?>" name="prixMax" minlength="1" maxlength="6" size="7">
                    </div>
                    <input type="submit"  class="btn btn-primary btn-block" value="Ajouter Fitlre" name="AjouterFiltre" />
                    <input type="reset"  class="btn btn-primary btn-block" value="Reinisialiser" name="Reinisialiser" />
                </form>
            </div>
        </div>
    </div>

<?php var_dump($produits); ?>