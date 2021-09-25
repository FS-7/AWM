<?php
$conn = mysqli_connect("localhost", "root", "", "awm");
$q = mysqli_query($conn, "SELECT `name`, `phone_no` FROM `mechanic`");
$q2 = mysqli_query($conn, "select 'rating' from feedback");

while ($row= mysqli_fetch_array($q)) {
    $name = $row['name'];
    $phone_no = $row['phone_no'];    
}
while ($row2= mysqli_fetch_array($q2)) {
    echo $row2['rating'];
}
echo "<table border='2px'><tr><td>";
echo $name."</td><td>".$phone_no;
echo "</td></tr></table>";

?>