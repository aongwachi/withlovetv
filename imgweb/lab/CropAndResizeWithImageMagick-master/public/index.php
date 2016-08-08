<!DOCTYPE html>
<html>
 <head>
  <title>Upload Image</title>
 </head>
 <body>
  <h1>Upload Image</h1>
  <form action="upload.php" method="post" enctype="multipart/form-data">
   <label for="file">Image:</label>
   <input type="file" name="file" id="file"><br>
   <input type="submit" name="submit" value="Upload and Crop">
  </form>
 </body>
</html>
