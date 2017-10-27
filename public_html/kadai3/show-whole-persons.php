<?php
  // データ定義
  $persons = array(
    "torachan" => array("name" => "Masayuki Torai",    "age" => 34, "gender" => "male"),
    "takochan" => array("name" => "Takoshi Yotsuashi", "age" => 33, "gender" => "male"),
    "tamochan" => array("name" => "Yuji Tamoyama",     "age" => 33, "gender" => "male"),
    "izumin"   => array("name" => "Takato Izumikawa",  "age" => 32, "gender" => "male"),
    "momocchi" => array("name" => "Yuichi Ogawa",      "age" => 29, "gender" => "male")
  );
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>第3回 課題2(2)</title>
  </head>

  <body>
    <table>
      <tr>
        <th>ニックネーム</th>
        <th>氏名</th>
        <th>年齢</th>
        <th>性別</th>
      </tr>
    	<?php
        // tableタグの中身を作成
        foreach ($persons as $key => $value) {
          $table_html .= "<tr>".
                            "<td>".$key."</td>".
                            "<td>".$value["name"]."</td>".
                            "<td>".$value["age"]."</td>".
                            "<td>".$value["gender"]."</td>".
                          "</tr>";
        }
        echo($table_html);
    	?>
    </table>
  </body>
</html>