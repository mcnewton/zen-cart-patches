<?php

/**
 * Script to enable redirecting a download to Amazon S3
 *
 * Variables available:
 *  $db - database handle
 *  $origin_filename (name of this script)
 *  $browser_filename (filename presented to browser)
 *  $script_opts (all options from the filename box)
 *    [0] - script name
 *    [1] - filename
 *    [2] - file size
 *    ... - user defined options
 */


// The majority of this script should be kept in a function so
// as to not clash with variables in the main download script.

function script_process($db, $filename, $opts) {

  // set Access key, Secret key and Bucket name here:
  // ------------------------------------------------
  $aws_key = "AMAZON_S3_ACCESS_KEY";
  $aws_secret = "AMAZON_S3_SECRET_KEY_xxxxxxxxxxxxxxxxxxx";
  $bucket = "BUCKET_NAME";
  // ------------------------------------------------

  // example: set the bucket name in the interface
  // $bucket = $opts[3];

  $awshost = "s3.amazonaws.com";

  // expire in 30 seconds time - should be plenty long enough for the redirect
  $expires = time() + 30;

  $sign = "GET\n\n\n{$expires}\n/{$bucket}/{$filename}";

  $signature = urlencode(base64_encode((hash_hmac("sha1", utf8_encode($sign), $aws_secret, true))));
  $params = "AWSAccessKeyId={$aws_key}&Expires={$expires}&Signature={$signature}";
  
  return "http://$awshost/{$bucket}/{$filename}?{$params}";
}


// Get the URL to redirect to, and then make the jump.

$url = script_process($db, $browser_filename, $script_opts);
header("HTTP/1.1 303 See Other");
zen_redirect($url);

?>
