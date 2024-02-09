$(document).ready(function(){
  const pageWidth = document.documentElement.scrollWidth;
  const pageHeight = document.documentElement.scrollHeight;
    var canvas = new fabric.Canvas('drawingCanvas', {
        width: pageWidth/2.5,
        height: pageHeight/1.275,
    });
//    var context = canvas.getContext("2d");


var scale;
var selected_id;
var selected_size = 11;
var have_size = [];
var limitationBox = new fabric.Rect( {
  height: 0,
  width: 0,
  left: 0,
  top: 0,
  fill: '#ffffff',
  opacity: 0.5
});
canvas.add(limitationBox);


 // FOR SELECT T-SHIRTS
  $('#sl_ft img').click(function(){
    canvas.remove(canvas.item(0));
    for(var i = 0; i < have_size.length; i++){
      document.getElementById(String(have_size[i])).classList.toggle("have");
    }
    if (selected_size != 11){
      document.getElementById(String(selected_size)).classList.toggle("selected");
      selected_size = 11;
    }
    have_size = [];
    var href = $(this).attr('src');
    selected_id = $(this).attr('data');
    $('#product-name').val($(this).attr('name'));
    for(var i = 0; i < 11; i++){
      if (size[selected_id][i] != 0) {
        document.getElementById(String(i)).classList.toggle("have");
        have_size.push(i);
      }
    }
    var image = new Image;
    image.src = href;
    image.onload = function() 
    {
      var imgInstance = new fabric.Image(image, {
        left: 0,
        top: 0,
        scaleX: 1,
        scaleY: 1
      });
      if(canvas.width/imgInstance.width < canvas.height/imgInstance.height){
        scale = canvas.width/imgInstance.width;
        imgInstance.scaleToWidth(canvas.width);
      }
      else{
        scale = canvas.height/imgInstance.height;
        imgInstance.scaleToHeight(canvas.height);
      }
      limitationBox.selectable = true;
      limitationBox.height = borders[selected_id][3]*scale;
      limitationBox.width = borders[selected_id][2]*scale;
      limitationBox.left = borders[selected_id][0]*scale;
      limitationBox.top = borders[selected_id][1]*scale;
      limitationBox.selectable = false;
      canvas.setBackgroundImage(imgInstance, 
        canvas.renderAll.bind(canvas), 
        {   originX: 'left', originY: 'top' });
    }
  }); 
    
    
  $('#sd_ft img').click(function(){
    canvas.remove(canvas.item(0));
    $('#print-name').val($(this).attr('name'));
    var image = new Image;
    image.src = $(this).attr('src');
    image.onload = function() 
    {
      var imgInstance = new fabric.Image(image, {
        borderColor: 'red',
        cornerColor: 'red',
        borderSize: 10,
        cornerSize: 15,
        left: limitationBox.left,
        top: limitationBox.top,
      });
      if(limitationBox.width/imgInstance.width < limitationBox.height/imgInstance.height){
          imgInstance.scaleToWidth(limitationBox.width/2);
      }
      else{
          imgInstance.scaleToHeight(limitationBox.height/2);
      }
      canvas.add(imgInstance);
    }
  });

  canvas.on("object:moving", function (e) {
    var obj = e.target;

    var left = obj.left;
    var top = obj.top;
    var width = obj.width * obj.scaleX;
    var height = obj.height * obj.scaleY;

    var c_width = limitationBox.width;
    var c_height = limitationBox.height;

    var left_adjust, right_adjust;
    if (obj.originX == "center") {
      left_adjust = right_adjust = width / 2;
    } else {
      left_adjust = 0;
      right_adjust = width;
    }
    var top_adjust, bottom_adjust;
    if (obj.originY == "center") {
      top_adjust = bottom_adjust = height / 2;
    } else {
      top_adjust = 0;
      bottom_adjust = height;
    }

    if (obj.angle) {
      var angle = obj.angle;
      if (angle > 270) {
        angle -= 270;
      } else if (angle > 180) {
        angle -= 180;
      } else if (angle > 90) {
        angle -= 90;
      }
      const radians = angle * (Math.PI / 180);
      const w_opposite = width * Math.sin(radians);
      const w_adjacent = width * Math.cos(radians);
      const h_opposite = height * Math.sin(radians);
      const h_adjacent = height * Math.cos(radians);

      if (obj.originX != "center" && obj.originY != "center") {
        if (obj.angle <= 90) {
          left_adjust = h_opposite;
          top_adjust = 0;
          right_adjust = w_adjacent;
          bottom_adjust = h_adjacent + w_opposite;
        } else if (obj.angle > 90 && obj.angle <= 180) {
          left_adjust = h_adjacent + w_opposite;
          top_adjust = h_opposite;
          right_adjust = 0;
          bottom_adjust = w_adjacent;
        } else if (obj.angle > 180 && obj.angle <= 270) {
          left_adjust = w_adjacent;
          top_adjust = w_opposite + h_adjacent;
          right_adjust = h_opposite;
          bottom_adjust = 0;
        } else {
          left_adjust = 0;
          top_adjust = w_adjacent;
          right_adjust = w_opposite + h_adjacent;
          bottom_adjust = h_opposite;
        }
      }

      if (obj.originX == "center" && obj.originY == "center") {
        if (obj.angle <= 90 || (obj.angle > 180 && obj.angle <= 270)) {
          left_adjust = (w_adjacent + h_opposite) / 2;
          right_adjust = (w_adjacent + h_opposite) / 2;
          top_adjust = (h_adjacent + w_opposite) / 2;
          bottom_adjust = (h_adjacent + w_opposite) / 2;
        } else {
          left_adjust = (h_adjacent + w_opposite) / 2;
          right_adjust = (h_adjacent + w_opposite) / 2;
          top_adjust = (w_adjacent + h_opposite) / 2;
          bottom_adjust = (w_adjacent + h_opposite) / 2;
        }
      }
    }

    var top_bound = top_adjust + limitationBox.top;
    var bottom_bound = c_height - bottom_adjust + limitationBox.top;
    var left_bound = left_adjust  + limitationBox.left;
    var right_bound = c_width - right_adjust + limitationBox.left;

    if (width > c_width) {
      obj.set("left", left_bound);
    } else {
      obj.set("left", Math.min(Math.max(left, left_bound), right_bound));
    }

    if (height > c_height) {
      obj.set("top", top_bound);
    } else {
      obj.set("top", Math.min(Math.max(top, top_bound), bottom_bound));
    }

    $('#positionX').val(Math.ceil(canvas.item(0).left));
    $('#positionY').val(Math.ceil(canvas.item(0).top));
});

canvas.on("object:scaling", function (e) {
  var obj = e.target;

  var c_width = limitationBox.width;
  var c_height = limitationBox.height;

  var left = obj.left;
  var top = obj.top;
  var new_width = obj.width * obj.scaleX;
  var new_height = obj.height * obj.scaleY;

  var left_bound = limitationBox.left;
  var right_bound = limitationBox.left + c_width;
  var top_bound = limitationBox.top;
  var bottom_bound = limitationBox.top + c_height;

  if (left < left_bound) {
    new_width -= (left_bound - left);
    obj.set("left", left_bound);
  } else if (left + new_width > right_bound) {
    new_width -= (left + new_width - right_bound);
  }

  if (top < top_bound) {
    new_height -= (top_bound - top);
    obj.set("top", top_bound);
  } else if (top + new_height > bottom_bound) {
    new_height -= (top + new_height - bottom_bound);
  }

  obj.scaleX = new_width / obj.width;
  obj.scaleY = new_height / obj.height;
});

/*canvas.on("object:rotating", function (e) {
  var obj = e.target;
  var angle = obj.angle % 360;
  if (angle < 0) {
    angle += 360;
  }
  var radians = angle * Math.PI / 180;
  var cos = Math.abs(Math.cos(radians));
  var sin = Math.abs(Math.sin(radians));
  var boundingBoxWidth = obj.width * cos + obj.height * sin;
  var boundingBoxHeight = obj.width * sin + obj.height * cos;
  var boundingBoxLeft = obj.left - (boundingBoxWidth - obj.width) / 2;
  var boundingBoxTop = obj.top - (boundingBoxHeight - obj.height) / 2;
  if (boundingBoxLeft < limitationBox.left) {
    obj.set({ left: obj.left + (limitationBox.left - boundingBoxLeft) });
  }
  if (boundingBoxTop < limitationBox.top) {
    obj.set({ top: obj.top + (limitationBox.top - boundingBoxTop) });
  }
  if (boundingBoxLeft + boundingBoxWidth > limitationBox.left + limitationBox.width) {
    obj.set({ left: obj.left - (boundingBoxLeft + boundingBoxWidth - (limitationBox.left + limitationBox.width)) });
  }
  if (boundingBoxTop + boundingBoxHeight > limitationBox.top + limitationBox.height) {
    obj.set({ top: obj.top - (boundingBoxTop + boundingBoxHeight - (limitationBox.top + limitationBox.height)) });
  }
});*/

  $('#saveimage').click(function() {
  canvas.discardActiveObject().renderAll();
  var link = document.getElementById("drawingCanvas").toDataURL("png");
  var a = Math.round(canvas.item(0).width * canvas.item(0).scaleX);
  var b = Math.round(canvas.item(0).height * canvas.item(0).scaleY);
  $('#angle').val(Math.round(canvas.item(0).angle));
  $('#width').val(a);
  $('#height').val(b);
  $('#urlimage').val(link);
  $('#add').click();

});

$('#sbuttons button').click(function(){
  if (size[selected_id][$(this).attr('id')] != 0) {
    document.getElementById(String($(this).attr('id'))).classList.toggle("selected");
    $('#size').val($(this).attr('name'));
    if (selected_size != $(this).attr('id')){
      if (selected_size != 11) {
        document.getElementById(String(selected_size)).classList.toggle("selected");
      }
      selected_size = $(this).attr('id');
    }
    else {
      selected_size = 11;
    }
  }
});

var flagerror = 0;
$('#addtext').click(function(){
  canvas.remove(canvas.item(0));
  if($('#inscription').val().length <= 32){
    var text = new fabric.Text($('#inscription').val(), {
      left: limitationBox.left,
      top: limitationBox.top,
      fill: $('#btn-color').val(),
    });
    canvas.add(text);
    if (flagerror != 0){
      document.getElementById("errorlength").classList.toggle("invisible");
      document.getElementById("errorlength").classList.toggle("error-login");
      flagerror = 0;
    }
  }
  else{
    if (flagerror == 0){
      flagerror = 1;
    }
  }
  if (flagerror == 1){
    document.getElementById("errorlength").classList.toggle("invisible");
    document.getElementById("errorlength").classList.toggle("error-login");
    flagerror = 2;
  }
});


});