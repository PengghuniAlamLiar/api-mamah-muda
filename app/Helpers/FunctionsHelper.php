<?php

namespace App\Helpers;

class FunctionsHelper
{
    public static function response($code = 200, $status = 1, $data = [])
    {
        $success = ($status === 0 ? false : true);

        $response_code = [
            "200" => "Success",
            "201" => "Pending Issued",
            "202" => "Issued On Progress",
            "203" => "Transaction Already Issued",
            "401" => "Unauthorized",
            "402" => "Successfully logged out",
            "403" => "Search Failed",
            "404" => "Search Not Found",
            "405" => "Failed Create Invoice",
            "406" => "Balance Not Enough",
            "407" => "Timelimit Exceeded",
            "408" => "Transaction ID Not Found",
            "409" => "Cannot issued this schedule",
            "410" => "Error getting fare",
            "411" => "Error / Not enough parameter",
            "412" => "Error retrieve book",
            "413" => "Failed login",
            "414" => "Failed login, Customer expired",
            "415" => "Failed getting price",
            "416" => "Departure baggage or return baggage cannot more than 40",
            "417" => "Error cancel book",
        ];

        $response = [
            "status" => $code,
            "success" => $success,
            "message" => $response_code[$code],
            "data" => $data
        ];

        return $response;
    }
}