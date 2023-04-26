<?php
   $name = "John";
   echo "Hello, $name!";  
   ?>
   
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>Personalization</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
      <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
      <!--[if IE]><script type="text/javascript" src="js/excanvas.js"></script><![endif]-->
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>	
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
      </script>
      <script type="text/javascript" src="js/fabric.js"></script>
      <script type="text/javascript" src="js/tshirtEditor.js"></script>
      <script type="text/javascript" src="js/jquery.miniColors.min.js"></script>
      <!-- Le styles -->
      <!-- <link type="text/css" rel="stylesheet" href="css/jquery.miniColors.css" />
         <link href="css/bootstrap.min.css" rel="stylesheet">
         <link href="css/bootstrap-responsive.min.css" rel="stylesheet"> -->
      <script src="{{ url_for('static', filename='js/jquery.min.js') }}"></script>	
      <script type="text/javascript" src="{{ url_for('static', filename='js/fabric.js') }}"></script>
      <script type="text/javascript" src="{{ url_for('static', filename='js/tshirtEditor.js') }}"></script>
      <script type="text/javascript" src="{{ url_for('static', filename='js/jquery.miniColors.min.js') }}"></script>
      <!-- Le styles -->
      <link type="text/css" rel="stylesheet" href="{{ url_for('static', filename='js/jquery.miniColors.css') }}" />
      <link href="{{ url_for('static', filename='css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ url_for('static', filename='css/bootstrap-responsive.min.css') }}" rel="stylesheet">
      <script type="text/javascript"></script>
      <script type="text/javascript"></script>
      <style type="text/css">
         .footer {
         padding: 70px 0;
         margin-top: 70px;
         border-top: 1px solid #E5E5E5;
         background-color: whiteSmoke;
         }			
         body {
         padding-top: 60px;	  
         overflow: hidden;
         }
         #canvas{
         position: absolute;
         z-index: 500;
         -webkit-clip-path:  polygon(20.18% 3.39%, 75% 3.39%, 67.88% 37.05%, 65.14% 50%, 75% 96.5%, 25% 96.5%, 35.75% 50%, 31.42% 37.05%);
         clip-path: polygon(88.000px 18.000px, 1.000px 233.000px, 124.000px 267.000px, 72.000px 610.000px, 129.000px 610.000px, 135.000px 632.000px, 231.000px 627.000px, 340.000px 632.000px, 377.000px 617.000px, 460.000px 610.000px, 412.000px 267.000px, 532.000px 233.000px, 419.000px 1.000px, 102.000px 7.000px, 88.000px 18.000px);
         /* background-color: #a5a3a3 */
         }
         .tools .color-field{
         height: 40px;
         width: 40px;
         min-height: 40px;
         cursor: pointer;
         cursor: pointer;
         box-sizing: border-box;
         border-radius: 50%;
         }
         .tools .color-picker{
         margin: 0 10px;
         height: 20px;
         }
         .color-preview {
         border: 1px solid #CCC;
         margin: 2px;
         zoom: 1;
         vertical-align: top;
         display: inline-block;
         cursor: pointer;
         overflow: hidden;
         width: 20px;
         height: 20px;
         }
         .rotate {  
         -webkit-transform:rotate(90deg);
         -moz-transform:rotate(90deg);
         -o-transform:rotate(90deg);
         /* filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=1.5); */
         -ms-transform:rotate(90deg);		   
         }		
         .Arial{font-family:"Arial";}
         .Helvetica{font-family:"Helvetica";}
         .MyriadPro{font-family:"Myriad Pro";}
         .Delicious{font-family:"Delicious";}
         .Verdana{font-family:"Verdana";}
         .Georgia{font-family:"Georgia";}
         .Courier{font-family:"Courier";}
         .ComicSansMS{font-family:"Comic Sans MS";}
         .Impact{font-family:"Impact";}
         .Monaco{font-family:"Monaco";}
         .Optima{font-family:"Optima";}
         .HoeflerText{font-family:"Hoefler Text";}
         .Plaster{font-family:"Plaster";}
         .Engagement{font-family:"Engagement";}
         #tcanvas {
         width: 200px;
         height: 400px;
         -webkit-clip-path:  polygon(20.18% 3.39%, 75% 3.39%, 67.88% 37.05%, 65.14% 50%, 75% 96.5%, 25% 96.5%, 35.75% 50%, 31.42% 37.05%);
         clip-path: polygon(88.000px 18.000px, 1.000px 233.000px, 124.000px 267.000px, 72.000px 610.000px, 129.000px 610.000px, 135.000px 632.000px, 231.000px 627.000px, 340.000px 632.000px, 377.000px 617.000px, 460.000px 610.000px, 412.000px 267.000px, 532.000px 233.000px, 419.000px 1.000px, 102.000px 7.000px, 88.000px 18.000px);
         /* background-color: #a5a3a3 */
         }
      </style>
   </head>
   <body class="preview" data-spy="scroll" data-target=".subnav" data-offset="80">
      <!-- Navbar
         ================================================== -->
      <div class="navbar navbar-fixed-top">
      </div>
      <div class="container">
         <section id="typography">
            <!-- Headings & Paragraph Copy -->
            <div class="row">
               <div class="span3">
                  <div class="tabbable">
                     <!-- Only required for left/right tabs -->
                     <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">Dress Options</a></li>
                        <li><a href="#tab2" data-toggle="tab">Designs</a></li>
                     </ul>
                     <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                           <!-- <div class="well"> -->
                           <!--					      	<h3>Tee Styles</h3>-->
                           <!--						      <p>-->
                           <!-- <select id="">
                              <option value="1" selected="selected">Short Sleeve Shirts</option>
                              <option value="2">Long Sleeve Shirts</option>
                              <option value="3">Hoodies</option>
                              <option value="4">Tank tops</option>
                              </select> -->
                           <!--						      </p>-->								
                           <!-- </div> -->
                           <div class="well">
                              <ul class="nav">
                                 <li class="color-preview" title="White" style="background-color:#ffffff;"></li>
                                 <li class="color-preview" title="Dark Heather" style="background-color:#616161;"></li>
                                 <li class="color-preview" title="Gray" style="background-color:#f0f0f0;"></li>
                                 <li class="color-preview" title="Charcoal" style="background-color:#5b5b5b;"></li>
                                 <li class="color-preview" title="Black" style="background-color:#222222;"></li>
                                 <li class="color-preview" title="Heather Orange" style="background-color:#fc8d74;"></li>
                                 <li class="color-preview" title="Heather Dark Chocolate" style="background-color:#432d26;"></li>
                                 <li class="color-preview" title="Salmon" style="background-color:#eead91;"></li>
                                 <li class="color-preview" title="Chesnut" style="background-color:#806355;"></li>
                                 <li class="color-preview" title="Dark Chocolate" style="background-color:#382d21;"></li>
                                 <li class="color-preview" title="Citrus Yellow" style="background-color:#faef93;"></li>
                                 <li class="color-preview" title="Avocado" style="background-color:#aeba5e;"></li>
                                 <li class="color-preview" title="Kiwi" style="background-color:#8aa140;"></li>
                                 <li class="color-preview" title="Irish Green" style="background-color:#1f6522;"></li>
                                 <li class="color-preview" title="Scrub Green" style="background-color:#13afa2;"></li>
                                 <li class="color-preview" title="Teal Ice" style="background-color:#b8d5d7;"></li>
                                 <li class="color-preview" title="Heather Sapphire" style="background-color:#15aeda;"></li>
                                 <li class="color-preview" title="Sky" style="background-color:#a5def8;"></li>
                                 <li class="color-preview" title="Antique Sapphire" style="background-color:#0f77c0;"></li>
                                 <li class="color-preview" title="Heather Navy" style="background-color:#3469b7;"></li>
                                 <li class="color-preview" title="Cherry Red" style="background-color:#c50404;"></li>
                              </ul>
                           </div>
                           <div class="well">
                              <div class="field">
                                 <div class="tools">
                                    <button type="button">Undo</button>
                                    <button type="button">Clear</button>
                                    <div onclick="change_color(this)" class="color-field" style="background:red;"></div>
                                    <div onclick="change_color(this)" class="color-field" style="background:blue;"></div>
                                    <div onclick="change_color(this)" class="color-field" style="background:green;"></div>
                                    <div onclick="change_color(this)" class="color-field" style="background:yellow;"></div>
                                    <input type="range" min="1" max="100" class="pen-range" onInput="draw_width=this.value">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane" id="tab2">
   <div class="well">
      <div class="input-append">
         <input class="span2" id="text-string" type="text" placeholder="add text here...">
         <button id="add-text" class="btn" title="Add text"><i class="icon-share-alt"></i></button>
         <hr>
      </div>
      <div id="avatarlist">
         <input type="file" accept="image/png" id="avatar-upload">
         <img style="cursor:pointer;" class="img-polaroid" src="{{ url_for('static', filename='img/shirt.png') }}">
         <img style="cursor:pointer;" class="img-polaroid" src="{{ url_for('static', filename='img/flower.png') }}">
      </div>
   </div>
