<?php

$xmlFilename = 'xl/sharedStrings.xml';
$zip = new ZipArchive;
$response = '';

$filePath = './test.xlsx';
$open = $zip->open($filePath);
if ($open === true) {
    if (($xmlIndex = $zip->locateName($xmlFilename)) !== false) {
        $doc = new DOMDocument;
        $xml = $zip->getFromIndex($xmlIndex);
        $doc->loadXML($xml, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
        $response = strip_tags($doc->saveXML());
        echo $response;
    }
    $zip->close();
}
