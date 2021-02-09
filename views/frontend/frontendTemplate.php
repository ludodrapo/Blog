<!DOCTYPE html>

<html>

    <head>
        
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="blog professionnel" />
        <meta name="author" content="Ludo Drapo" />
        <title>Ludo Drapo, le blog</title>
        <!-- Favicon I did-->
        <link rel="icon" type="image/x-icon" href="public/img/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="public/css/styles.css" />
        <link rel="stylesheet" href="public/css/mystyle.css" />
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/c5aa82aba4.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />

    </head>

    <body id="page-top" class="bg-light">

        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="index.php">Le blog de Ludo</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-info text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars fa-2x"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php"><i class="fas fa-home"></i></a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=displayAllPosts"><i class="far fa-newspaper"></i> Blog</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 js-scroll-trigger" id="navbardrop" data-toggle="dropdown" href="#"><i class="fas fa-file-alt"></i> C.V.</a></li>
<?php
if (!isset($_SESSION['login_name']))
{
?>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=goToLogin"><i class="fas fa-sign-in-alt"></i> Connexion</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact"><i class="fas fa-envelope-open"></i> Contact</a></li>
<?php
}
elseif (isset($_SESSION['login_name']) && $_SESSION['profile'] == 'subscriber')
{
?>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=profile"><i class="fas fa-user-circle"></i> <?=$_SESSION['login_name']?></a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact"><i class="fas fa-envelope-open"></i> Contact</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=logout"><i class="fas fa-sign-out-alt"></i></a></li>
                        
<?php
}
elseif (isset($_SESSION['login_name']) && $_SESSION['profile'] == 'administrator')
{
?>                      
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=profile"><i class="fas fa-user-circle"></i> <?=$_SESSION['login_name']?></a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=goToAdmin"><i class="fas fa-users-cog"></i> Admin</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=logout"><i class="fas fa-sign-out-alt"></i></a></li>
<?php
}
?>
                    </ul>
                </div>
            </div>
        </nav>

        <section>
            <?= $content ?>   	
        </section>


<?php

if (!isset($_SESSION['profile']) || $_SESSION['profile'] == 'subscriber')
{
?>
        <section class="page-section" id="contact">
            <div class="container">
                        <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-secondary mb-0">Pour me contacter ...</h2>
                        <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-envelope-open"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                        <!-- Contact Section Form-->
                <div class="row mb-5">
                    <div class="col-lg-8 mx-lg-auto mx-5 bg-white shadow rounded">
                                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                        <form method="post" action="index.php?action=contactMail" id="contactForm" name="contactMail" class="p-3">
<?php
if (!isset($_SESSION['login_name']))
{
?>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Name</label>
                                    <input class="form-control" name="name" type="text" placeholder="Nom" required />
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Email</label>
                                    <input class="form-control" name="email" type="email" placeholder="Email" required />
                                </div>
                            </div>

<?php
}
?>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Message</label>
                                    <textarea class="form-control" name="message" rows="5" placeholder="Message ... sympa si possible !" required></textarea>
                                </div>
                            </div>
                            <br />
                            <div class="form-group text-center">
                                <button class="btn btn-info btn-l" id="sendMailButton" type="submit"><i class="fas fa-paper-plane fa-3x"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
<?php
}
?>
        <footer class="mt-5">
            <div class="copyright bg-secondary py-3 text-center text-white">
                <div class="container">
                    <div class="row">
                        <div class="col-5 text-center">
                            <a class="btn btn-outline-light btn-social m-1" href="#"><i class="fab fa-fw fa-github"></i></a>
                            <a class="btn btn-outline-light btn-social mx-1" href="#"><i class="fab fa-fw fa-linkedin-in"></i></a>
                        </div>
                        <div class="col-7 text-center">
                            <p class="m-1">
                                Ludo Drapo, et le web est plus beau.<br />
                                <small>Copyright © Le blog de Ludo 2021</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
        <div class="scroll-to-top d-lg-none position-fixed">
            <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
        </div>

        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Core theme JS-->
        <script src="public/js/scripts.js"></script>

	</body>
		
</html>
