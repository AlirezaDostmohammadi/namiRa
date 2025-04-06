library(Cairo)
library(dendextend)
library(ggplot2)

pdf.options(encoding='ISOLatin2.enc')

build_term_distance_matrix  <- function(main_targets, inhibits, promotes){
  
  #' Construct a custom distance matrix for hierarchical clustering of biological terms
  #'
  #' This function generates a custom distance object based on categorized biological elements 
  #' (main targets, inhibitors, and promoters), assigning low intra-group distances and 
  #' higher inter-group distances to facilitate structured clustering.
  #'
  #' @param main_targets A character vector of main target names.
  #' @param inhibits A character vector of inhibited process names.
  #' @param promotes A character vector of promoted process names.
  #'
  #' @return A distance object suitable for hierarchical clustering.
  
  # Append unique identifiers to make elements unique
  if (length(main_targets) > 0){
    main_targets_unique <- paste(main_targets, "(MainTarget)")
  }else{
    main_targets_unique <- main_targets
  }
  
  if (length(inhibits) > 0){
    inhibits_unique <- paste(inhibits, "(Inhibit)")
  }else{
    inhibits_unique <- inhibits
  }
  
  if(length(promotes) > 0){
    promotes_unique <- paste(promotes, "(Promote)")
  }else{
    promotes_unique <- promotes
  }
    
  
  leaf_labels <- c(main_targets_unique, inhibits_unique, promotes_unique)
  num_leaves <- length(leaf_labels)
  
  # Create a custom distance matrix with higher-level nodes
  distance_matrix <- matrix(20, nrow = num_leaves, ncol = num_leaves)
  rownames(distance_matrix) <- leaf_labels
  colnames(distance_matrix) <- leaf_labels
  
  
  if (length(main_targets_unique) > 0){
    # Set equal distances within each group to ensure they cluster 
    # at the same level
    distance_matrix[main_targets_unique, main_targets_unique] <- 1
  }
  
  if (length(inhibits_unique) > 0){
    # Set equal distances within each group to ensure they cluster 
    # at the same level
    distance_matrix[inhibits_unique, inhibits_unique] <- 1
  }
  
  if (length(promotes_unique) > 0){
    # Set equal distances within each group to ensure they cluster 
    # at the same level
    distance_matrix[promotes_unique, promotes_unique] <- 1
  }
  
  if (length(promotes_unique) > 0 && length(inhibits_unique) > 0){
    # Set large distances between groups
    distance_matrix[promotes_unique, inhibits_unique] <- 1
    distance_matrix[inhibits_unique, promotes_unique] <- 1
  }
  
  if (length(main_targets_unique) >0 && length(inhibits_unique) > 0){
    
    distance_matrix[main_targets_unique, inhibits_unique] <- 15
    distance_matrix[inhibits_unique, main_targets_unique] <- 15
  }
  
  if (length(main_targets_unique) >0 && length(promotes_unique) > 0){
    
    distance_matrix[main_targets_unique, promotes_unique] <- 15
    distance_matrix[promotes_unique, main_targets_unique] <- 15
  }
  # Convert the distance matrix to a distance object
  dist_object <- as.dist(distance_matrix)
  
  return(dist_object)
  
}

