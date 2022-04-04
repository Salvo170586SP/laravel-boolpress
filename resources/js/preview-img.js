const placeholder = "http://www.proedsolutions.com/wp-content/themes/micron/images/placeholders/placeholder_large_dark.jpg";
const inputImage = document.getElementById('image');
const preview = document.getElementById('preview');

inputImage.addEventListener('change', function() {
    console.log(inputImage);
    const url = this.value;
    if (url) {
        preview.setAttribute('src', url);
    } else {
        preview.setAttribute('src', placeholder)
    };
})