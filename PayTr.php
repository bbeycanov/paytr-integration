<?php 
class PayTr
{
    public $token; 
    protected $request_url    = "https://www.paytr.com/odeme/api/get-token";
    protected $merchant_id    = 'XXXXXX';
    protected $merchant_key   = 'YYYYYYYYYYYYYY';
    protected $merchant_salt  = 'ZZZZZZZZZZZZZZ';
    protected $email;
    protected $user_address;
    protected $user_phone;
    protected $user_name;
    protected $payment_amount;
    protected $merchant_oid;
    protected $merchant_ok_url;
    protected $merchant_fail_url;
    protected $user_basket;
    protected $user_ip;
    protected $timeout_limit;
    protected $debug_on;
    protected $test_mode;
    protected $no_installment;
    protected $max_installment;
    protected $currency;
    protected $hash_str;
    protected $paytr_token;
    protected $post_vals;

    public function __construct(){
      $this->setMerchantOrderId();
      $this->setIpAddress();
      $this->setTimeoutLimit();
      $this->setDebugMode();
      $this->setTestMode();
      $this->setInstallment();
      $this->setInstallmentLimit();
      $this->setCurrency();
    }

    /*
    *   SET MERCHANT ID
    */
    public function setMerchantId($merchant_id = ''){
      $this->merchant_id = $merchant_id;
    }

    /*
    *   GET MERCHANT ID
    */
    public function getMerchantId(){
      return $this->merchant_id;
    }

    /*
    *   SET MERCHANT KEY
    */
    public function setMerchantKey($merchant_key = ''){
      $this->merchant_key = $merchant_key;
    }

    /*
    *   GET MERCHANT KEY
    */
    public function getMerchantKey(){
      return $this->merchant_key;
    }

    /*
    *   SET MERCHANT SALT
    */
    public function setMerchantSalt($merchant_salt = ''){
      $this->merchant_salt = $merchant_salt;
    }

    /*
    *   GET MERCHANT SALT
    */
    public function getMerchantSalt(){
      return $this->merchant_salt;
    }

    /*
    *   SET USER EMAIL
    */
    public function setEmail($email = false){
      $this->email = $email;
    }

    /*
    *   GET USER EMAIL
    */
    public function getEmail(){
      return $this->email;
    }

    /*
    *   SET PAYMENT AMMOUNT
    */
    public function setPaymentAmount($amount = 0){
      $this->payment_amount = $amount * 100;
    }

    /*
    *   GET PAYMENT AMMOUNT
    */
    public function getPaymentAmount(){
      return $this->payment_amount;
    }

    /*
    *   SET PAYMENT ORDER ID
    */
    public function setMerchantOrderId(){
      $this->merchant_oid = $this->randomKeyGenerate();
    }

    /*
    *   GET PAYMENT ORDER ID
    */
    public function getMerchantOrderId(){
      return $this->merchant_oid;
    }

    /*
    *   SET USER NAME
    */
    public function setUserName($user_name){
      $this->user_name = $user_name;
    }

    /*
    *   GET USER NAME
    */
    public function getUserName(){
      return $this->user_name;
    }

    /*
    *   SET USER ADDRESS
    */
    public function setAddress($user_address){
      $this->user_address = $user_address;
    }

    /*
    *   GET USER ADDRESS
    */
    public function getAddress(){
      return $this->user_address;
    }

    /*
    *   SET USER PHONE
    */
    public function setPhone($user_phone){
      $this->user_phone = $user_phone;
    }

    /*
    *   SET USER PHONE
    */
    public function getPhone(){
      return $this->user_phone;
    }

    /*
    *   SET CALLBACK SUCCSESS URL
    */
    public function setSuccessUrl($merchant_ok_url){
      $this->merchant_ok_url = $merchant_ok_url;
    }

    /*
    *   GET CALLBACK SUCCSESS URL
    */
    public function getSuccessUrl(){
      return $this->merchant_ok_url;
    }

    /*
    *   SET CALLBACK FAIL URL
    */
    public function setFailUrl($merchant_fail_url){
      $this->merchant_fail_url = $merchant_fail_url;
    }

    /*
    *   GET CALLBACK FAIL URL
    */
    public function getFailUrl(){
      return $this->merchant_fail_url;
    }

    /*
    *   SET USER BASKET INFO
    */
    public function setBasket($user_basket){
      $this->user_basket = base64_encode(json_encode($user_basket));
    }

    /*
    *   GET USER BASKET INFO
    */
    public function getHashBasket(){
      return base64_decode(json_decode($this->user_basket, true));
    }

    /*
    *   GET USER BASKET INFO
    */
    public function getBasket(){
      return $this->user_basket;
    }

    /*
    *   SET USER IP ADDRESS
    */
    public function setIpAddress(){
      $this->user_ip = $this->findMyIp();
    }

    /*
    *   GET USER IP ADDRESS
    */
    public function getIpAddress(){
      return $this->user_ip;
    }

    /*
    *   SET TIMEOUT LIMIT
    */
    public function setTimeoutLimit($limit = 30){
      $this->timeout_limit = $limit;
    }

