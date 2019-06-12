
<html>
<head>
	<title>Logs</title>
	<link rel="stylesheet" href="design/logs.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
</head>
<body>

<?php 

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,"http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=004D");
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$data = curl_exec($ch);
curl_close($ch);
$data_tab = str_split($data,33);
// echo "<table>
//   <tr>
//     <th>Trame</th>
//     <th>Objet</th> 
//     <th>Capteur</th>
//     <th>Numéro</th>
//     <th>Valeur</th>
//     <th>Date</th>
//   </tr>";
$size=count($data_tab);
for($i=$size-30;  $i<$size-1; $i++) {
$trame = $data_tab[$i];

// décodage avec sscanf
list($t, $o, $r, $c, $n, $v, $a, $x, $year, $month, $day, $hour, $min, $sec) =
sscanf($trame,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
// echo("
//   <tr>
//     <td>$i</td>
//     <td>$o</td> 
//     <td>$c</td>
//     <td>$n</td>
//     <td>$v</td>
//     <td>$day/$month/$year $hour:$min:$sec</td>
//   </tr>
// ");

if ($c == 3) { //température
	$val = round((hexdec($v)*3.3)/(4095*0.01));
	getTempLog($val);
}

if ($c == 1) { //distance
	$val = hexdec($v);
	if ($val > 2000) {
		$val = 1;
	}
	else {
		$val = 0;
	}
}

if ($c == 5) { //luminosite
	$val = hexdec($v);
	if ($val > 2000) {
		$val = 1;
	}
	else {
		$val = 0;
	}

}

}
echo "</table>";

?>