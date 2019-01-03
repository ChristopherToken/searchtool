<?php
//fetch.php
$count = 0;
if(isset($_POST["query"]))
{
 $connect = mysqli_connect("localhost", "root", "root", "testing");
 $request = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM tbl_employee 
  WHERE preacher_name LIKE '%".$request."%' 
  OR sermon_title LIKE '%".$request."%' 
  OR sermon_date  LIKE '%".$request."%'
  ORDER BY sermon_date DESC
 ";
 $result = mysqli_query($connect, $query);
 $data =array();
 $html = '';
 $html .= '
  <table class="table table-bordered table-striped">
   <tr>
    <th>Preacher Name</th>
    <th>Title</th>
    <th>Sermon</th>
    <th>Date<th>
   </tr>
  ';
 if(mysqli_num_rows($result) > 0) {
  while($count < 6 && $row = mysqli_fetch_array($result)) {
   $data[] = $row["preacher_name"];
   $data[] = $row["sermon_title"];
   $data[] = $row["sermon_file"];
   $data[] = $row["sermon_date"];
   $html .= ' 
   <tr>
    <td>'.$row["preacher_name"].'</td>
    <td>'.$row["sermon_title"].'</td>
    <td><audio controls>
    <source src="/images/$row["sermon_file.mp3"]" type="audio/ogg">
    <source src="/images/take.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
    </audio></td>
    <td>'.$row["sermon_date"].'</td>
   </tr>
  ';
  $count++ ;
  }
 } else {
  $data = 'No Data Found';
  $html .= '
   <tr>
    <td colspan="3">No Data Found</td>
   </tr>
   ';
 }
 $html .= '</table>';
 if (isset($_POST['typehead_search']))
 {
  echo $html;
 } else {
  $data = array_unique($data);
  echo json_encode($data);
 }
}

?>