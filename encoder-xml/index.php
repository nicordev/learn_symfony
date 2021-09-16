<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Serializer\Encoder\XmlEncoder;

define('SCRIPT_NAME', array_shift($argv));
define('FUNCTION_NAME', array_shift($argv));

function _readXml(string $xmlContent) {
    $xmlEncoder = new XmlEncoder();

    return $xmlEncoder->decode($xmlContent, 'xml');
}

function _readXmlFile(string $xmlFilePath) {
    $content = file_get_contents($xmlFilePath);

    return _readXml($content);
}

function printXml(string $xmlContent = null) {
    if (empty($xmlContent)) {
        echo "php ".SCRIPT_NAME." ".FUNCTION_NAME." xmlContentHere\n";

        return 1;
    }

    printArray(_readXml($xmlContent));
}

function printXmlFile(string $xmlFilePath = null) {
    if (empty($xmlFilePath)) {
        echo "php ".SCRIPT_NAME." ".FUNCTION_NAME." xmlFileHere\n";

        return 1;
    }

    printArray(_readXmlFile($xmlFilePath));
}

function var_export_short_array_syntax($var, $indent="") {
    switch (gettype($var)) {
        case "string":
            return '"' . addcslashes($var, "\\\$\"\r\n\t\v\f") . '"';
        case "array":
            $indexed = array_keys($var) === range(0, count($var) - 1);
            $r = [];
            foreach ($var as $key => $value) {
                $r[] = "$indent    "
                     . ($indexed ? "" : var_export_short_array_syntax($key) . " => ")
                     . var_export_short_array_syntax($value, "$indent    ");
            }
            return "[\n" . implode(",\n", $r) . "\n" . $indent . "]";
        case "boolean":
            return $var ? "true" : "false";
        default:
            return var_export($var, true);
    }
}

function printArray(array $items) {
    echo var_export_short_array_syntax($items);
}

function _getScriptContent() {
    return file_get_contents(__DIR__.'/'.SCRIPT_NAME);
}

function howItWorks() {
    echo _getScriptContent();
}

function _listFunctions() {
    $content = _getScriptContent();
    $functions = [];
    preg_match_all('#function ([a-z]{1}[a-zA-Z0-9]*)\(#', $content, $functions);
    echo implode("\n", $functions[1])."\n";
}

if ($argc <= 1) {
    _listFunctions();
    exit;
}

call_user_func_array(FUNCTION_NAME, $argv);