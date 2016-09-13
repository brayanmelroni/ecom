<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
     <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $(window).on('beforeunload', function() {
                $(window).scrollTop(0);
            });
            
            $('#inputCheckout').one('click', function() {
                $.post( '/resources/backend/webservices/isLoggedIn.php').success(function(resp){
                    isLoggedIn = $.parseJSON(resp);
                    
                    if(isLoggedIn==true){
                        $('#inputCheckout').click();
                        return true;
                    }
                    else{
                        window.location.href='/public/login.php';
                        return false; 
                    }
                });
            });
        
            
            
            $.post( '/resources/backend/webservices/isLoggedIn.php').success(function(resp){
                    isLoggedIn = $.parseJSON(resp);
                    if(isLoggedIn==true){
                        $("#login").html("Logout");
                        return true;
                    }
                    if(isLoggedIn==false){
                        $("#login").html("Sign In");
                        return true;
                    }
            });
            
            $('#login').on('click', function() {
                if($('#login').html()=="Logout"){ 
                    $.post( '/resources/backend/webservices/logout.php').success(function(resp){
                        window.location.href='/public/index.php';
                        return false;
                    });
                }
            });
            
        });
       
        
    </script>
</head>