</div>

                     </div>
                  </div>
               </div>
               <div class="span6">
                  <div align="center" style="min-height: 32px;">
                     <div class="clearfix">
                        <div class="btn-group inline pull-left" id="texteditor" style="display:none">
                           <button id="font-family" class="btn dropdown-toggle" data-toggle="dropdown" title="Font Style"><i class="icon-font" style="width:19px;height:19px;"></i></button>		                      
                           <ul class="dropdown-menu" role="menu" aria-labelledby="font-family-X">
                              <li><a tabindex="-1" href="#" onclick="setFont('Arial');" class="Arial">Arial</a></li>
                              <li><a tabindex="-1" href="#" onclick="setFont('Helvetica');" class="Helvetica">Helvetica</a></li>
                              <li><a tabindex="-1" href="#" onclick="setFont('Myriad Pro');" class="MyriadPro">Myriad Pro</a></li>
                              <li><a tabindex="-1" href="#" onclick="setFont('Delicious');" class="Delicious">Delicious</a></li>
                              <li><a tabindex="-1" href="#" onclick="setFont('Verdana');" class="Verdana">Verdana</a></li>
                              <li><a tabindex="-1" href="#" onclick="setFont('Georgia');" class="Georgia">Georgia</a></li>
                              <li><a tabindex="-1" href="#" onclick="setFont('Courier');" class="Courier">Courier</a></li>
                              <li><a tabindex="-1" href="#" onclick="setFont('Comic Sans MS');" class="ComicSansMS">Comic Sans MS</a></li>
                              <li><a tabindex="-1" href="#" onclick="setFont('Impact');" class="Impact">Impact</a></li>
                              <li><a tabindex="-1" href="#" onclick="setFont('Monaco');" class="Monaco">Monaco</a></li>
                              <li><a tabindex="-1" href="#" onclick="setFont('Optima');" class="Optima">Optima</a></li>
                              <li><a tabindex="-1" href="#" onclick="setFont('Hoefler Text');" class="Hoefler Text">Hoefler Text</a></li>
                              <li><a tabindex="-1" href="#" onclick="setFont('Plaster');" class="Plaster">Plaster</a></li>
                              <li><a tabindex="-1" href="#" onclick="setFont('Engagement');" class="Engagement">Engagement</a></li>
                           </ul>
                           <button id="text-bold" class="btn" data-original-title="Bold"><img src="img/font_bold.png" height="" width=""></button>
                           <button id="text-italic" class="btn" data-original-title="Italic"><img src="img/font_italic.png" height="" width=""></button>
                           <button id="text-strike" class="btn" title="Strike" style=""><img src="img/font_strikethrough.png" height="" width=""></button>
                           <button id="text-underline" class="btn" title="Underline" style=""><img src="img/font_underline.png"></button>
                           <a class="btn" href="#" rel="tooltip" data-placement="top" data-original-title="Font Color"><input type="hidden" id="text-fontcolor" class="color-picker" size="7" value="#000000"></a>
                           <a class="btn" href="#" rel="tooltip" data-placement="top" data-original-title="Font Border Color"><input type="hidden" id="text-strokecolor" class="color-picker" size="7" value="#000000"></a>
                           <!--- Background <input type="hidden" id="text-bgcolor" class="color-picker" size="7" value="#ffffff"> --->
                        </div>
                        <div class="pull-right" align="" id="imageeditor" style="display:none">
                           <div class="btn-group">										      
                              <button class="btn" id="bring-to-front" title="Bring to Front"><i class="icon-fast-backward rotate" style="height:19px;"></i></button>
                              <button class="btn" id="send-to-back" title="Send to Back"><i class="icon-fast-forward rotate" style="height:19px;"></i></button>
                              <button id="flip" type="button" class="btn" title="Show Back View"><i class="icon-retweet" style="height:19px;"></i></button>
                              <button id="remove-selected" class="btn" title="Delete selected item"><i class="icon-trash" style="height:19px;"></i></button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="design" id="design">
                     <canvas id="canvas"></canvas>
                     <!--	EDITOR      -->					
                     <div id="shirtDiv" class="page" style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255);">
                        <img src="{{ url_for('static', filename='img/crew_front.png') }}">
                        <div id="drawingArea" style="position: absolute;top: -2px;left: 5px;z-index: 10;width: 200px;height: 589px;">
                           <canvas id="tcanvas" width=600 height="689" class="hover" style="-webkit-user-select: none;"></canvas>
                        </div>
                     </div>
                  </div>
                  <!--					<div id="shirtBack" class="page" style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255); display:none;">-->
                  <!--						<img src="img/crew_back.png"></img>-->
                  <!--						<div id="drawingArea" style="position: absolute;top: 100px;left: 160px;z-index: 10;width: 200px;height: 400px;">					-->
                  <!--							<canvas id="backCanvas" width=200 height="400" class="hover" style="-webkit-user-select: none;"></canvas>-->
                  <!--						</div>-->
                  <!--					</div>						-->
                  <!--	/EDITOR		-->
               </div>
               <div class="span3">
                  <div class="well">
                     <h3>Total Prices</h3>
                     <form id="price-predictor" action="/" method="POST">
                        <input type="hidden" name="color1" id="color-input">
                        <input type="hidden" name="color2" id="color-input2">
                        <input type="hidden" name="color3" id="color-input3">
                        <input type="hidden" name="color4" id="color-input4">
                        <label for="">Size</label>
                        <select name="size" id="size" required>
                           <option value="" selected hidden>Select</option>
                           <option value="s">Small</option>
                           <option value="m" >Medium</option>
                           <option value="l" >Large</option>
                           <option value="xl">Extra large</option>
                        </select>
                        <label for="">Fabric Type</label>
                        <select name="fabric" id="fabric" required>
                           <option value="" selected hidden>Select</option>
                           <option value="linen">Linen</option>
                           <option value="rayon" >Rayon</option>
                           <option value="cotton" >Cotton</option>
                           <option value="silk">Silk</option>
                        </select>
                        <input type="submit" class="btn" value="Predict Price">
                     </form>
                     <h4>Rs <span id="result"></span></h4>
                  </div>
                  <a href="{{ url_for('myfunction') }}" class="btn btn-primary">Checkout</a>
                  <button id="download" class="btn btn-primary">Download</button>
                  <div class="src-preview">
                     <div class="screenshot">
                        <i id="close-btn" class="fa-solid fa-xmark"></i>
                        
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
      <!-- /container -->
      <!-- Footer ================================================== -->
      <footer class="footer">
         <div class="container">
            <p class="pull-right"><a href="#">Back to top</a></p>
         </div>
      </footer>
      <!-- Le javascript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->    
      <script src="{{ url_for('static', filename='js/bootstrap.min.js') }}"></script>
      <script src="js/bootstrap.min.js"></script>    
      <script type="text/javascript">
         var _gaq = _gaq || [];
         _gaq.push(['_setAccount', 'UA-35639689-1']);
         _gaq.push(['_trackPageview']);
         
         (function() {
           var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
           ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
           var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
         })();
         
      </script>
      <script>
         //  Drawing tool
         const DrawingCanvas = document.getElementById("canvas");
         DrawingCanvas.width = window.innerWidth - 60;
         DrawingCanvas.height = 600;
         
         let context = DrawingCanvas.getContext("2d");
         context.fillStyle = "rgba(255, 255, 255, 0)";
         context.fillRect(0, 0, DrawingCanvas.width, DrawingCanvas.height);
         
         let draw_color = "black";
         let draw_width = "2";
         let is_drawing = false;
         
         function change_color(element) {
         	draw_color = element.style.background;
            if (draw_color === "red") {
               document.getElementById("color-input").value = "1";
               }else if (draw_color === "blue") {
                  document.getElementById("color-input2").value = "1";
               }
               else if (draw_color === "green") {
                  document.getElementById("color-input3").value = "1";
               }else if (draw_color === "yellow") {
                  document.getElementById("color-input4").value = "1";
               }
         }
         
         DrawingCanvas.addEventListener("touchstart", start, false);
         DrawingCanvas.addEventListener("touchmove", draw, false);
         DrawingCanvas.addEventListener("mousedown", start, false);
         DrawingCanvas.addEventListener("mousemove", draw, false);
         
         DrawingCanvas.addEventListener("touchend", stop, false);
         DrawingCanvas.addEventListener("mouseup", stop, false);
         DrawingCanvas.addEventListener("mouseout", stop, false);
         
         
         function start(event) {
           is_drawing = true;
           context.beginPath();
           context.moveTo(
             event.clientX - DrawingCanvas.offsetLeft,
             event.clientY - DrawingCanvas.offsetTop
           );
           event.preventDefault();
         }
         
         function draw(event) {
           if (is_drawing) {
             context.lineTo(
               event.clientX - DrawingCanvas.offsetLeft,
               event.clientY - DrawingCanvas.offsetTop
             );
         
             context.strokeStyle = draw_color;
             context.lineWidth = draw_width;
             context.lineCap = "round";
             context.lineJoin = "round";
             context.stroke();
           }
           event.preventDefault();
         }
         
         function stop(event) {
           if (is_drawing) {
             context.stroke();
         	context.closePath();
         	is_drawing=false;
           }
           event.preventDefault();
         }
         
         //
         
         $(document).ready(function() {
         $('form').submit(function(event) {
         event.preventDefault();
         var formData = $(this).serialize();
         $.ajax({
         url: '/',
         type: 'POST',
         data: formData,
         dataType: 'json',
         success: function(response) {
         $('#result').text(response.pred);
         },
         error: function(xhr, status, error) {
         console.log(xhr.responseText);
         }
         });
         });
         });
         // Screenshot
         const screenshotBtn = document.querySelector("#download");

