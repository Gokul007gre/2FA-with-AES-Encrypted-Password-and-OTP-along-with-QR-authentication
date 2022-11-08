<?php
$q = $_GET['q'];
$con = mysqli_connect('localhost','root','Gokul010#');
if (!$con) {
  echo"enter a valid input";
}
else{
 mysqli_select_db($con,"time_table");
$sql="SELECT * FROM time_table WHERE Sem='".$q."'";
$result = mysqli_query($con,$sql);
echo "<table>
<tr>
<th>SI.No</th>
<th style='width: 100px;'>Class Group</th>
<th>Course<br>Code</th>
<th style='width: 150px;'>Course Title</th>
<th>Course<br>Type</th>
<th style='width:35px;'>L T P J C</th>
<th>Class Id</th>
<th style='width: 180px;'>Course Mode</th>
<th>Slot</th>
<th>Attendance<br>Type</th>
<th>Venue</th>
<th>Registered<br>Students</th>
</tr>";
$i=1;
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $i. "</td>";
  echo "<td>" . $row['class_grp'] . "</td>";
  echo "<td>" . $row['course_code'] . "</td>";
  echo "<td>" . $row['course_title'] . "</td>";
  echo "<td >" . $row['course_type'] . "</td>";
  echo "<td style='padding:10px;'>" . $row['l_t_p_j_c'] . "</td>";
  echo "<td>" . $row['course_id'] . "</td>";
  echo "<td>" . $row['course_mode'] . "</td>";
  echo "<td>" . $row['Slot'] . "</td>";
  echo "<td>" . $row['Attendance_type'] . "</td>";
  echo "<td>" . $row['Venue'] . "</td>";
  echo "<td>" . $row['Registered_students'] . "</td>";
  echo "</tr>";
  $i++;
}
echo "</table>";
mysqli_close($con);
}

?>
