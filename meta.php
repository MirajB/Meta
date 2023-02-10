<?php
class Meta {
    public function get_files($directory) {
        // Get all files in the directory
        $files = scandir($directory);
        // Count the number of files
        $file_count = count($files) - 2;
        // Print the number of files
        echo "Number of files: " . $file_count . "\n";
        // Loop through each file
        foreach ($files as $key => $file) {
            // Skip the current and parent directory entries
            if ($file === "." || $file === "..") {
                continue;
            }
            // Get the file type
            $file_type = filetype($directory . "/" . $file);
            // Get the file size
            $file_size = filesize($directory . "/" . $file);
            // Get the file creation time
            $file_ctime = filectime($directory . "/" . $file);
            // Get the file modification time
            $file_mtime = filemtime($directory . "/" . $file);
            // Print the file information
            echo "<pre>";
            echo "File name: " . $file . "\n";
            echo "File type: " . $file_type . "\n";
            echo "File size: " . $file_size . " bytes\n";
            echo "Creation time: " . date("Y-m-d H:i:s", $file_ctime) . "\n";
            echo "Modification time: " . date("Y-m-d H:i:s", $file_mtime) . "\n\n";
            // echo "</span>";
            echo "</pre>";
            if ($file_type == "dir") {
                $new_directory = $directory . "\\" . $file;
                echo "sub directory";
                echo "<br>";
                echo $new_directory;
                echo "<br>";
                $meta = new Meta($new_directory);
                $meta->get_files($new_directory);
            }
        }
    }
}
if (isset($_POST["submit"])) {
    if (empty($_POST["path"])) {
        die("please select a folder path");
    }
    $directory = $_POST["path"];
    $meta = new Meta($directory);
    $meta->get_files($directory);
}
?>


<?php if ($_SERVER["REQUEST_METHOD"] == "GET"): ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Folder Meta info</h2>
  <form action="meta.php" method="post">
    <div class="form-group">
      <label for="text">Path:</label>
      <input type="text" class="form-control" id="path" placeholder="Enter path" name="path">
    </div>
   
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>

<?php
endif; ?>
