<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/datepicker.css"> 

</head>

<body>
    <div style="height:100px">
        <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color:#334d4d" role="navigation" id="myheader">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Home</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                
                <div style="float:left">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li> <a href="#"> All Restaurants </a> </li>
                            <li> <a href="#"> How To Book </a> </li>
                        </ul>
                    </div>
                </div>
                
                <div style="float:right">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li> <a href="#"> Log In </a> </li>
                            <li> <a href="#"> Sign Up </a> </li>
                        </ul>
                    </div>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
    </div>
    
    @yield('content')

    <div id="footer" style="background-color:white">
        <nav class="navbar navbar-bottom" role="navigation">
            <div class="container">
                <div style="float:right">
                    <div class="collapse navbar-collapse" >
                        <ul class="nav navbar-nav">
                            <li> <a href="#"> About Us </a> </li>
                            <li> <a href="#"> Terms of Use </a> </li>
                            <li> <a href="#"> Policy </a> </li>
                            <li> <a href="#"> FAQ </a> </li>
                            <li> <a href="#">Contact Us</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        // When the document is ready
         $(document).ready(function () {
                     
            $('#example1').datepicker({
                    format: "dd/mm/yyyy"
            });  
                                                                     
        });
    </script>

</body>

</html>

