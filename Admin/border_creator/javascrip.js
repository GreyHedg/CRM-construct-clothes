$(document).ready(function(){
    var canvas = new fabric.Canvas('drawingCanvas', {
        width: '700',
        height: '800'
    });
    var context = canvas.getContext("2d");   

var limitationBox = new fabric.Rect({
    width: 150,
    height: 280,
    fill: '#cc00ad',
    opacity: 0.5,
    borderColor: 'red',
    cornerColor: 'red',
    borderSize: 10,
    cornerSize: 15
})
limitationBox.lockRotation = true;
canvas.add(limitationBox);



document.getElementById('design-upload').onchange = function (e){
if(window.FileReader)
{
    var scale;
    var reader = new FileReader();
    reader.readAsDataURL(e.target.files[0]);
    reader.onload = function (e)
    {
        var image = new Image;
        image.src = e.target.result;
        image.onload = function() 
        {
            var imgInstance = new fabric.Image(image, {
                    left: 0,
                    top: 0
            });
            if(canvas.width/imgInstance.width < canvas.height/imgInstance.height){
                scale = canvas.width/imgInstance.width;
                imgInstance.scaleToWidth(canvas.width);
            }
            else{
                scale = canvas.height/imgInstance.height;
                imgInstance.scaleToHeight(canvas.height);
            }
            canvas.setBackgroundImage(imgInstance,canvas.renderAll.bind(canvas),{ originX: 'left', originY: 'top' });
        }
    }
    $('#saveimage').click(function() {
        var border_left = limitationBox.left / scale;
        var border_top = limitationBox.top / scale;
        var border_width = limitationBox.width * limitationBox.scaleX / scale;
        var border_height = limitationBox.height * limitationBox.scaleY / scale;
        border_left = Math.ceil(border_left);
        border_top = Math.ceil(border_top);
        border_width = Math.floor(border_width);
        border_height = Math.floor(border_height);
        $("input[type=number]").val(border_left);
        $("#border_top").val(border_top);
        $("#border_width").val(border_width);
        $("#border_height").val(border_height);
    });

} 
}
});
