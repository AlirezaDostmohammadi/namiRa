<?php require_once("Backend/config.php"); ?>


<?php
//Getting value of "search" variable from "script.js".
if (isset($_POST['mirna_search'])) {
//Search box value assigning to $Name variable.
   $Name = $_POST['mirna_search'];
   // Use str_replace to replace 'hsa' with ''
   $Name = str_replace('hsa-', '', $Name);
   $Name = str_replace('hsa', '', $Name);
   
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
       <!-- Below php code is just for closing parenthesis. Don't be confused. -->
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
   $similar_words=array();
//Query execution
   $cancer_ExecQuery = mysqli_query($conn , $cancer_search_query);
//Creating unordered list to display result.
   echo '
<ul class="list-group">
   ';
   //Fetching result from database.
   while ($Result = mysqli_fetch_assoc($cancer_ExecQuery)) {
       
       // Convert similar_words to an array and trim each value
        $cancer_similar_words_list = array_map('trim', explode(',', $Result['similar_words']));
        
        // Combine cancer_type and similar_words list
        $combined_list = array_merge([trim($Result['cancer_type'])], $cancer_similar_words_list);
        
        // Make the list unique
        $unique_similar_words_list = array_unique($combined_list);
        
        // Optional: Re-index the array (if needed)
        $unique_similar_words_list = array_values($unique_similar_words_list);
       
       foreach($unique_similar_words_list as $cancer_value) {
			$cancer_value_without_space = trim($cancer_value);
			
			if(substr_count(strtolower($cancer_value_without_space), strtolower($cancer_Name)) > 0 && !in_array($cancer_value_without_space, $similar_words) && $cancer_value_without_space != $cancer_Name){
			    
			    array_push($similar_words,$cancer_value_without_space);
			    
			    
			    echo '
            <!-- Creating unordered list items.
                Calling javascript function named as "fill" found in "script.js" file.
                By passing fetched result as parameter. -->
            
            <li class="list-group-item" onclick="fill_cancer(\'' . htmlspecialchars($cancer_value_without_space, ENT_QUOTES) . '\')">'
                . '<a>' . htmlspecialchars($cancer_value_without_space) . '</a>'
                . '</li>
                ';
			}
       }
       
    ?>
       <!-- Below php code is just for closing parenthesis. Don't be confused. -->
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