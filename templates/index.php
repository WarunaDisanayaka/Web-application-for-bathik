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
   <link href="{{ url_for('static', filename='css/styles.css') }}" rel="stylesheet">
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

      #canvas {
         position: absolute;
         z-index: 500;
         top: 10.6rem;
         left: 35.22rem;
         -webkit-clip-path: polygon(60.938px 250.506px, 56.750px 270.694px, 53.871px 283.376px, 49.945px 306.929px, 44.710px 344.718px, 42.355px 393.894px, 41.570px 425.471px, 47.328px 428.577px, 61.200px 433.235px, 102.031px 439.188px, 139.460px 441.000px, 177.150px 441.000px, 215.888px 437.376px, 240.753px 434.012px, 260.122px 428.577px, 262.477px 427.282px, 263.786px 425.729px, 264.833px 423.659px, 264.833px 412.788px, 263.786px 384.576px, 263.001px 349.635px, 260.645px 327.894px, 257.243px 307.188px, 249.914px 269.141px, 243.632px 243.259px, 237.350px 223.071px, 230.283px 201.329px, 226.881px 189.424px, 225.834px 176.224px, 225.834px 155.776px, 226.881px 142.576px, 229.498px 129.376px, 232.116px 119.024px, 235.780px 108.412px, 243.632px 117.471px, 247.820px 125.494px, 254.363px 139.988px, 260.122px 151.118px, 266.927px 151.118px, 284.202px 146.200px, 298.597px 139.988px, 302.000px 137.918px, 302.000px 134.294px, 290.483px 107.376px, 284.202px 91.588px, 275.303px 60.529px, 269.283px 44.224px, 260.383px 26.623px, 255.149px 20.929px, 249.914px 16.012px, 239.706px 12.129px, 206.203px 1.000px, 203.324px 5.918px, 198.875px 9.024px, 191.023px 12.129px, 181.338px 13.941px, 171.392px 16.012px, 150.977px 16.012px, 138.151px 16.012px, 132.131px 16.012px, 122.447px 13.941px, 114.333px 12.129px, 108.313px 10.318px, 103.863px 7.988px, 101.246px 5.918px, 99.676px 2.294px, 92.347px 2.294px, 60.938px 13.941px, 52.824px 17.823px, 44.187px 25.329px, 37.905px 36.977px, 32.670px 48.365px, 21.416px 85.894px, 12.255px 111.259px, 1.000px 136.882px, 13.825px 144.388px, 26.912px 148.271px, 45.234px 152.412px, 51.516px 139.212px, 55.965px 129.635px, 63.032px 117.212px, 68.790px 109.965px, 71.146px 114.624px, 74.549px 124.459px, 77.951px 140.506px, 80.307px 164.835px, 81.616px 175.706px, 80.307px 186.318px, 77.951px 195.118px, 67.220px 229.541px, 60.938px 250.506px);
         /* background-color: #a5a3a3 */
      }

      .tools .color-field {
         height: 40px;
         width: 40px;
         min-height: 40px;
         cursor: pointer;
         cursor: pointer;
         box-sizing: border-box;
         border-radius: 50%;
      }

      .tools .color-picker {
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
         -webkit-transform: rotate(90deg);
         -moz-transform: rotate(90deg);
         -o-transform: rotate(90deg);
         /* filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=1.5); */
         -ms-transform: rotate(90deg);
      }

      .Arial {
         font-family: "Arial";
      }

      .Helvetica {
         font-family: "Helvetica";
      }

      .MyriadPro {
         font-family: "Myriad Pro";
      }

      .Delicious {
         font-family: "Delicious";
      }

      .Verdana {
         font-family: "Verdana";
      }

      .Georgia {
         font-family: "Georgia";
      }

      .Courier {
         font-family: "Courier";
      }

      .ComicSansMS {
         font-family: "Comic Sans MS";
      }

      .Impact {
         font-family: "Impact";
      }

      .Monaco {
         font-family: "Monaco";
      }

      .Optima {
         font-family: "Optima";
      }

      .HoeflerText {
         font-family: "Hoefler Text";
      }

      .Plaster {
         font-family: "Plaster";
      }

      .Engagement {
         font-family: "Engagement";
      }

      #tcanvas {
         width: 200px;
         height: 400px;
         -webkit-clip-path: polygon(60.938px 250.506px, 56.750px 270.694px, 53.871px 283.376px, 49.945px 306.929px, 44.710px 344.718px, 42.355px 393.894px, 41.570px 425.471px, 47.328px 428.577px, 61.200px 433.235px, 102.031px 439.188px, 139.460px 441.000px, 177.150px 441.000px, 215.888px 437.376px, 240.753px 434.012px, 260.122px 428.577px, 262.477px 427.282px, 263.786px 425.729px, 264.833px 423.659px, 264.833px 412.788px, 263.786px 384.576px, 263.001px 349.635px, 260.645px 327.894px, 257.243px 307.188px, 249.914px 269.141px, 243.632px 243.259px, 237.350px 223.071px, 230.283px 201.329px, 226.881px 189.424px, 225.834px 176.224px, 225.834px 155.776px, 226.881px 142.576px, 229.498px 129.376px, 232.116px 119.024px, 235.780px 108.412px, 243.632px 117.471px, 247.820px 125.494px, 254.363px 139.988px, 260.122px 151.118px, 266.927px 151.118px, 284.202px 146.200px, 298.597px 139.988px, 302.000px 137.918px, 302.000px 134.294px, 290.483px 107.376px, 284.202px 91.588px, 275.303px 60.529px, 269.283px 44.224px, 260.383px 26.623px, 255.149px 20.929px, 249.914px 16.012px, 239.706px 12.129px, 206.203px 1.000px, 203.324px 5.918px, 198.875px 9.024px, 191.023px 12.129px, 181.338px 13.941px, 171.392px 16.012px, 150.977px 16.012px, 138.151px 16.012px, 132.131px 16.012px, 122.447px 13.941px, 114.333px 12.129px, 108.313px 10.318px, 103.863px 7.988px, 101.246px 5.918px, 99.676px 2.294px, 92.347px 2.294px, 60.938px 13.941px, 52.824px 17.823px, 44.187px 25.329px, 37.905px 36.977px, 32.670px 48.365px, 21.416px 85.894px, 12.255px 111.259px, 1.000px 136.882px, 13.825px 144.388px, 26.912px 148.271px, 45.234px 152.412px, 51.516px 139.212px, 55.965px 129.635px, 63.032px 117.212px, 68.790px 109.965px, 71.146px 114.624px, 74.549px 124.459px, 77.951px 140.506px, 80.307px 164.835px, 81.616px 175.706px, 80.307px 186.318px, 77.951px 195.118px, 67.220px 229.541px, 60.938px 250.506px);
         /* background-color: #a5a3a3 */
      }
      /* Media query */
      @media(min-width:1024px ){
         #canvas {
         position: absolute;
         z-index: 500;
         top: 10.6rem;
         left: 48rem;
         -webkit-clip-path: polygon(60.938px 250.506px, 56.750px 270.694px, 53.871px 283.376px, 49.945px 306.929px, 44.710px 344.718px, 42.355px 393.894px, 41.570px 425.471px, 47.328px 428.577px, 61.200px 433.235px, 102.031px 439.188px, 139.460px 441.000px, 177.150px 441.000px, 215.888px 437.376px, 240.753px 434.012px, 260.122px 428.577px, 262.477px 427.282px, 263.786px 425.729px, 264.833px 423.659px, 264.833px 412.788px, 263.786px 384.576px, 263.001px 349.635px, 260.645px 327.894px, 257.243px 307.188px, 249.914px 269.141px, 243.632px 243.259px, 237.350px 223.071px, 230.283px 201.329px, 226.881px 189.424px, 225.834px 176.224px, 225.834px 155.776px, 226.881px 142.576px, 229.498px 129.376px, 232.116px 119.024px, 235.780px 108.412px, 243.632px 117.471px, 247.820px 125.494px, 254.363px 139.988px, 260.122px 151.118px, 266.927px 151.118px, 284.202px 146.200px, 298.597px 139.988px, 302.000px 137.918px, 302.000px 134.294px, 290.483px 107.376px, 284.202px 91.588px, 275.303px 60.529px, 269.283px 44.224px, 260.383px 26.623px, 255.149px 20.929px, 249.914px 16.012px, 239.706px 12.129px, 206.203px 1.000px, 203.324px 5.918px, 198.875px 9.024px, 191.023px 12.129px, 181.338px 13.941px, 171.392px 16.012px, 150.977px 16.012px, 138.151px 16.012px, 132.131px 16.012px, 122.447px 13.941px, 114.333px 12.129px, 108.313px 10.318px, 103.863px 7.988px, 101.246px 5.918px, 99.676px 2.294px, 92.347px 2.294px, 60.938px 13.941px, 52.824px 17.823px, 44.187px 25.329px, 37.905px 36.977px, 32.670px 48.365px, 21.416px 85.894px, 12.255px 111.259px, 1.000px 136.882px, 13.825px 144.388px, 26.912px 148.271px, 45.234px 152.412px, 51.516px 139.212px, 55.965px 129.635px, 63.032px 117.212px, 68.790px 109.965px, 71.146px 114.624px, 74.549px 124.459px, 77.951px 140.506px, 80.307px 164.835px, 81.616px 175.706px, 80.307px 186.318px, 77.951px 195.118px, 67.220px 229.541px, 60.938px 250.506px);
         /* background-color: #a5a3a3 */
      }
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
                              <li class="color-preview" title="White" style="background-color:	#feffc7;"></li>
                              <li class="color-preview" title="Dark Heather" style="background-color:#d88e30;"></li>
                              <li class="color-preview" title="Gray" style="background-color:#a64e00;"></li>
                              <li class="color-preview" title="Charcoal" style="background-color:#BB42D2;"></li>
                              <li class="color-preview" title="Black" style="background-color:#F6F286;"></li>
                              <li class="color-preview" title="Heather Orange" style="background-color:#fc8d74;"></li>
                              <li class="color-preview" title="Heather Dark Chocolate"
                                 style="background-color:#432d26;"></li>
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
                        <section class="tools-board">
      <div class="row">
        <label class="title">Shapes</label>
        <ul class="options">
          <li class="option tool" id="rectangle">
            <img src="icons/rectangle.svg" alt="">
            <span>Rectangle</span>
          </li>
          <li class="option tool" id="circle">
            <img src="icons/circle.svg" alt="">
            <span>Circle</span>
          </li>
          <li class="option tool" id="triangle">
            <img src="icons/triangle.svg" alt="">
            <span>Triangle</span>
          </li>
          <li class="option">
            <input type="checkbox" id="fill-color">
            <label for="fill-color">Fill color</label>
          </li>
        </ul>
      </div>
      <div class="row">
        <label class="title">Options</label>
        <ul class="options">
          <li class="option active tool" id="brush">
            <img src="icons/brush.svg" alt="">
            <span>Brush</span>
          </li>
          <li class="option tool" id="eraser">
            <img src="icons/eraser.svg" alt="">
            <span>Eraser</span>
          </li>
          <li class="option">
            <input type="range" id="size-slider" min="1" max="30" value="5">
          </li>
        </ul>
      </div>
      <div class="row colors">
        <label class="title">Colors</label>
        <ul class="options">
          <li class="option"></li>
          <li class="option selected"></li>
          <li class="option"></li>
          <li class="option"></li>
          <li class="option">
            <input type="color" id="color-picker" value="#4A98F7">
          </li>
        </ul>
      </div>
      <div class="row buttons">
        <button class="clear-canvas">Clear Canvas</button>
        <!-- <button class="save-img">Save As Image</button> -->
      </div>
    </section>
                     </div>
                     <div class="container">
                        <section class="drawing-board">
                        </section>
                     </div>
                     <div class="tab-pane" id="tab2">
                        <div class="well">
                           <div class="input-append">
                              <input class="span2" id="text-string" type="text" placeholder="add text here...">
                              <button id="add-text" class="btn" title="Add text"><i class="icon-share-alt"></i></button>
                              <hr>
                           </div>
                           <div id="avatarlist">

                              <img style="cursor:pointer;" class="img-polaroid"
                                 src="{{ url_for('static', filename='img/shirt.png') }}">
                              <img style="cursor:pointer;" class="img-polaroid"
                                 src="{{ url_for('static', filename='img/flower.png') }}">
                              <img style="cursor:pointer;" class="img-polaroid"
                                 src="{{ url_for('static', filename='img/pngegg (2).png') }}">
                           </div>
                           <div>
                              <hr>
                              <form action="" method="post" enctype="multipart/form-data">
                                 <input type="file" name="fileToUpload" id="fileToUpload">
                                 <input class="btn btn-primary" type="submit" value="Upload Custom Image" name="submit">
                              </form>

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
                        <button id="font-family" class="btn dropdown-toggle" data-toggle="dropdown"
                           title="Font Style"><i class="icon-font" style="width:19px;height:19px;"></i></button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="font-family-X">
                           <li><a tabindex="-1" href="#" onclick="setFont('Arial');" class="Arial">Arial</a></li>
                           <li><a tabindex="-1" href="#" onclick="setFont('Helvetica');" class="Helvetica">Helvetica</a>
                           </li>
                           <li><a tabindex="-1" href="#" onclick="setFont('Myriad Pro');" class="MyriadPro">Myriad
                                 Pro</a></li>
                           <li><a tabindex="-1" href="#" onclick="setFont('Delicious');" class="Delicious">Delicious</a>
                           </li>
                           <li><a tabindex="-1" href="#" onclick="setFont('Verdana');" class="Verdana">Verdana</a></li>
                           <li><a tabindex="-1" href="#" onclick="setFont('Georgia');" class="Georgia">Georgia</a></li>
                           <li><a tabindex="-1" href="#" onclick="setFont('Courier');" class="Courier">Courier</a></li>
                           <li><a tabindex="-1" href="#" onclick="setFont('Comic Sans MS');" class="ComicSansMS">Comic
                                 Sans MS</a></li>
                           <li><a tabindex="-1" href="#" onclick="setFont('Impact');" class="Impact">Impact</a></li>
                           <li><a tabindex="-1" href="#" onclick="setFont('Monaco');" class="Monaco">Monaco</a></li>
                           <li><a tabindex="-1" href="#" onclick="setFont('Optima');" class="Optima">Optima</a></li>
                           <li><a tabindex="-1" href="#" onclick="setFont('Hoefler Text');" class="Hoefler Text">Hoefler
                                 Text</a></li>
                           <li><a tabindex="-1" href="#" onclick="setFont('Plaster');" class="Plaster">Plaster</a></li>
                           <li><a tabindex="-1" href="#" onclick="setFont('Engagement');"
                                 class="Engagement">Engagement</a></li>
                        </ul>
                        <button id="text-bold" class="btn" data-original-title="Bold"><img src="img/font_bold.png"
                              height="" width=""></button>
                        <button id="text-italic" class="btn" data-original-title="Italic"><img src="img/font_italic.png"
                              height="" width=""></button>
                        <button id="text-strike" class="btn" title="Strike" style=""><img
                              src="img/font_strikethrough.png" height="" width=""></button>
                        <button id="text-underline" class="btn" title="Underline" style=""><img
                              src="img/font_underline.png"></button>
                        <a class="btn" href="#" rel="tooltip" data-placement="top"
                           data-original-title="Font Color"><input type="hidden" id="text-fontcolor"
                              class="color-picker" size="7" value="#000000"></a>
                        <a class="btn" href="#" rel="tooltip" data-placement="top"
                           data-original-title="Font Border Color"><input type="hidden" id="text-strokecolor"
                              class="color-picker" size="7" value="#000000"></a>
                        <!--- Background <input type="hidden" id="text-bgcolor" class="color-picker" size="7" value="#ffffff"> --->
                     </div>
                     <div class="pull-right" align="" id="imageeditor" style="display:none">
                        <div class="btn-group">
                           <button class="btn" id="bring-to-front" title="Bring to Front"><i
                                 class="icon-fast-backward rotate" style="height:19px;"></i></button>
                           <button class="btn" id="send-to-back" title="Send to Back"><i
                                 class="icon-fast-forward rotate" style="height:19px;"></i></button>
                           <button id="flip" type="button" class="btn" title="Show Back View"><i class="icon-retweet"
                                 style="height:19px;"></i></button>
                           <button id="remove-selected" class="btn" title="Delete selected item"><i class="icon-trash"
                                 style="height:19px;"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col">
                     <div class="design" id="design">
                        <button id="flipback" type="button" class="btn" title="Rotate View"><i class="icon-retweet"
                              style="height:19px;"></i></button>
                        <canvas id="canvas"></canvas>
                        <!--	EDITOR      -->
                        <div id="shirtDiv" class="page"
                           style="width: 530px; height: 520px; position: relative; background-color: rgb(255, 255, 255);">
                           <img src="{{ url_for('static', filename='img/crew_front.png') }}">
                           <div id="drawingArea"
                              style="position: absolute;top: 2.8rem;left: 7.6rem;z-index: 10;width: 200px;height: 589px;">
                              <canvas id="tcanvas" width=600 height="689" class="hover"
                                 style="-webkit-user-select: none;"></canvas>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--					<div id="shirtBack" class="page" style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255); display:none;">-->
               <!--						<img src="{{ url_for('static', filename='img/crew_front.png') }}"></img>-->
               <!--						<div id="drawingArea" style="position: absolute;top: 100px;left: 160px;z-index: 10;width: 200px;height: 400px;">					-->
               <!--							<canvas id="backCanvas" width=200 height="400" class="hover" style="-webkit-user-select: none;"></canvas>-->
               <!--						</div>-->
               <!--					</div>						-->
               <!--	/EDITOR		-->
            </div>
            <div class="span3" >
               <div class="well" >
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
                        <option value="m">Medium</option>
                        <option value="l">Large</option>
                        <option value="xl">Extra large</option>
                     </select>
                     <label for="">Fabric Type</label>
                     <select name="fabric" id="fabric" required>
                        <option value="" selected hidden>Select</option>
                        <option value="linen">Linen</option>
                        <option value="rayon">Rayon</option>
                        <option value="cotton">Cotton</option>
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

      (function () {
         var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
         ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
         var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

   </script>
   <script>
      //  Drawing tool
      // const DrawingCanvas = document.getElementById("canvas");
    

      // let context = DrawingCanvas.getContext("2d");
      // context.fillStyle = "rgba(255, 255, 255, 0)";
      // context.fillRect(0, 0, DrawingCanvas.width, DrawingCanvas.height);

      // let draw_color = "black";
      // let draw_width = "2";
      // let is_drawing = false;

      // function change_color(element) {
      //    draw_color = element.style.background;
      //    if (draw_color === "red") {
      //       document.getElementById("color-input").value = "1";
      //    } else if (draw_color === "blue") {
      //       document.getElementById("color-input2").value = "1";
      //    }
      //    else if (draw_color === "green") {
      //       document.getElementById("color-input3").value = "1";
      //    } else if (draw_color === "yellow") {
      //       document.getElementById("color-input4").value = "1";
      //    }
      // }

      // DrawingCanvas.addEventListener("touchstart", start, false);
      // DrawingCanvas.addEventListener("touchmove", draw, false);
      // DrawingCanvas.addEventListener("mousedown", start, false);
      // DrawingCanvas.addEventListener("mousemove", draw, false);

      // DrawingCanvas.addEventListener("touchend", stop, false);
      // DrawingCanvas.addEventListener("mouseup", stop, false);
      // DrawingCanvas.addEventListener("mouseout", stop, false);


      // function start(event) {
      //    is_drawing = true;
      //    context.beginPath();
      //    context.moveTo(
      //       event.clientX - DrawingCanvas.offsetLeft,
      //       event.clientY - DrawingCanvas.offsetTop
      //    );
      //    event.preventDefault();
      // }

      // function draw(event) {
      //    if (is_drawing) {
      //       context.lineTo(
      //          event.clientX - DrawingCanvas.offsetLeft,
      //          event.clientY - DrawingCanvas.offsetTop
      //       );

      //       context.strokeStyle = draw_color;
      //       context.lineWidth = draw_width;
      //       context.lineCap = "round";
      //       context.lineJoin = "round";
      //       context.stroke();
      //    }
      //    event.preventDefault();
      // }

      // function stop(event) {
      //    if (is_drawing) {
      //       context.stroke();
      //       context.closePath();
      //       is_drawing = false;
      //    }
      //    event.preventDefault();
      // }

      //

      $(document).ready(function () {
         $('form').submit(function (event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
               url: '/',
               type: 'POST',
               data: formData,
               dataType: 'json',
               success: function (response) {
                  $('#result').text(response.pred);
               },
               error: function (xhr, status, error) {
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

      // const avatarUpload = document.getElementById("avatar-upload");
      // avatarUpload.addEventListener("change", () => {
      //    const file = avatarUpload.files[0];
      //    const formData = new FormData();
      //    formData.append("avatar", file);
      //    fetch("/upload-avatar", {
      //       method: "POST",
      //       body: formData
      //    })
      //       .then(response => response.json())
      //       .then(data => {
      //          console.log(data.url); // this will be the URL of the saved PNG file
      //       });
      // });

      // Add shapes
      const DrawingCanvas = document.getElementById("canvas"),
      toolBtns = document.querySelectorAll(".tool"),
         fillColor = document.querySelector("#fill-color"),
         sizeSlider = document.querySelector("#size-slider"),
         colorBtns = document.querySelectorAll(".colors .option"),
         colorPicker = document.querySelector("#color-picker"),
         clearCanvas = document.querySelector(".clear-canvas"),
         saveImg = document.querySelector(".save-img"),
         ctx = DrawingCanvas.getContext("2d");

      // global variables with default value
      let prevMouseX, prevMouseY, snapshot,
         isDrawing = false,
         selectedTool = "brush",
         brushWidth = 5,
         selectedColor = "#000";

           DrawingCanvas.width = window.innerWidth - 60;
      DrawingCanvas.height = 600;

      const setCanvasBackground = () => {
         // setting whole canvas background to white, so the downloaded img background will be white
         ctx.fillStyle = "rgba(255, 255, 255, 0)";
         ctx.fillRect(0, 0, DrawingCanvas.width, DrawingCanvas.height);
         ctx.fillStyle = selectedColor; // setting fillstyle back to the selectedColor, it'll be the brush color
      }

      window.addEventListener("load", () => {
         // setting canvas width/height.. offsetwidth/height returns viewable width/height of an element
         DrawingCanvas.width = DrawingCanvas.offsetWidth;
         DrawingCanvas.height = DrawingCanvas.offsetHeight;
         setCanvasBackground();
      });

      const drawRect = (e) => {
         // if fillColor isn't checked draw a rect with border else draw rect with background
         if (!fillColor.checked) {
            // creating circle according to the mouse pointer
            return ctx.strokeRect(e.offsetX, e.offsetY, prevMouseX - e.offsetX, prevMouseY - e.offsetY);
         }
         ctx.fillRect(e.offsetX, e.offsetY, prevMouseX - e.offsetX, prevMouseY - e.offsetY);
      }

      const drawCircle = (e) => {
         ctx.beginPath(); // creating new path to draw circle
         // getting radius for circle according to the mouse pointer
         let radius = Math.sqrt(Math.pow((prevMouseX - e.offsetX), 2) + Math.pow((prevMouseY - e.offsetY), 2));
         ctx.arc(prevMouseX, prevMouseY, radius, 0, 2 * Math.PI); // creating circle according to the mouse pointer
         fillColor.checked ? ctx.fill() : ctx.stroke(); // if fillColor is checked fill circle else draw border circle
      }

      const drawTriangle = (e) => {
         ctx.beginPath(); // creating new path to draw circle
         ctx.moveTo(prevMouseX, prevMouseY); // moving triangle to the mouse pointer
         ctx.lineTo(e.offsetX, e.offsetY); // creating first line according to the mouse pointer
         ctx.lineTo(prevMouseX * 2 - e.offsetX, e.offsetY); // creating bottom line of triangle
         ctx.closePath(); // closing path of a triangle so the third line draw automatically
         fillColor.checked ? ctx.fill() : ctx.stroke(); // if fillColor is checked fill triangle else draw border
      }

      const startDraw = (e) => {
         isDrawing = true;
         prevMouseX = e.offsetX; // passing current mouseX position as prevMouseX value
         prevMouseY = e.offsetY; // passing current mouseY position as prevMouseY value
         ctx.beginPath(); // creating new path to draw
         ctx.lineWidth = brushWidth; // passing brushSize as line width
         ctx.strokeStyle = selectedColor; // passing selectedColor as stroke style
         ctx.fillStyle = selectedColor; // passing selectedColor as fill style
         // copying canvas data & passing as snapshot value.. this avoids dragging the image
         snapshot = ctx.getImageData(0, 0, DrawingCanvas.width, DrawingCanvas.height);
      }

      const drawing = (e) => {
         if (!isDrawing) return; // if isDrawing is false return from here
         ctx.putImageData(snapshot, 0, 0); // adding copied canvas data on to this canvas

         if (selectedTool === "brush" || selectedTool === "eraser") {
            // if selected tool is eraser then set strokeStyle to white 
            // to paint white color on to the existing canvas content else set the stroke color to selected color
            ctx.strokeStyle = selectedTool === "eraser" ? "#fff" : selectedColor;
            ctx.lineTo(e.offsetX, e.offsetY); // creating line according to the mouse pointer
            ctx.stroke(); // drawing/filling line with color
         } else if (selectedTool === "rectangle") {
            drawRect(e);
         } else if (selectedTool === "circle") {
            drawCircle(e);
         } else {
            drawTriangle(e);
         }
      }

      toolBtns.forEach(btn => {
         btn.addEventListener("click", () => { // adding click event to all tool option
            // removing active class from the previous option and adding on current clicked option
            document.querySelector(".options .active").classList.remove("active");
            btn.classList.add("active");
            selectedTool = btn.id;
         });
      });

      sizeSlider.addEventListener("change", () => brushWidth = sizeSlider.value); // passing slider value as brushSize

      colorBtns.forEach(btn => {
         btn.addEventListener("click", () => { // adding click event to all color button
            // removing selected class from the previous option and adding on current clicked option
            document.querySelector(".options .selected").classList.remove("selected");
            btn.classList.add("selected");
            // passing selected btn background color as selectedColor value
            selectedColor = window.getComputedStyle(btn).getPropertyValue("background-color");
         });
      });

      colorPicker.addEventListener("change", () => {
         // passing picked color value from color picker to last color btn background
         colorPicker.parentElement.style.background = colorPicker.value;
         colorPicker.parentElement.click();
      });

      clearCanvas.addEventListener("click", () => {
         ctx.clearRect(0, 0, DrawingCanvas.width, DrawingCanvas.height); // clearing whole canvas
         setCanvasBackground();
      });

      

      DrawingCanvas.addEventListener("mousedown", startDraw);
      DrawingCanvas.addEventListener("mousemove", drawing);
      DrawingCanvas.addEventListener("mouseup", () => isDrawing = false);


      var flipbackBtn = document.getElementById("flipback");
      var shirtImg = document.querySelector("#shirtDiv img");
      var frontImgSrc = "{{ url_for('static', filename='img/crew_front.png') }}";
      var backImgSrc = "{{ url_for('static', filename='img/crew_front.png') }}";
      var isFront = true;

      flipbackBtn.addEventListener("click", function () {
         if (isFront) {
            shirtImg.src = backImgSrc;
            isFront = false;
         } else {
            shirtImg.src = frontImgSrc;
            isFront = true;
         }
      });


   </script>
</body>

</html>