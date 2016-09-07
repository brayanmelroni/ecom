<div class="col-md-3">
    <p class="lead">Shop Name</p>
    <div class="list-group">
    <?php
        require_once(dirname(__FILE__)."/../backend/controllers/categoryController.php"); 
        
        $jsonForcategories=(new categoryController())->allCategories();
        foreach ($jsonForcategories as $category) {
            $stdcategory=json_decode($category);
            echo "<a href='category.php?catId={$stdcategory->catId}' class='list-group-item'>".$stdcategory->catTitle."</a>";
        }
    ?>
    </div>
</div>
