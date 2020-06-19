<?php
namespace Sangbog;

require 'base.php';

$trans = array("\t" => "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");

$stmt = $pdo->prepare("SELECT * FROM sang WHERE id = ?");
$stmt->execute([$_GET['song_id']]);
$row = $stmt->fetch();
//print_r($row);
$data = $row;
$data['sang'] = strtr(nl2br($row['sang']), $trans);




echo $twig->render('show.html', $data);

/*
//echo $db->f('nr')." ".$db->f('dur')."<br><br>";
if($db->f('ref'))
  echo "Findes p&aring; Gr&oslash;nlandsk/Dansk <a href=\"vis_sang.php?song_id=".$db->f('ref')."\">her</a><br>";
if($db->f('dur') != "")
  echo "Dur: ".$db->f('dur')."<br><br>";
echo nl2br($db->f('melodi'))."<br><br>";
echo strtr(nl2br($db->f('sang')),$trans)."<br><br>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
     nl2br($db->f('forfatter'));

*/
