<!-- banderole -->
<div class="all-title-box">
  <div class="container">
    <div class="row">                
    <h2 class='titrepage'><?php echo $TitreDeLaPage ?></h2><hr/>               
    </div>
  </div>
</div>
<!-- fin de banderole -->
    <div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="col-md-12 container">
                        <?php echo form_open('Visiteur/Enregistrer') ?>                       
                            <br>
                            <?PHP if($TitreDeLaPage=='Corriger votre formulaire') echo service('validation')->listErrors();
                             if(!isset($txtNom)) $txtNom=''; if(!isset($txtPrenom)) $txtPrenom=''; if(!isset($txtAdresse)) $txtAdresse=''; if(!isset($txtVille)) $txtVille=''; if(!isset($txtCP)) $txtCP=''; if(!isset($txtEmail)) $txtEmail=''; ?>
                                <label for="txtNom" class="text-primary">Nom</label><br>
                                <input class="form-control" type="input" name="txtNom" value="<?php echo set_value('txtNom', $txtNom); ?>" />

                                <label for="txtPrenom" class="text-primary">Prénom</label><br>
                                <input class="form-control" type="input" name="txtPrenom" value="<?php echo set_value('txtPrenom', $txtPrenom); ?>" />

                                <label for="txtAdresse" class="text-primary">Adresse</label><br>
                                <input class="form-control" type="input" name="txtAdresse" value="<?php echo set_value('txtAdresse', $txtAdresse); ?>" />

                                <label for="txtVille" class="text-primary">Ville</label><br>
                                <input class="form-control" type="input" name="txtVille" value="<?php echo set_value('txtVille', $txtVille); ?>" />

                                <label for="txtCP" class="text-primary">Code Postal</label><br>
                                <input class="form-control" type="input" name="txtCP" value="<?php echo set_value('txtCP', $txtCP); ?>" />

                                <label for="txtEmail" class="text-primary">Email</label><br>
                                <input class="form-control" type="input" name="txtEmail" value="<?php echo set_value('txtEmail', $txtEmail); ?>" />

                                <label for="txtMdp" class="text-primary">Mot de passe</label><br>
                                <input class="form-control" type="password" name="txtMdp" id="mdp" value="<?php echo set_value('txtMdp'); ?>" />
                                <?php $session = session();
                                if ($session->get('statut') == 1) { ?>

                                
                                <div class="d-flex justify-content-center">
                                    <a class="btn hvr-hover" href="<?php echo site_url('Client/droitOublie/'.$txtEmail) ?>">Droit a l'oubli</a>
                                    <input type="submit" name="submit" class="btn hvr-hover" value="Modifier les coordonnées">
                                </div>
                                 
                                <?php }else{ ?>
                                 
                                
                            <input type="submit" name="submit" class="btn hvr-hover" value="Valider">
                            <div class="text-primary right">
                            <a class="btn hvr-hover" href="<?php echo site_url('Visiteur/Connecter') ?>">Se connecter</a>
                            <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script language=javascript>
     function Affichermasquermdp() {
  var x = document.getElementById("mdp");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
} 
      </script> 