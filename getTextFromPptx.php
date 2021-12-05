<?php

function getTextFromPptx(string $filePath): string
{
    $zip = new ZipArchive;
    $response = '';

    $open = $zip->open($filePath);

    if ($open === true) {
        $slideNumber = 1;
        $doc = new DOMDocument;
        while (($xmlIndex = $zip->locateName('ppt/slides/slide' . $slideNumber . '.xml')) !== false) {
            $xmlData   = $zip->getFromIndex($xmlIndex);
            $doc->loadXML($xmlData, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            $response .= strip_tags($doc->saveXML());
            $slideNumber++;
        }
        $zip->close();
    }

    return $response;
}

echo getTextFromPptx('./test.pptx');
