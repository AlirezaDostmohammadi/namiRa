import os
from pdf2image import convert_from_path


if __name__ == '__main__':
    # Define input and output directories
    input_dir = 'output/pdf/'
    output_dir = 'output/jpg/'

    # Ensure the output directory exists
    os.makedirs(output_dir, exist_ok=True)

    # Set DPI for conversion
    dpi = 600

    # Process each PDF file in the input directory
    for filename in os.listdir(input_dir):
        if filename.endswith('.pdf'):
            pdf_path = os.path.join(input_dir, filename)
            # Convert PDF to images
            images = convert_from_path(pdf_path, dpi=dpi)

            # Save each page as a JPG in the output directory
            for i, image in enumerate(images):
                output_path = os.path.join(output_dir, os.path.basename(filename).split('.pdf')[0] + ".jpg")
                image.save(output_path, 'JPEG')

    print("PDF files have been successfully converted to JPG images with 600 DPI.")
