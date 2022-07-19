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
                    <?= form_open('AdministrateurSuper/ajouterMarque') ?>
                        <label class="text-primary" for="txtcategorie">Nom de la marque</label>
                        <input class="form-control" type="input" name="txtmarque" value="<?php //echo set_value('txtcategorie', $txtcategorie); ?>" /><br />
                        <input class="btn hvr-hover" type="submit" value="Ajouter la marque"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>