draw_term_cluster <- function(dist_object, mirna, cancer, main_targets,
                              inhibits, promotes, output_path) {
  
  #' Generate and save a dendrogram visualization of target-process relationships
  #'
  #' This function creates a hierarchical clustering plot of biological elements, 
  #' color-coded by category (main targets, inhibitors, and promoters), and saves it 
  #' as a PDF. It uses customizable shapes and colors to distinguish functional roles.
  #'
  #' @param dist_object A distance object, typically returned by `build_term_distance_matrix`.
  #' @param mirna A character string representing the miRNA being analyzed.
  #' @param cancer A character string for the associated cancer type.
  #' @param main_targets A character vector of main target names.
  #' @param inhibits A character vector of inhibited process names.
  #' @param promotes A character vector of promoted process names.
  #' @param output_path A character string specifying the directory to save the output PDF.
  #'
  #' @return A dendrogram is saved to the specified file path.
  #'
  
  # Adjust according to your system locale settings
  Sys.setlocale("LC_ALL", "en_US.UTF-8")  
  
  terms <- c("Main Targets", "Processes")
  
  # Append unique identifiers to make elements unique
  if (length(main_targets) > 0){
    main_targets_unique <- paste(main_targets, "(MainTarget)")
  }else{
    main_targets_unique <- main_targets
  }
  
  if (length(inhibits) > 0){
    inhibits_unique <- paste(inhibits, "(Inhibit)")
  }else{
    inhibits_unique <- inhibits
  }
  
  if(length(promotes) > 0){
    promotes_unique <- paste(promotes, "(Promote)")
  }else{
    promotes_unique <- promotes
  }
  
  # Combine leaf labels in the desired order: main targets, inhibits, promotes
  leaf_labels <- c(main_targets_unique, inhibits_unique, promotes_unique)
  # leaf_labels <- c(main_targets, inhibits, promotes)
  num_leaves <- length(leaf_labels)
  
  # Perform hierarchical clustering using the "average" method 
  # for better grouping
  hc <- hclust(dist_object, method = "ward.D2")
  
  # Ensure labels are correctly encoded in UTF-8
  hc$labels <- iconv(hc$labels, to = "UTF-8")
  
  # Convert to dendrogram
  dend <- as.dendrogram(hc)
  
  # Reorder the dendrogram leaves to match the desired order
  ordered_labels <- c(main_targets_unique, inhibits_unique, promotes_unique)
  
  # Ensure that all labels are UTF-8 encoded
  Encoding(ordered_labels) <- "UTF-8"
  
  # Use the rotate function to set the desired order of labels
  dend <- dend %>% rotate(order = ordered_labels)
  
  # Replace the modified labels with the original values
  labels(dend) <- sub(" \\(.*\\)$", "", labels(dend))
  
  dend <- dend %>%
    color_branches(k = 2, groupLabels = terms, col = c('black', 'black')) %>% 
    set("labels_cex", 1) %>%  
    set("labels_col", "black") %>%
    set("branches_lwd", 2) 
  
  shape.vect <- c()
  color.vect <- c()
  
  if (length(main_targets) > 0){
    for (i in 1:length(main_targets)){
      # main target -> mosalas
      shape.vect <- c(shape.vect, 17)
      color.vect <- c(color.vect, 'blue')
    }
  }
  
  
  if (length(inhibits) > 0){
    for (i in 1:length(inhibits)){
      # main target -> mosalas
      shape.vect <- c(shape.vect, 19)
      color.vect <- c(color.vect, 'red')
    }
  }
  
  if (length(promotes) > 0){
    for (i in 1:length(promotes)){
      # main target -> mosalas
      shape.vect <- c(shape.vect, 18)
      color.vect <- c(color.vect, 'green')
    }
  }
  
  branch_colors <- c()
  legend_title <- c()
  n_branch <- 0
  
  if (length(main_targets) > 0){
    branch_colors <- c(branch_colors, 'blue')
    legend_title <- c(legend_title, 'Main Targets')
    n_branch = n_branch + 1
  }
  
  if (length(inhibits) > 0){
    branch_colors <- c(branch_colors, 'red')
    legend_title <- c(legend_title, 'Inhibition')
    n_branch = n_branch + 1
  }
  
  if (length(promotes) > 0){
    branch_colors <- c(branch_colors, 'green')
    legend_title <- c(legend_title, 'Activation')
    n_branch = n_branch + 1
  }
  
  # left to right
  dend <- dend %>% set("branches_k_color", value = 'black', k = n_branch) %>%  
    set("leaves_pch", shape.vect) %>% 
    set("leaves_cex", 2) %>%  
    set("leaves_col", color.vect)
  
  # Save to PDF with CairoPDF
  cancer_cleaned <- gsub(":", "", cancer)
  CairoPDF(paste0(output_path, '/', cancer_cleaned, '.', mir, ".pdf"), 
           width = 8, height = 6, family = "Arial Unicode MS", 
           encoding = "UTF-8", pointsize = 12)
  
  
  par(mar = c(14, 1, 4, 2))
  plot(dend, main = paste0(cancer, '\n\n', mir), horiz = FALSE, axes = FALSE)
  
  coord <- par("usr")
  y_mid <- par("mai")[3] / 2
  height <- 0.93
  conv <- diff(grconvertY(y = 0:1, from = "inches", to = "user"))
  
  rect(xleft = coord[1],
       xright = coord[2],
       ybottom = coord[4] + (y_mid * (2.1 - height) * conv),
       ytop = coord[4] + (y_mid * (1 + height) * conv),
       xpd = TRUE)
  
  # Add a legend outside of the cluster on the right
  legend("topright", legend = legend_title, 
         col = branch_colors, lty = 1, lwd = 2, cex = 0.8, xpd = TRUE)
  
  # Add the URL at the bottom of the page
  url_text <- "https://namira-db.com"
  title(sub = url_text, line = 12.8, cex.sub = 1.2, col.sub = "#adadad", 
        adj = 0.01, xpd = TRUE)
  
  dev.off()
  
}