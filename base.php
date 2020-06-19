<?php
use Twig\Lexer;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

require 'vendor/autoload.php';
include 'db.php';

//error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);

$pdo = getPDO();

$loader = new FilesystemLoader('views');
$twig = new Environment($loader, [
    'debug' => true,
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$lexer = new Lexer($twig, [
//    'tag_block'    => ['{','}'],
    'tag_variable' => ['{{','}}']
]);

$twig->setLexer($lexer);

$data = [];
