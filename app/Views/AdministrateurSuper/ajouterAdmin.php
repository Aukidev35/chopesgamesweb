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
                    <?= form_open('AdministrateurSuper/ajouterAdmin') ?>
                        <label class="text-primary" for="txtIdentifiant">Identifiant</label>
                        <input class="form-control" type="input" name="txtIdentifiant" value="" /><br />

                        <label class="text-primary" for="txtMotDePasse">Mot de passe</label>
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control" type="password" name="txtMotDePasse" value="">
                            <div class="input-group-addon d-flex align-items-center">
                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a><br>
                            </div>
                        </div>
                        
                        <label class="text-primary" for="txtEmail">email</label>
                        <input class="form-control" type="input" name="txtEmail" value="" /><br />

                        <input class="btn hvr-hover" type="submit" value="Valider"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>