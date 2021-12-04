<?php

$zip = new ZipArchive;
$response = '';

$filePath = './test.pptx';
$open = $zip->open($filePath);

if ($open === true) {
    $slideNumber = 1; //loop through slide files
    $doc = new DOMDocument;
    while (($xmlIndex = $zip->locateName('ppt/slides/slide' . $slideNumber . '.xml')) !== false) {
        $xmlData   = $zip->getFromIndex($xmlIndex);
        $doc->loadXML($xmlData, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
        $response  .= strip_tags($doc->saveXML());
        $slideNumber++;
    }
    $zip->close();
}

echo $response;
