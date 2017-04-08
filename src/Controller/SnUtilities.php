<?php

/**
 * UserFrosting (http://www.srinivasnukala.com)
 * @link      https://github.com/ssnukala/ufsprinkle-sndbforms
 * @copyright Copyright (c) 2013-2016 Srinivas Nukala
 **/

namespace UserFrosting\Sprinkle\SnUtilities\Controller;

use Carbon\Carbon;
use UserFrosting\Sprinkle\Core\Controller\SimpleController;
use UserFrosting\Support\Exception\ForbiddenException;
use UserFrosting\Sprinkle\Core\Util\EnvironmentInfo;

class SnUtilities extends SimpleController {

    public static function echobr($par_str) {
        echo("<br>$par_str<br>");
        error_log("$par_str \n");
    }

    public static function echoarr($par_arr, $par_comment = 'none') {
        if ($par_comment != 'none')
            echobr($par_comment);
        echo "<pre>";
        print_r($par_arr);
        echo "</pre>";
        error_log("<pre>$par_comment \n" .
                print_r($par_arr, true) . " \n\n </pre>");
    }

    public static function logarr($par_arr, $par_comment = 'none') {
        error_log("<pre>$par_comment \n" .
                print_r($par_arr, true) . " \n\n </pre>");
    }

    public static function roundPrice($par_price, $par_precision = 1) {
        if (is_numeric($par_price))
            $var_price = round($par_price / 1000, 1) * 1000;
        else
            $var_price = $par_price;
        return $var_price;
//    return round($par_price / $par_precision, 1) * $par_precision;
//    return round($par_price);
    }

    public static function valueIfSet($par_arr, $par_value, $par_default = '') {
        return isset($par_arr[$par_value]) ? $par_arr[$par_value] : $par_default;
    }

    public static function valueIfSeti($par_arr, $par_key, $par_default = '') {
        if (isset($par_arr[$par_key])) {
            return $par_arr[$par_key];
        } else if (isset($par_arr[strtolower($par_key)])) {
            return $par_arr[strtolower($par_key)];
        } else
            return $par_default;
    }

    public static function valueIfNotNull($par_arr, $par_value, $par_default = '') {
        return (isset($par_arr[$par_value]) && $par_arr[$par_value] != '') ? $par_arr[$par_value] : $par_default;
    }

    public static function assignIfNullZero($par_val, $par_assign) {
        if ($par_val === 0 || $par_val == '')
            $par_val = $par_assign;
        return $par_val;
    }

    public static function multisort($array, $sort_by) {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $evalstring = '';
                foreach ($sort_by as $sort_field) {
                    $tmp[$sort_field][$key] = $value[$sort_field];
                    $evalstring .= '$tmp[\'' . $sort_field . '\'], ';
                }
            }
            $evalstring .= '$array';
            $evalstring = 'array_multisort(' . $evalstring . ');';
            eval($evalstring);
        }
        return $array;
    }

    public static function getLookupOptions($lookup_cat, $match_type = '=', $par_where = '') {
        // Return array of JS includes
        switch ($match_type) {
            case "=":
                $cur_lookup_values_full = \UserFrosting\FormFields\CDLookup::getLookupValues($lookup_cat);
                $cur_lookup_values = $cur_lookup_values_full[$lookup_cat];
                break;
            default:
                $cur_lookup_values = \UserFrosting\FormFields\CDLookup::getLookupValues($lookup_cat, $match_type);
                break;
        }
//echoarr($cur_lookup_values);        
        return $cur_lookup_values;
    }

    public static function getLookupOptionsList($lookup_cat, $match_type = '=', $par_where = '') {
        // Return array of JS includes
        switch ($match_type) {
            case "=":
                $cur_lookup_values_full = \UserFrosting\FormFields\CDLookup::getLookupValuesList($lookup_cat);
                $cur_lookup_values = $cur_lookup_values_full[$lookup_cat];
                break;
            default:
                $cur_lookup_values = \UserFrosting\FormFields\CDLookup::getLookupValuesList($lookup_cat, $match_type);
                break;
        }
//echoarr($cur_lookup_values);        
        return $cur_lookup_values;
    }

    public static function getLookupOptionsList2($lookup_cat, $match_type = '=', $par_where = '') {
        // Return array of JS includes
        switch ($match_type) {
            case "=":
                $cur_lookup_values_full = \UserFrosting\FormFields\CDLookup::getLookupValuesList2($lookup_cat);
                $cur_lookup_values = $cur_lookup_values_full[$lookup_cat];
                break;
            default:
                $cur_lookup_values = \UserFrosting\FormFields\CDLookup::getLookupValuesList2($lookup_cat, $match_type);
                break;
        }
//echoarr($cur_lookup_values);        
        return $cur_lookup_values;
    }

    public static function getRequestData($request) {
        // Load the request schema
        $params = $request->getQueryParams();
        return $params;
    }

    public static function getPostData($request, $schemaname) {
        // Get POST parameters: name, slug, icon, description
        $params = $request->getParsedBody();

        /** @var UserFrosting\Sprinkle\Account\Authorize\AuthorizationManager */
        $authorizer = $this->ci->authorizer;

        /** @var UserFrosting\Sprinkle\Account\Model\User $currentUser */
        $currentUser = $this->ci->currentUser;

        // Access-controlled page
        if (!$authorizer->checkAccess($currentUser, 'datatable_data')) {
            throw new ForbiddenException();
        }

        /** @var MessageStream $ms */
        $ms = $this->ci->alerts;

        // Load the request schema
        $schema = new RequestSchema("schema://$schemaname");

        // Whitelist and set parameter defaults
        $transformer = new RequestDataTransformer($schema);
        $data = $transformer->transform($params);

        $error = false;

        // Validate request data
        $validator = new ServerSideValidator($schema, $this->ci->translator);
        if (!$validator->validate($data)) {
            $ms->addValidationErrors($validator);
            $error = true;
        }

        if ($error) {
            return $response->withStatus(400);
        }
        return $data;
    }

    public function csvExport($file, $data, $headers = []) {
        $csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());

        if ($headers == []) {
            foreach ($data as $dadtarec) {
                $headers = array_keys($dadtarec);
                break;
            }
        }
        if (count($headers) > 0) {
            $csv->insertOne($headers);
        }

        $csv->insertAll($data);
        $csv->output($file);
    }

}
