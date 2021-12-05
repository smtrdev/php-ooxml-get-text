<?php

function getTextFromDocx(string $filePath) {
    $zip = new ZipArchive;
    $result = '';

    if ($zip->open($filePath) === true) {
        $documentXml = $zip->getFromName("word/document.xml");
        if ($documentXml) {
            $domDocument = new DOMDocument();
            $domDocument->loadXML($documentXml);
            $paragraphs = $domDocument->getElementsByTagName("p");
            /** @var DOMNode $paragraph */
            foreach ($paragraphs as $paragraph) {
                $result .= $paragraph->textContent;
            }
        }
    }
}

getTextFromDocx('./test.docx');
