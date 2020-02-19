<?php
  require_once("PayTr.php");
  $paytr = new PayTr(); 
  
  // SET IMPORTANT INFORMATION
  
  $paytr->setMerchantId('XXXXXX');                       // set your merchant id
  $paytr->setMerchantKey('YYYYYYYYYYYYYY');              // set your merchant key
  $paytr->setMerchantSalt('ZZZZZZZZZZZZZZ');             // set your merchant salt
  
  $paytr->setEmail('your_email');                        // example: example@example.com (string)            
  $paytr->setPaymentAmount(your_price);                  // example: 10.5 (decimal 8/2)
  $paytr->setUserName('your_fullname');                  // example: Jhon Deo  (string)  
  $paytr->setAddress('your_address');                    // example: H.Əliyev 5/81 45-ci məhəllə (string) 
  $paytr->setPhone('your_phone');                        // example: +994555555555 (string) 
  $paytr->setBasket('order_product_info');               // example: [["name"=>"Macbook Pro", "price"=>10, "currency"=>"TL"]]  (array) 
  $paytr->setSuccessUrl('your_succsess_url');            // example: https://example.com/succsess.php
  $paytr->setFailUrl('your_fail_url');                   // example: https://example.com/fail.php
  $paytr->initialize();
  
  $token = $paytr->token;
?>

<script src="https://www.paytr.com/js/iframeResizer.min.js"></script>
<iframe src="https://www.paytr.com/odeme/guvenli/<?php echo $token;?>" id="paytriframe" frameborder="0" scrolling="no" style="width: 100%;"></iframe>
<script>iFrameResize({},'#paytriframe');</script>
