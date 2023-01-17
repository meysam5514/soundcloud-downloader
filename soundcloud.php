<?php
error_reporting(false);
header('Content-type: application/json;');
$kobsurl = $_GET['url'];

$ch = curl_init();
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
curl_setopt($ch, CURLOPT_URL,"https://www.klickaud.co/");
curl_setopt($ch,CURLOPT_AUTOREFERER,1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
$meysam1= curl_exec($ch);
curl_close($ch);
////////////////////////////////////////////
preg_match_all('#<input type="hidden" value=(.*?) name=(.*?)>#',$meysam1,$sidepath1);

$data['value']="$kobsurl";
$data[$sidepath1[2][0]]=$sidepath1[1][0];
///////////////////////////////////////////
$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_POST, true);
curl_setopt($ch1, CURLOPT_POSTFIELDS,$data);
curl_setopt($ch1, CURLOPT_URL,"https://www.klickaud.co/download.php");
curl_setopt($ch1,CURLOPT_AUTOREFERER,1);
curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch1, CURLOPT_HEADER, true);
$meysam2= curl_exec($ch1);
curl_close($ch1);

preg_match_all("#<td class='(.*?)'><img src=(.*?) style='(.*?)'></td>#",$meysam2,$sidepath2);//img=$sidepath2[2][0];
preg_match_all("#downloadFile((.*?),(.*?));#",$meysam2,$sidepath3);//down=$sidepath3[2][0];name=$sidepath3[3][0];

$red=str_replace("('","",$sidepath3[2][0]);
$red1=str_replace("')","",$red);
$red2=str_replace("'","",$red1);

$reb=str_replace("('","",$sidepath3[3][0]);
$reb1=str_replace("')","",$reb);
$reb2=str_replace("'","",$reb1);

$da =['tag'=>$reb2 , 'image' => $sidepath2[2][0] , 'url' => $red2];


echo json_encode(['ok' => true, 'channel' => '@SIDEPATH','writer' => '@meysam_s71','Results' =>$da], 448);














