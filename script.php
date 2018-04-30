<?php

/**
 * @name    script.php
 *
 * @desc    uploading an XML file then using foreach loops to push child nodes into an associative array,
 *          then turning the array into an object using stdClass class, then looping through the resulting array
 *          key/value pairs, converting every sub-array into an object.
 *
 *
 *@note     for full disclosure, this is my first foray into xml to php conversion without json_encode.
 *          Would like the opportunity to learn more. Quick leaner too.
 *
 *
 */

    $xmlFile = 'code.xml';

    $priip = simplexml_load_file($xmlFile);

if (!false==$xmlFile) {


    $root = [];

    array_push($root, $priip);

    foreach ($priip->children() as $data) {

        $dataChildren = [];

        foreach ($data->children() as $child) {

            array_push($dataChildren, $child);

        }


        function convertToObject($array)
        {
            $object = new stdClass();
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $value = convertToObject($value);
                }
                $object->$key = $value;
            }
            return $object;
        }


        echo "This is the XML file in Object notation: <br>";
        echo "<pre>";
        print_r(convertToObject($root));
        echo "</pre>";


    }
}//is_valid
