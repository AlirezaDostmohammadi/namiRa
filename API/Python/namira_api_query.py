import requests
import json


def fetch_namira_data(cancer, mirna):

    """
    Fetches and displays data from the namiRa database API for a given cancer and miRNA.

    Parameters:
        cancer (str): Name of the cancer to query.
        mirna (str): Name of the miRNA to query.
    """

    # Do not change the API key. It is set to 'guest' by default as per API access policy.
    api_key = 'guest'

    url = f'https://namira-db.com/api.php?api_key={api_key}&cancer={cancer}&mirna={mirna}'

    response = requests.get(url)

    try:
        json_data = json.loads(response.text)

        for record in json_data:
            for field_name in record.keys():
                if field_name == 'References':
                    raw_references = record[field_name]
                    reference_ids = [ref.strip() for ref in raw_references.split(',')]
                    reference_links = []
                    for ref in reference_ids:
                        value = f'https://pubmed.ncbi.nlm.nih.gov/{ref}/'
                        reference_links.append(value)
                    print(field_name + ': ' + ', '.join(reference_links))
                else:
                    print(field_name + ': ' + record[field_name])

    except Exception as e:
        print(f'Unexpected error: {e}')
        print(f'Response object: {response}')


if __name__ == '__main__':

    cancer_name = 'Cervical cancer'
    mirna_name = 'miR-154-5p'
    fetch_namira_data(cancer_name, mirna_name)
