library(httr)
library(jsonlite)
library(utils) 

fetch_namira_data <- function(cancer_name, mirna_name) {
  #' Fetches and displays data from the namiRa database API for a given cancer and miRNA.
  #'
  #' @param cancer_name String. Name of the cancer to query.
  #' @param mirna_name String. Name of the miRNA to query.
  #'
  #' Note: Do not change the API key. It is set to 'guest' by default as per API access policy.
  
  api_key <- "guest"
  url <- paste0("https://namira-db.com/api.php?api_key=", api_key,
                "&cancer=", URLencode(cancer_name),
                "&mirna=", URLencode(mirna_name))
  
  response <- GET(url)
  response_text <- content(response, "text")
  
  tryCatch({
    data <- fromJSON(response_text)
    
    for (field_name in names(data)) {
        value <- data[[field_name]]
        if (field_name == "References") {
          reference_ids <- strsplit(value, ",")[[1]]
          reference_ids <- trimws(reference_ids)
          reference_links <- paste0("https://pubmed.ncbi.nlm.nih.gov/", reference_ids, "/")
          cat(field_name, ": ", paste(reference_links, collapse = ", "), "\n")
        } else {
          cat(field_name, ": ", value, "\n")
        }
    }
    
  }, error = function(e) {
    cat("Error:", conditionMessage(e), "\n")
    cat("Status code:", status_code(response), "\n")
    cat("Response text:\n", response_text, "\n")
  })
}


cancer_name <- "Cervical cancer"
mirna_name <- "miR-154-5p"
fetch_namira_data(cancer_name, mirna_name)
