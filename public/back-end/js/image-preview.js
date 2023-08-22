/**
 * image preview
 *
 * */
function showPreview(event){
    if(event.target.files.length > 0){
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("file-ip-1-preview");
        preview.src = src;
        preview.style.display = "block";
       // preview.style.maxWidth= "70%";

    }
}

function showPreviewHeaderLogo(event){
    if(event.target.files.length > 0){
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("file-ip-2-preview");
        preview.src = src;
        preview.style.display = "block";
       // preview.style.maxWidth= "70%";
    }
}
function showPreviewFooterLogo(event){
    if(event.target.files.length > 0){
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("file-ip-3-preview");
        preview.src = src;
        preview.style.display = "block";
        //preview.style.maxWidth= "70%";
    }
}
