//Script a bit light only for posts content edition

tinymce.init({
    selector: '#editor',
    branding: false,
    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    toolbar_mode: 'floating',
    min_height: 400,           
    autoresize_bottom_margin: 16
});
