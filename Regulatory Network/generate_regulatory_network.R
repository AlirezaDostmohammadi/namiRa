# Load necessary libraries
library(dplyr)
library(stringr)
source("miRNA_cluster_plotter.R")



# Read the CSV file
df <- read.csv('db.csv', stringsAsFactors = FALSE, fileEncoding = "UTF-8")
output_path <- 'output/'

# Iterate over each row of the dataframe
for (row_idx in seq_len(nrow(df))) {
  
  # Print the row index
  print(row_idx)
  
  # Extract values from the dataframe
  mir <- df[row_idx, 'miRNA']
  main_targets <- df[row_idx, 'Main.targets']
  in_vitro_Promotes <- df[row_idx, 'in.vitro.Promotes']
  in_vitro_Inhibits <- df[row_idx, 'in.vitro.Inhibits']
  in_vivo_Promotes <- df[row_idx, 'in.vivo.Promotes']
  in_vivo_Inhibits <- df[row_idx, 'in.vivo.Inhibits']
  cancer <- df[row_idx, 'Cancer.type']
  
  # Define the output file name
  file_name <- paste0(cancer, '.', main_targets, '.network.jpeg')
  output_path <- 'output'
  
  # Perform string replacements using regular expressions
  mir <- str_replace_all(mir, '\\s?\\(.*?\\)\\s?', ' ')
  cancer <- str_replace_all(cancer, '\\s?\\(.*?\\)\\s?', ' ')
  main_targets <- str_replace_all(main_targets, '\\s?\\(.*?\\)\\s?', ' ')
  in_vitro_Promotes <- 
    str_replace_all(in_vitro_Promotes, '\\s?\\(.*?\\)\\s?', ' ')
  in_vitro_Inhibits <- 
    str_replace_all(in_vitro_Inhibits, '\\s?\\(.*?\\)\\s?', ' ')
  in_vivo_Promotes <- 
    str_replace_all(in_vivo_Promotes, '\\s?\\(.*?\\)\\s?', ' ')
  in_vivo_Inhibits <- 
    str_replace_all(in_vivo_Inhibits, '\\s?\\(.*?\\)\\s?', ' ')
  
  # Split and trim the targets and effects, removing 'ND'
  main_targets <- unique(trimws(unlist(strsplit(main_targets, ','))))
  # unique(trimws(str_to_title(unlist(strsplit(in_vitro_Promotes, ',')))))
  in_vitro_Promotes <- unique(trimws(unlist(strsplit(in_vitro_Promotes, ','))))
  # unique(trimws(str_to_title(unlist(strsplit(in_vitro_Inhibits, ',')))))
  in_vitro_Inhibits <- unique(trimws(unlist(strsplit(in_vitro_Inhibits, ','))))
  # Nd
  in_vitro_Promotes <- in_vitro_Promotes[in_vitro_Promotes != 'ND']
  in_vitro_Inhibits <- in_vitro_Inhibits[in_vitro_Inhibits != 'ND']
  
  main_targets <- main_targets[main_targets != 'ND']
  
  if (length(main_targets) == 0){
    main_targets <- "Not Determined"
  }
  
  in_vivo_Promotes <- 
    unique(trimws(unlist(strsplit(in_vivo_Promotes, ','))))
  in_vivo_Inhibits <- unique(trimws(unlist(strsplit(in_vivo_Inhibits, ','))))
  # Nd
  in_vivo_Promotes <- in_vivo_Promotes[in_vivo_Promotes != 'ND']
  in_vivo_Inhibits <- in_vivo_Inhibits[in_vivo_Inhibits != 'ND']
  
  # Combine inhibits and promotes into lists
  inhibits <- unique(c(in_vivo_Inhibits, in_vitro_Inhibits))
  promotes <- unique(c(in_vitro_Promotes, in_vivo_Promotes))
  
    print(main_targets)
    print(inhibits)
    print(promotes)
    
    dist_object <- 
      build_term_distance_matrix (main_targets, inhibits, promotes)
    
    if (length(inhibits) >0 | length(promotes) > 0){
      
      draw_term_cluster(dist_object, mir, cancer, main_targets, inhibits, 
                        promotes, output_path)
      }
}



