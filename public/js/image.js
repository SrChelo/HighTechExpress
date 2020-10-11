$(document).on('change','input[type="file"]',function(){
	// this.files[0].size recupera el tamaño del archivo
	// alert(this.files[0].size);
	
	var fileName = this.files[0].name;
    var fileSize = this.files[0].size;
    // recuperamos la extensión del archivo
    var ext = fileName.split('.').pop();
    
    // Convertimos en minúscula porque 
    // la extensión del archivo puede estar en mayúscula
    ext = ext.toLowerCase();

    // console.log(ext);
    switch (ext) {
        case 'jpg':
        case 'jpeg':
        case 'png': break;
        default:
            alert('El archivo no tiene la extensión adecuada');
            this.value = ''; // reset del valor
            this.files[0].name = '';
            return false;
    }
    var canvas = document.createElement('canvas');
    var ctx = canvas.getContext("2d");
    var size = 0;
    var tipe = true;
    var distance = 0;
    var source = this.files[0];
    var img = new Image();
    img.src = window.URL.createObjectURL(source);
    img.onload = function(){
        if(img.width >= img.height){
            size = img.width;
            distance = (size/2)-(img.height/2);
        } else {
            size = img.height;
            distance = (size/2)-(img.width/2);
            tipe = false;
        }
        canvas.width = size;
        canvas.height = size;
        ctx.beginPath();
        ctx.rect(0,0,size,size);
        ctx.fillStyle = "white";
        ctx.fill();
        if(tipe){
            ctx.drawImage(img,0,distance);
        } else {
            ctx.drawImage(img,distance,0);
        }
        document.getElementById('image').src = canvas.toDataURL('image/png');
        document.getElementById('imag').value = canvas.toDataURL('image/png');
    }
});
window.onload = init;