
<?php

include 'filesLogic.php';

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body>
  <section class="section">
    <div class="container">
       
       


      <div class="file is-centered is-boxed is-success has-name">
  <h1 class="title">
        Upload File
      </h1>
      </div>
      <br><br>

        <!-- -->
          <form action="index.php" method="post" enctype = "multipart/form-data">
        
        <div class="field">
  <div class="file is-centered is-boxed is-success has-name">
    <label class="file-label">
      <input class="file-input" type="file" name="myfile">
      <span class="file-cta">
        <span class="file-icon">
          <i class="fas fa-upload"></i>
        </span>
        <span class="file-label">
          Centered file…
        </span>
      </span>
      <span class="file-name">
        Screen Shot 2017-07-29 at 15.54.25.png
      </span>
      <br><br>
      <button class="button is-link is-rounded" name="save" type="submit">Upload</button>
       
    </label>
  </div>
</div>
        
        </form>  
       <!--  -->
    </div>

    <div class="table-container">
  <table class="table">
    <thead>
    <th>ID</th>
    <th>FileName</th>
    <th>Size (in mb)</th>
    <th>Downloads</th>
    <th>Action</th>
    </thead>

<tbody>

<?php foreach($files as $file) : ?>

<tr>
    <td> <?php echo $file['id']; ?> </td>
    <td> <?php echo $file['name']; ?> </td>
    <td> <?php echo $file['size']; ?> </td>
    <td> <?php echo $file['downloads']; ?> </td>
    <td> 
    <a href="index.php?file_id=<?php echo $file['id'] ?> ">Download</a>
     </td>

</tr>

<?php endforeach; ?>

</tbody>

  </table>
</div>

  </section>
  </body>
</html>