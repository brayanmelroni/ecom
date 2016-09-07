<?php
    
    class mailController{
        
        public function sendMessage($from,$email,$subject,$message){
            $headers="From: {$from} {$email}";
            $to="bm@oxygen-online.co.uk";
            return mail($to,$subject,$message,$headers);
        }
    }
?>