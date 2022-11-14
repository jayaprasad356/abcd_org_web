<?php
 
if(isset($_POST['submit'])){
//get the inputs
    $phone = $_POST['phone_no'];
    $message = $_POST['message'];
    $fields = array(
            "message" => $message,
            "language" => "english",
           // "route" => "v3",
            "variables_values" => "5599",
            "route" => "otp",
            "numbers" => $phone,
        );
 
        $curl = curl_init();
 
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($fields),
          CURLOPT_HTTPHEADER => array(
            "authorization: iEdyothXy7brHxJN0gF3nIZfoyi0urjVssiJAMTDqULbvoilx9JVi89ptVKw",
            "accept: */*",
            "cache-control: no-cache",
            "content-type: application/json"
          ),
        ));
 
        $response = curl_exec($curl);
        $err = curl_error($curl);
 
        curl_close($curl);
        
        print_r($response);exit;
 
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          /*echo '<pre>';
          echo $response;*/
          echo '<b>SMS sent successfully on the number: '.$phone.'</b>';
          header("refresh:5;url=sendotp.php");
 
        }
    }
 
?>