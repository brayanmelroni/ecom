<strong><h1>E Commerce Store developed using Object Oriented PHP</h1></strong>

<p>This is an eCommerce Store developed purely using Object oriented PHP, MySQL, JQuery, Bootstrap, CSS and HTML5.
Although no frameworks are used, it is always designed considering MVC architectute.</p>

<ul>
    <li>
        All the classes related to tables in the mySQL database can be found in ecom/resources/backend/entities folder. 
        PDO was used for connecting with the backend database. 
        A class is considered analogue to a table, and an object of a class is considered analogue to a row in a specific table. 
        Code is well refactored such that all the generic SQL code is contained to a trait and used within all entity related classes. 
    </li>
    <li>
        All the business logic is constrained to controller classes found in ecom/resources/backend/controllers folder.
        Views are only accessing controller classes. Views do not directly access entity classes. 
    </li>
    <li>
        Common code among views is contained in ecom/resources/templates folder. 
        Main views are found in ecom/public directory.
    </li>
</ul>
