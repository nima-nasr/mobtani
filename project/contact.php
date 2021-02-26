<?php

// 1. connect to DB - mysql - mysqli - PDO
$dbc = new mysqli('sql200.b6b.ir', 'b6bi_27935330', '09130229960', 'b6bi_27935330_999'); // mysqli_connect
// 2. create insert query
//$sql = "INSERT INTO message(title, body)
//		VALUES('my title', 'متن پیام')";
$sql = "INSERT INTO message(title, body)
		VALUES('{$_POST['title']}', '{$_POST['body']}')";
//echo $sql . '<br>';
// 3. execute query
$result = $dbc -> query( $sql ); // mysqli_query
// 4. close connection
$dbc -> close(); //mysqli_close

echo 'پیام با موفقیت ثبت شد';
?>