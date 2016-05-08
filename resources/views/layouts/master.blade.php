<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        @yield('title')
    </title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    

</head>

<body>
    @yield('content')

    <div id="footer" style="background-color:black">
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
</body>

</html>

