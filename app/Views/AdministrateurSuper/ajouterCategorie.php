<!-- banderole -->
<div class="all-title-box">
  <div class="container">
    <div class="row">                
    <h2><?php echo $TitreDeLaPage ?></h2>        
    </div>
  </div>
</div>
<!-- fin de banderole -->
<div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="col-md-12 container">
                    <br>
                 
                    <br>
                    <?= form_open('AdministrateurSuper/ajouterCategorie') ?>
                        <label class="text-primary" for="txtcategorie">Nom de la catégorie:</label>
                        <input class="form-control" type="input" name="txtcategorie" value="<?php //echo set_value('txtcategorie', $txtcategorie); ?>" /><br />
                        <input class="btn hvr-hover" type="submit" value="Ajouter la catégorie">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>