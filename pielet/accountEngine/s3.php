<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
$awsdate = date('Ymd');
$awsid = 'AKIA4GDPZHV6KHAWUO6O';
$credential = "$awsid/$awsdate/us-east-1/s3/aws4_request,";


$header = "Authorization: AWS4-HMAC-SHA256 
Credential=$credential 
SignedHeaders=host;range;x-amz-date,
Signature=fe5f80f77d5fa3beca038a248ff027d0445342fe2855ddc963176630326f1024"
;

$SQS_URL = '';
$SQS_URL = '';
$SQS_URL = '';
$SQS_URL = '';

const AWS_DATETIME_FORMAT = 'Ymd\THis\Z';

$url = getenv('SQS_URL');
$data = [
  'Action' => 'SendMessage',
  'MessageBody' => $body,
  'Expires' => (new DateTime('UTC'))->add(new DateInterval('PT1M'))->format(AWS_DATETIME_FORMAT),
  'Version' => '2012-11-05',
];
$result = Requests::post($url, sign_request($url, $data), $data);

function sign_request($url, $data) {
  // These values are provided by AWS Lambda itself.
  $secret_key = getenv('AWS_SECRET_ACCESS_KEY');
  $access_key = getenv('AWS_ACCESS_KEY_ID');
  $token = getenv('AWS_SESSION_TOKEN');
  $region =  getenv('AWS_REGION');

  $service = 'sqs';

  $current = new DateTime('UTC');
  $current_date_time = $current->format(AWS_DATETIME_FORMAT);
  $current_date = $current->format('Ymd');

  $signed_headers = [
    'content-type' => 'application/x-www-form-urlencoded',
    'host' => "sqs.$region.amazonaws.com",
    'x-amz-date' => $current_date_time,
    'x-amz-security-token' => $token, // leave this one out if you have a IAM created fixed access key - secret pair and do not need the token.
  ];
  $signed_headers_string = implode(';', array_keys($signed_headers));

  $canonical = [
    'POST',
    parse_url($url, PHP_URL_PATH),
    '', // this would be the query string but we do not have one.
  ];
  foreach ($signed_headers as $header => $value) {
    $canonical[] = "$header:$value";
  }
  $canonical[] = ''; // this is always an empty line
  $canonical[] = $signed_headers_string;
  $canonical[] = hash('sha256', http_build_query($data));
  $canonical = implode("\n", $canonical);

  $credential_scope = [$current_date, $region, $service, 'aws4_request'];
  $key = array_reduce($credential_scope, fn ($key, $credential) => hash_hmac('sha256', $credential, $key, TRUE), 'AWS4' . $secret_key);
  $credential_scope = implode('/', $credential_scope);

  $string_to_sign = implode("\n", [
    'AWS4-HMAC-SHA256',
    $current_date_time,
    $credential_scope,
    hash('sha256', $canonical),
  ]);
  $signature = hash_hmac('sha256', $string_to_sign, $key);

  unset($signed_headers['host']);
  $signed_headers['Authorization'] = "AWS4-HMAC-SHA256 Credential=$access_key/$credential_scope, SignedHeaders=$signed_headers_string, Signature=$signature";
  return $signed_headers;
}