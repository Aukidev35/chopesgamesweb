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
                    <?= form_open('AdministrateurSuper/saisiNewsletter') ?>
                    
                        <label class="text-primary" for="txtObjet">Objet : </label>
                        <input class="form-control" type="input" name="txtObjet" value="<?php ?>" /><br />
                        <label class="text-primary" for="txtTitre">Titre : </label>
                        <input class="form-control" type="input" name="txtTitre" value="<?php ?>" /><br />
                        <label class="text-primary" for="txtMessage">Message : </label>
                        <textarea class="form-control" id="formControlTextarea" rows="3" name="txtMessage"><?php ?></textarea><br>
                        <input class="btn hvr-hover" type="submit" value="Envoyer message"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>