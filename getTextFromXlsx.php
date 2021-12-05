<?php



function getTextFromXlsx(string $filePath): string
{
    $zip = new ZipArchive;
    $response = '';

    $open = $zip->open($filePath);
    if ($open === true) {
        $sharedStringsXml = $zip->locateName('xl/sharedStrings.xml');
        if ($sharedStringsXml) {
            $domDocument = new DOMDocument;
            $xml = $zip->getFromIndex($sharedStringsXml);
            $domDocument->loadXML($xml, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            $response .= strip_tags($domDocument->saveXML());
        }
        $zip->close();
    }

    return $response;
}

echo getTextFromXlsx('./test.xlsx');