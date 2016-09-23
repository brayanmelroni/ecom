 $(document).ready(function(){
            
            // Checking whether a customer is loggged in before proceeding to payment.
            $('#inputCheckout').one('click', function() {
                $.post( '/resources/backend/services/isLoggedIn.php').success(function(resp){
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
            
            //  Setting the current vertical position of the scroll bar for window, when the window is about to be unloaded. 
            $(window).on('beforeunload', function() {
                $(window).scrollTop(0);
            });
            
            // checking whether there is a user logged in. 
            $.post( '/resources/backend/services/isLoggedIn.php').success(function(resp){
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
            
            // logging out a user.
            $('#login').on('click', function() {
                if($('#login').html()=="Logout"){
                    $.post( '/resources/backend/services/logout.php').success(function(resp){
                        window.location.href='/public/index.php';
                        return false;
                    });
                }
            });
            
            
            
});
       