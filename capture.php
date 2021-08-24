<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);    
require 'wp-content/plugins/video_quiz_linking/merchant-sdk-php/vendor/autoload.php';
use Sample\PayPalClient;
use PayPalCheckoutSdk\Payments\AuthorizationsCaptureRequest;


class CaptureAuthorization {

  public static function captureAuth($authorizationId, $debug=false)
  {
    $request = new AuthorizationsCaptureRequest($authorizationId);
    $request->body = self::buildRequestBody();
    $client = PayPalClient::client();
    $response = $client->execute($request);
    if ($debug)           
    {          
      print "Status Code: {$response->statusCode}\n";
      print "Status: {$response->result->status}\n";
      print "Capture ID: {$response->result->id}\n";
      print "Links:\n";         
      foreach($response->result->links as $link) {
        print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
      }  
      echo json_encode($response->result, JSON_PRETTY_PRINT), "\n";
    }
    return $response;
  }
  public static function buildRequestBody()
  {
    return "{}";
  }

}

CaptureAuthorization::captureAuth('4B100733BC505653V', true);       