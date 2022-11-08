<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="./style.css">
    <link href="./dist/output.css" rel="stylesheet">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body class="w-full h-full">
    <div class="relative h-screen">
    <img src="./img/rm373batch4-15.jpg" alt="" class="object-cover w-full min-h-full">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="box-content absolute items-center inset-0 mx-auto py-5 h-full bg-white rounded-lg border-2 border-purple-600">
        
     <form action="loginqr.php" method="post">
     <div class="mx-auto space-y-3 justify-center text-center mb-3">
     	<h2 class="font-semibold text-4xl">QR LOGIN</h2>
    </div>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
                <video class="mx-auto embed-responsive-16by9"id="preview" width="1080" height="500"></video>
                <div>
                   <form method="post" class="form-horizontal">
                    <input type="text" name="qrcode_text" id="text" readonyy="" class="form-control" style="display:none">
                   </form>
               
                <div class="mx-auto space-y-3 justify-center text-center mt-5 mb-3">
                <label Id="succ" style="display:none">QR is scanned Press login button for verifying the credentials..</label>
     	<button class="px-7 border-2 rounded-lg border-purple-600 hover:bg-purple-600 hover:text-white transition-all" type="submit">LOGIN</button>
        </div>
        </div>
     	</div>
            
     </form>
     </div>
        </div>
             <script>
           let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
           Instascan.Camera.getCameras().then(function(cameras){
               if(cameras.length > 0 ){
                   scanner.start(cameras[0]);
               } else{
                   alert('No cameras found');
               }

           }).catch(function(e) {
               console.error(e);
           });
           scanner.addListener('scan',function(c){
               document.getElementById('text').value=c;
               document.getElementById("succ").style.display="block";
           });

        </script>
</body>
</html>