    /*
    *   GET TIMEOUT LIMIT
    */
    public function getTimeoutLimit(){
      return $this->timeout_limit;
    }

    /*
    *   SET DEBUG MODE
    */
    public function setDebugMode($mode = 0){
      $this->debug_on = $mode;
    }

    /*
    *   GET DEBUG MODE
    */
    public function getDebugMode(){
      return $this->debug_on;
    }

    /*
    *   SET TEST MODE
    */
    public function setTestMode($mode = 0)
    {
      $this->test_mode = $mode;
    }

    /*
    *   GET TEST MODE
    */
    public function getTestMode(){
      return $this->test_mode;
    }

    /*
    *   SET INSTALLMENT MODE
    */
    public function setInstallment($mode = 0){
      $this->no_installment = $mode;
    }

    /*
    *   GET INSTALLMENT MODE
    */
    public function getInstallment(){
      return $this->no_installment;
    }

    /*
    *   SET INSTALLMENT LIMIT
    */
    public function setInstallmentLimit($limit = 0){
      $this->max_installment = $limit;
    }

    /*
    *   GET INSTALLMENT LIMIT
    */
    public function getInstallmentLimit(){
      return $this->max_installment;
    }

    /*
    *   SET CURRENCY
    */
    public function setCurrency($currency = 'TL'){
      $this->currency = $currency;
    }

    /*
    *   GET CURRENCY
    */
    public function getCurrency(){
      return $this->currency;
    }

    /*
    *   GENERATE PRIVACY HASH CODE
    */
    public function generateHashCode(){
      $this->hash_str = implode("", [
        $this->getMerchantId(),
        $this->getIpAddress(),
        $this->getMerchantOrderId(),
        $this->getEmail(),
        $this->getPaymentAmount(),
        $this->getBasket(),
        $this->getInstallment(),
        $this->getInstallmentLimit(),
        $this->getCurrency(),
        $this->getTestMode()
      ]);
    }

    /*
    *   GET PRIVACY HASH CODE
    */
    public function gethashCode(){
      return $this->hash_str;
    }

    /*
    *   SET PAYTR TOKEN
    */
    public function setPaytrToken(){
      $this->paytr_token = base64_encode(hash_hmac('sha256', implode("", [$this->gethashCode(), $this->getMerchantSalt()]) , $this->getMerchantKey(), true));
    }

    /*
    *   GET PAYTR TOKEN
    */
    public function getPaytrToken(){
      return $this->paytr_token;
    }

    /*
    *   SET POAST VALUE
    */
    public function setPostValue(){
      $this->post_vals = [
        'merchant_id'        => $this->getMerchantId(),
  		'user_ip'            => $this->getIpAddress(),
  		'merchant_oid'       => $this->getMerchantOrderId(),
  		'email'              => $this->getEmail(),
  		'payment_amount'     => $this->getPaymentAmount(),
  		'paytr_token'        => $this->getPaytrToken(),
  		'user_basket'        => $this->getBasket(),
  		'debug_on'           => $this->getDebugMode(),
  		'no_installment'     => $this->getInstallment(),
  		'max_installment'    => $this->getInstallmentLimit(),
  		'user_name'          => $this->getUserName(),
  		'user_address'       => $this->getAddress(),
  		'user_phone'         => $this->getPhone(),
  		'merchant_ok_url'    => $this->getSuccessUrl(),
  		'merchant_fail_url'  => $this->getFailUrl(),
  		'timeout_limit'      => $this->getTimeoutLimit(),
  		'currency'           => $this->getCurrency(),
        'test_mode'          => $this->getTestMode()
      ];
    }

    /*
    *   GET POAST VALUE
    */
    public function getPostValue(){
      return $this->post_vals;
    }

    /*
    *   GENERATE RANDOM UNIQUIE KEY
    */
    public function randomKeyGenerate(){
      return substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 50);
    }

    /*
    *   FIND CURRENT USER IP ADDRESS
    */

    public function findMyIp(){
      if( isset( $_SERVER["HTTP_CLIENT_IP"] ) ) {
    		$ip = $_SERVER["HTTP_CLIENT_IP"];
    	} elseif( isset( $_SERVER["HTTP_X_FORWARDED_FOR"] ) ) {
    		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    	} else {
    		$ip = $_SERVER["REMOTE_ADDR"];
    	}
      return $ip;
    }

    public function requestPaytr($post_vals = false){
      $ch=curl_init();
    	curl_setopt($ch, CURLOPT_URL, $this->request_url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_POST, 1) ;
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    	curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
      $result = @curl_exec($ch);
    	if(curl_errno($ch))
  		{
        curl_close($ch);
        return curl_error($ch);
      }
      else
      {
        curl_close($ch);
        return $result;
      }
    }

    public function initialize(){
      $this->generateHashCode();
      $this->setPaytrToken();
      $this->setPostValue();
      $request = $this->requestPaytr($this->getPostValue());
      $result=json_decode($request,1);
      if($result['status']=='success')
      {
        $this->token = $result['token'];
        return $this->token;
      }
      else {
        die("PAYTR IFRAME connection error. err:".$e);
      }
    }
}
