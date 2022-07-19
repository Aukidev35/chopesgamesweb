<!-- banderole -->
<div class="all-title-box">
  <div class="container">
    <div class="row">                
    <h2 class='titrepage'><?php echo $TitreDeLaPage ?></h2><hr/>               
    </div>
  </div>
</div>
<!-- fin de banderole -->
<div  class='container'>
<?php
$attributes = [
    'class' => 'text-primary',
];
  echo service('validation')->listErrors();
  echo form_open('visiteur/connexionAdministrateur');
  echo form_label('Identifiant','txtIdentifiant', $attributes);
  echo form_input('txtIdentifiant', set_value('txtIdentifiant'), "class='col-md-3 form-control'");    
  echo form_label('Mot de passe','txtMotDePasse', $attributes);
  echo form_password('txtMotDePasse', set_value('txtMotDePasse'), "class='form-control col-md-3'");    
  echo form_submit('submit', 'Se connecter', "class='btn hvr-hover'");
  ?> <br/><br/> <?php
  echo form_close();
?></div>