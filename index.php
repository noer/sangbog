<?php
namespace Sangbog;

require 'base.php';

$st = '%';
if(isset($_POST['search']) && isset($_POST['search_text'])) {
    $st = '%'.$_POST['search_text'].'%';
}

$stmt = $pdo->prepare('SELECT id,nr,sang FROM sang WHERE sang LIKE ?');
$stmt->execute([$st]);
while ($row = $stmt->fetch()) {
    $sp = explode("\n", $row['sang']);
    $title = trim($sp[0]);
    if(substr($title, -1) == ',')
        $title = substr($title, 0, -1);
    $data['songs'][] = [
        'id' => $row['id'],
        'nr' => $row['nr'],
        'title' => $title
    ];
}
echo $twig->render('index.html', $data);
