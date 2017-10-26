<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>課題index</title>
    
  </head>

    <body>
    
    <ul>
    <?php
      foreach(glob('kadai*/{*.php}',GLOB_BRACE) as $file){
        if(is_file($file)){
          echo '<li><a href="'.htmlspecialchars($file).'" target="_blank">'.htmlspecialchars($file).'</a></li>';
        }
      }
    ?>
    </ul>

  </body>
</html>

