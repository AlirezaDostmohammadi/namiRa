<?php require_once("../Backend/config.php"); ?>


<?php
//Getting value of "search" variable from "script.js".
if (isset($_POST['mirna_search'])) {
//Search box value assigning to $Name variable.
   $Name = $_POST['mirna_search'];
   
   // Use str_replace to replace 'hsa' with ''
   $Name = str_replace('hsa-', '', $Name);
   $Name = str_replace('hsa', '', $Name);
   
//Search query.
//Query execution
   $ExecQuery = mysqli_query($conn , $mirna_search_query);
//Creating unordered list to display result.
   echo '
<ul class="list-group">
   ';
   //Fetching result from database.
   while ($Result = mysqli_fetch_assoc($ExecQuery)) {
           ?>
       <!-- Creating unordered list items.
            Calling javascript function named as "fill" found in "script.js" file.
            By passing fetched result as parameter. -->
       <li class="list-group-item" onclick='fill("<?php echo $Result['search_result']; ?>")'>
       <a>
       <!-- Assigning searched result in "Search box" in "search.php" file. -->
           <?php echo $Result['search_result']; ?>
       </li></a>
       <?php
    }
    if(mysqli_num_rows($ExecQuery) == 0){
        ?>
        <li class="list-group-item">
            no suggestion
       </li>
        
        <?php
    }
    
}
?>
</ul>


<?php
//Getting value of "search" variable from "script.js".
if (isset($_POST['cancer_search'])) {
//Search box value assigning to $cancer_Name variable.
   $cancer_Name = $_POST['cancer_search'];
//Search query.
//Query execution
   $cancer_ExecQuery = mysqli_query($conn , $cancer_search_query);
//Creating unordered list to display result.
   echo '
<ul class="list-group">
   ';
   //Fetching result from database.
   while ($Result = mysqli_fetch_assoc($cancer_ExecQuery)) {
           ?>
       <!-- Creating unordered list items.
            Calling javascript function named as "fill" found in "script.js" file.
            By passing fetched result as parameter. -->
       <li class="list-group-item" onclick='fill_cancer("<?php echo $Result['cancer_type']; ?>")'>
       <a>
       <!-- Assigning searched result in "Search box" in "search.php" file. -->
           <?php echo $Result['cancer_type']; ?>
       </li></a>
       <?php
    }
    if(mysqli_num_rows($cancer_ExecQuery) == 0){
        ?>
        <li class="list-group-item">
            no suggestion
       </li>
        
        <?php
    }
    
}
?>
</ul>