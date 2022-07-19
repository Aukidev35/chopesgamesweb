        </main>
            <!-- Start Footer  -->
            <footer>
                <div class="footer-main">
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="footer-link-contact">
                                <h4>Nous contacter</h4>
                                <ul class="list-time">
                                    <li><p><i class="fas fa-map-marker-alt"></i> 8 Rue Rabelais<br>22000<br>Saint-Brieuc</p></li>
                                    <li><p><i class="fas fa-phone-square"></i>Téléphone: <a href="#">02 96 00 00 00</a></p></li>
                                    <li><p><i class="fas fa-envelope"></i>Email: <a href="#">master@chopesgames.com</a></p></li>
                                </ul>
                            </div>
    </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="footer-top-box">
                                    <h3>Lettre d'information</h3>
                                    <p>Abonnez vous à notre lettre d'information pour ne rater aucune nouveauté</p>
                                    <form action="<?= site_url('AdministrateurSuper/saveAbonnes') ?>" class="newsletter-box">
                                        <div class="form-group">
                                            <input class="" type="email" name="Email" placeholder="entrer votre adresse mail*" />
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <button class="btn hvr-hover" type="submit">envoyer</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="footer-top-box">
                                    <h3>Nous suivre</h3>
                                    <p>Nos différents réseaux sociaux ou vous pouvez nous suivre.</p>
                                    <ul>
                                        <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>            
                    </div>
                </div>
            </footer>
        </nav>
        <!-- Ancien Script -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <!-- <script src="</?= js_url('bootstrap.min') ?>"></script> -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Nouveau -->
        <!-- ALL JS FILES -->
        <script src="<?= js_url('jquery-3.2.1.min.min') ?>"></script>
        <script src="<?= js_url('popper.min') ?>"></script>
        <script src="<?= js_url('bootstrap.min') ?>"></script>
        <!-- ALL PLUGINS -->
        <script src="<?= js_url('jquery.superslides.min') ?>"></script>
        <script src="<?= js_url('bootstrap-select') ?>"></script>
        <script src="<?= js_url('inewsticker') ?>"></script>
        <!-- <script src="</?= js_url('bootsnav') ?>"></script> -->
        <script src="<?= js_url('images-loded.min') ?>"></script>
        <script src="<?= js_url('isotope.min') ?>"></script>
        <script src="<?= js_url('owl.carousel.min') ?>"></script>
        <script src="<?= js_url('baguetteBox.min') ?>"></script>
        <script src="<?= js_url('form-validator.min') ?>"></script>
        <script src="<?= js_url('contact-form-script') ?>"></script>
        <script src="<?= js_url('custom') ?>"></script> 
    </body>
</html>