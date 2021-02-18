<!DOCTYPE html>

<html>

    <head>
        
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="blog professionnel" />
        <meta name="author" content="Ludo Drapo" />
        <title>Le blog de Ludo - Dashboard</title>
        <!-- My homemade favicon-->
        <link rel="icon" type="image/x-icon" href="public/img/favicon.ico" />
        <!-- Font Awesome icons -->
        <script src="https://kit.fontawesome.com/c5aa82aba4.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
                <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="public/css/styles.css" />
        <link rel="stylesheet" href="public/css/mystyle.css" />
                <!-- Script tinymce -->
        <script src="vendor/tinymce/tinymce/tinymce.min.js"></script>

    </head>

    <body id="page-top" class="bg-light">

        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="backendIndex.php">Blog admin</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-info text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars fa-2x"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                    	<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="backendIndex.php"><i class="fas fa-home"></i></a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="backendIndex.php?action=displayAwaitingComments"><i class="fas fa-comments"></i> Commentaires</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="backendIndex.php?action=displayAllPosts"><i class="far fa-newspaper"></i> Posts</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="backendIndex.php?action=displayAllSubscribers"><i class="fas fa-users"></i> Abonnés</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php">Site public</a></li>
                    </ul>
                </div>
            </div>
        </nav>


        <?=$content?>


        <footer class="copyright">
            <div class="bg-secondary pb-1 pt-3 text-center text-white">
                <div class="container">
                <p>
                    Ludo Drapo, et le web est plus beau.<br />
                    <small>Copyright © Le blog de Ludo 2021</small>
                </p>
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
        <!-- script local tinymce -->
        <script type="text/javascript" src="public/js/tinymce.js"></script>
        <script type="text/javascript" src="public/js/myscript.js"></script>


	</body>
		
</html>
