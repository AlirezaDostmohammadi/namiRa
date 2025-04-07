<?php require_once("../Backend/config.php"); require_once("../header.php"); ?>
			
			<!-- ============================ Page Title Start================================== -->
			<div class="page-title" style="height: 70px;">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
							<h2 class="ipt-title" style="text-transform: none;">How to use API to directly connect to <span style="font-family: Monotype Corsiva; font-size: xx-large;">namiRa</span>?
							</h2>
							
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->
			
			<section>
			
				<div class="container">
				
					<!-- row Start -->
					<div class="row align-items-center">

						<div class="col-lg-12 col-md-12">
							<div class="story-wrap explore-content">
								
						<p style="font-family: 'Muli', sans-serif; font-style: normal;">
The namiRa database API offers an invaluable tool for biologists and researchers focusing on the study of microRNAs in human cancers. Through the API, researchers can programmatically access the extensive namiRa database, enabling them to efficiently query detailed information on miRNA-cancer relationships. </br>This allows for the seamless integration of namiRa's comprehensive resources into their own research tools and analyses.

</br></br></p>

<h4 style="font-family: 'Muli', sans-serif; text-transform: None">How to Use the namiRa API:</h4>
<p style="font-family: 'Muli', sans-serif; font-style: normal;">
Here, we provide a guide on how to access this wealth of information using <i>Python</i> and <i>R</i>, two of the most widely used programming languages in the field of biology.

</br></p></br>
						
<h5 style="font-family: 'Muli', sans-serif;  text-transform: None">Using the namiRa API with Python</h5>

<ol>
    <li> <b>Import Required Libraries</b>: You'll need requests for making HTTP requests and json for parsing the JSON response.</li>
    
    <pre><code class="python" style="padding-top: inherit;">
import requests
import json
</code></pre>

<li><b>Set Your Query Parameters</b>: Define the cancer type and miRNA of interest. These parameters (cancer_name & mirna_name) can be easily adjusted for different queries.</li>

<pre><code class="python" style="padding-top: inherit;">
api_key = 'guest'

# Set the specific cancer type for querying
cancer_name = 'Cervical cancer'

# Set the specific microRNA name for querying
mirna_name = 'miR-154-5p'
</code></pre>

<li><b>Construct the Request URL</b>: Combine the base URL with your query parameters.</li>
<pre><code class="python" style="padding-top: inherit;">
url = f'https://namira-db.com/api.php?api_key={api_key}&cancer={cancer_name}&mirna={mirna_name}'
</code></pre>

<li><b>Make the API Request and Process the Response</b>: Send a GET request to the API and parse the JSON response. The data can then be iterated over for processing.</li>

<pre><code class="python" style="padding-top: inherit;">
response = requests.get(url)
print(url)
try:
    data = json.loads(response.text)

    for val in data:
        for key in val.keys():
            print(key + ':' + val[key])
except:
    print(response)
</code></pre>    
    
</ol>

</br>

<h5 style="font-family: 'Muli', sans-serif;  text-transform: None">Using the namiRa API with R</h5>
<i>R</i> is another powerful language for statistical computing and graphics, heavily used in biology. To access the namiRa database with R, the approach is similar but tailored to the language's syntax:

<ol>
    <li><b>Load Necessary Libraries</b>: httr for web requests, jsonlite for JSON parsing, and urltools for URL encoding.</li>
    
    <pre><code class="r" style="padding-top: inherit;">
library(httr)
library(jsonlite)
library(urltools)
</code></pre>

<li><b>Define Query Parameters</b>: As with Python, specify the cancer type and miRNA of interest.</li>

<pre><code class="r" style="padding-top: inherit;">
api_key <- "guest"

# Set the specific cancer type for querying
cancer_name <- "Cervical cancer"

# Set the specific microRNA name for querying
mirna_name <- "miR-154-5p"
</code></pre>

<li><b>Build the Request URL</b>: Use paste0 to concatenate the URL parts and url_encode to handle special characters in the cancer name.</li>

<pre><code class="r" style="padding-top: inherit;">
url <- paste0("https://namira-db.com/api.php?api_key=", api_key, "&cancer=", url_encode(cancer_name), 
              "&mirna=", mirna_name)
</code></pre>

<li><b>Execute the Request and Handle the Response</b>: Make the GET request and parse the JSON response. Error handling is achieved through tryCatch.</li>
    
    <pre><code class="r" style="padding-top: inherit;">
response <- GET(url)
content <- content(response, "text")

tryCatch({
  data <- fromJSON(content)
  # process the data as needed
}, error = function(e) {
  print(paste("Error:", response[["status_code"]]))
})
</code></pre>
</ol>
							</div>
						</div>
						
					</div>
					<!-- /row -->					
					
				</div>
						
			</section>
			

			
<?php require_once("../footer.php");?>