screenshotBtn.addEventListener("click", async () => {
  try {
    // Get the user's screen or a specific tab
    const stream = await navigator.mediaDevices.getDisplayMedia({ video: true });

    // Create a video element to capture the screen
    const video = document.createElement("video");
    video.srcObject = stream;

    // Wait for the video to load the metadata and dimensions
    video.addEventListener("loadedmetadata", () => {
      // Create a canvas to draw the screenshot
      const canvas = document.createElement("canvas");
      const ctx = canvas.getContext("2d");

      // Set the canvas dimensions to the video dimensions
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;

      // Draw the video frame on the canvas
      ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

      // Create a download link for the screenshot
      const downloadLink = document.createElement("a");
      downloadLink.download = "screenshot.png";
      downloadLink.href = canvas.toDataURL("image/png");
      document.body.appendChild(downloadLink);
      
      // Click the download link to download the screenshot
      downloadLink.click();

      // Stop the video stream
      stream.getVideoTracks()[0].stop();
    });

    // Start playing the video to load the metadata
    video.play();
  } catch (error) {
    console.log(error);
  }
});

 const avatarUpload = document.getElementById("avatar-upload");
  avatarUpload.addEventListener("change", () => {
    const file = avatarUpload.files[0];
    const formData = new FormData();
    formData.append("avatar", file);
    fetch("/upload-avatar", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      console.log(data.url); // this will be the URL of the saved PNG file
    });
  });
      </script>
   </body>
</html>