<?php
$zip = new ZipArchive;

$filePath = './test.docx';
$open = $zip->open($filePath);
if ($open === true) {
    $documentXml = $zip->getFromName('word/document.xml');
    $zip->close();

    echo $documentXml;
}