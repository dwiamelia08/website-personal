<?php
//fetch.php
include '../koneksi.php';
$request = mysqli_real_escape_string($koneksi, $_POST["query"]);
$query = "
 SELECT * FROM user WHERE nim LIKE '%".$request."%'
";

$result = mysqli_query($koneksi, $query);

$data = array();

if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
  $data[] = $row["nim"];
 }
 echo json_encode($data);
}

?>