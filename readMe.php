<?php
/*
        1.  returns true or false based on whether the constant is defined or not.
            defined("DS");
            
        2.  defined("DS") ? $var=4 : $var=5;  
            if the condition is true $var=4, else $var=5. 
            
        3.  __DIR__  : magic constant defining current directory. 
            __FILE__ " magic constant defining the working file name.
        
        4. ob_start();
            This turns output buffering on. While output buffering is active no output is sent from the script (other than headers.), instead 
            output is stored in an internal buffer. 
        
        5. header()
           header is used to send a row HTTP header. 
           header must be called befor an actual output is sent. 
           header("Location: http://www.example.com/"); ------------> This is a special case.
            1. It sends a row HTTP header.
            2. It also redirects the brower to new page.
        
        6.  require_once(dirname(__FILE__)."/../backend/controllers/categoryController.php"); 
            Ref: http://stackoverflow.com/questions/7378814/are-php-include-paths-relative-to-the-file-or-the-calling-code
            require always work relative to main script. We can change that and make it relative to current file using dirname(__FILE__); 
            
        7. HTML entities to display £ sign
           http://www.w3schools.com/html/html_entities.asp
        
        create table category(catId int primary key auto_increment, catTitle varchar(255));
        create table product (prod_id int primary key AUTO_INCREMENT, title varchar(255), categoryId int references category(catId), price float , prod_description text, prod_image varchar(255));
        insert into product(title,categoryId,price,prod_description,prod_image) values('Ansible',1,24.99,'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.','https://placehold.it/320x150');
        alter table product change prod_description full_description text
        alter table product add column short_description text;
        update product set short_description='Short description' where prod_id=2
        create table user (user_id int primary key auto_increment,username varchar(255),email varchar(255))
        insert into user(user_id,username,email) values(1,'rico','m@yahoo.co.uk');


        // Check the charset used in a table.
        SHOW FULL COLUMNS FROM table_name;
        
        // Check the charset used in a schema MYSQL
        SELECT default_character_set_name
        FROM information_schema.SCHEMATA
        WHERE schema_name =  "ecom_db"
        LIMIT 0 , 30
        
        
        // Change the charset used in the database and tables
        ALTER DATABASE ecom_db CHARACTER SET utf8 COLLATE utf8_unicode_ci;
        ALTER TABLE category CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
        ALTER TABLE product CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
        ALTER TABLE user CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

*/
?>