<?php
    /**
    * This class handles all the mail related operations.
    */
    class mailController{

        /**
        * Sending emails 
        * @param $from
        * @param $email
        * @param $subject
        * @param $message
        * @return bool
        */
        public function sendMessage($from, $email, $subject, $message){
            $headers="From: {$from} {$email}";
            $to="bm@oxygen-online.co.uk";
            return mail($to,$subject,$message,$headers);
        }
    }
?>
