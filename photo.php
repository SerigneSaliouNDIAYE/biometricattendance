<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>LiveCapture</title>
	<link rel="stylesheet" type="text/css" href="css/photo.css"/>
    <style type="text/css">
	
        h2, h3 { margin-top:0; }
        form { margin-top: 15px; }
        form > input { margin-right: 15px; }
        #results { float:right; margin:20px; padding:20px; border:1px solid; background:#ccc; }
    </style>
</head>
<body class="zal">
    <div id="results">Votre image apparaitra ici...</div>
    
    <h1>Capture Web camera image using WebcamJS and PHP</h1>
    <div id="my_camera"></div>
    
    <!-- First, include the Webcam.js JavaScript Library -->
    
    <!-- Configure a few settings and attach camera -->
    
    <!-- A button for taking snaps -->
    <form class="navtop">
        <input type=button value="Take Snapshot" onClick="take_snapshot()">
		<a href="ManageUsers.php">Retour</a>
    </form>
    
    <!-- Code to handle taking the snapshot and displaying it locally -->
    <script src="webscript.js"></script>

    	<!-- First, include the Webcam.js JavaScript Library -->
    	<script type="text/javascript" src="webcam.min.js"></script>
    	<script type="text/javascript" src="script.js"></script>
    	
    	<!-- Configure a few settings and attach camera -->
    <script language="JavaScript">
    		Webcam.set({
    			width: 400,
    			height: 300,
    			image_format: 'jpeg',
    			jpeg_quality: 90
    		});
    		Webcam.attach( '#my_camera' );
    		
    		var shutter = new Audio();
    		shutter.autoplay = false;
    		shutter.src ='shutter.mp3';
    		
    		function take_snapshot() {
    			// take snapshot and get image data
    			Webcam.snap( function(data_uri) {
    				// display results in page
    				document.getElementById('results').innerHTML = 
    					'<h2>Voici votre image:</h2>' + 
    					'<img src="'+data_uri+'"/>';
    					Webcam.upload( data_uri, 'saveimage.php', function(code, text) {
    						alert(data_uri);
    					});
    			} );

    		}
    		
    	</script> 
		
 
</body>
</html>