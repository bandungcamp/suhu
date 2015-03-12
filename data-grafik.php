<?php
include("koneksi.php");
	$hariini		= date("Y-m-d");
	$sql1 			= "SELECT id, UNIX_TIMESTAMP(waktu) as waktu, suhu from templog order by waktu desc, id asc limit 0, 20";
	$hasil	 		= mysql_query($sql1);
	if(mysql_num_rows($hasil) > 0)
	{
		while($row = mysql_fetch_array($hasil))
                {
				   $id 	= $row[0];
				   $x 	= $row[1] * 1000;
				   $y 	= $row[2];
                   $ret[] = array("id" => $id, "x" => $x, "y" => $y);
                }
	}	
	usort($ret, function($a, $b) {
		return $a['id'] - $b['id'];
	});
echo str_replace('"','',json_encode($ret));
?>
