<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PENGONDISIAN</title>
</head>

<body>
  <p>Contoh Pengkondisian IF ELSE dengan menggunakan tabel</p>
  <table border="1" cellpadding="10" cellspacing="0">
    <?php 
        //Ini merupakan for untuk baris <tr>
        for( $i = 1; $i <= 5 ; $i++){
          if( $i % 2 == 0) {  //JIka tr dibagi 2 hasilnya 0, maka dia akan berwarna hitam.
            echo "<tr class= warna-baris>"; //tr kita berikan warna hitam jika dia genap
          }
          else{
          echo"<tr></tr>";
          }
          //Di dalam for, kita melakukan perulangan for untuk kolom
          for( $j = 1; $j <= 5; $j++){
            echo "<td>$i,$j</td>"; //$j merupakan kolom
          }
          echo"</tr>";
          }
      ?>
</body>

</html>