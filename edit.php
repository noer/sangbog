<?php
namespace Sangbog;

require 'base.php';

function redir() {
    if($_SERVER['HTTP_REFERER'] != "")
        $ref = $_SERVER['HTTP_REFERER'];
    else
        $ref = 'index.php';
    header('Location: '.$ref);
    exit();
}

if(isset($_POST['sub'])) {
    $ok = $_POST['ok'] == 'Y' ? 'Y' : 'N';

    if($_POST['ref']) {
        $stmtref = $pdo->prepare("SELECT id FROM sang WHERE id = ?");
        $stmtref->execute([$_POST['ref']]);
        $row = $stmt->fetch();

        $ref = $row['id'];
    }
    else {
        $ref = $_POST['ref_id'];
    }

    $melodi = trim($_POST['melodi']);
    $sang = rtrim($_POST['sang']);
    $forfatter = trim($_POST['forfatter']);
    $kommentar = trim($_POST['kommentar']);
    $stmtupd = $pdo->prepare(
            "UPDATE sang SET dur=?, ref=?, melodi=?, sang=?, forfatter=?, kommentar=?, ok=? WHERE id = ?");
    $stmtupd->execute([
            $_POST['dur'],
	        $ref,
	        $melodi,
	        $sang,
            $forfatter,
            $kommentar,
	        $ok,
            $_POST['id']]);

    redir();
}
if($_POST['song_id'])
    $song_id = $_POST['song_id'];
elseif($_GET['id'])
    $song_id = $_GET['id'];
else
    redir();

$stmt = $pdo->prepare("SELECT * FROM sang WHERE id = ?");
$stmt->execute([$song_id]);
$row = $stmt->fetch();
$data = $row;

echo $twig->render('edit.html', $data);
