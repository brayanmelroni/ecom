 $(document).ready(function(){
            
            // Check whether a customer is loggged in before proceeding to payment.
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
            
            
            $(window).on('beforeunload', function() {
                $(window).scrollTop(0);
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
       