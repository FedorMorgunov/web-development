<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <?php include 'navbar.php'; ?>
   <title>User Registration</title>
   <style>
       body {
           background-image: url('arcade-unsplash.jpg');
           background-repeat: no-repeat;
           background-attachment: fixed;
           background-size: 100% 100%;
           color: #fff;
       }
   </style>
</head>
<body>
   <div class="container">
       <h1>User Registration</h1>
       <form method="post" action="cookies.php">
           <div class="form-group">
               <label for="username" class="col-form-label">Username/nickname:</label>
               <input type="text" id="username" name="username" class="form-control" required pattern="[^!@#%&*()+=^{}\[\]\-;:'<>\?\/]+">
               <small class="form-text text-muted">Invalid characters: ! @ # % & * ( ) + = ˆ { } [ ] — ; : “ ’ &lt; &gt; ? /</small>
           </div>
		<h1>Avatar Selection</h1>
           <div class="form-group">
               <label for="eyes" class="col-form-label">Eyes:</label>
               <select id="eyes" name="eyes" class="form-control">
                   <option value="laughing">Laughing</option>
                   <option value="closed">Closed</option>
                   <option value="long">Long</option>
                   <option value="normal">Normal</option>
                   <option value="rolling">Rolling</option>
                   <option value="winking">Winking</option>
               </select>
           </div>
           <div class="form-group">
               <label for="mouth" class="col-form-label">Mouth:</label>
               <select id="mouth" name="mouth" class="form-control">
                   <option value="open">Open</option>
                   <option value="sad">Sad</option>
                   <option value="smiling">Smiling</option>
                   <option value="straight">Straight</option>
                   <option value="surprise">Surprise</option>
                   <option value="teeth">Teeth</option>
               </select>
           </div>
           <div class="form-group">
               <label for="skin" class="col-form-label">Skin:</label>
               <select id="skin" name="skin" class="form-control">
                   <option value="green">Green</option>
                   <option value="red">Red</option>
                   <option value="yellow">Yellow</option>
               </select>
           </div>
           <input type="submit" value="Register" class="btn btn-primary btn-block">
       </form>
   </div>
</body>
</html>