<?php
//取得Client連線進來的IP
function get_client_ip()
{

    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')) {
        $ipaddress = getenv('HTTP_CLIENT_IP');
    } else if (getenv('HTTP_X_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    } else if (getenv('HTTP_X_FORWARDED')) {
        $ipaddress = getenv('HTTP_X_FORWARDED');
    } else if (getenv('HTTP_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    } else if (getenv('HTTP_FORWARDED')) {
        $ipaddress = getenv('HTTP_FORWARDED');
    } else if (getenv('REMOTE_ADDR')) {
        $ipaddress = getenv('REMOTE_ADDR');
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}

//把IP交換組合成KEY
function key_generator($ip, $case)
{
    $ip_arr = explode(".", $ip, 4);

    if ($case == 2) {
        $key = chr((int) ($ip_arr[0])) . chr((int) ($ip_arr[1])) . chr((int) ($ip_arr[2])) . chr((int) ($ip_arr[3]))
        . chr((int) ($ip_arr[3])) . chr((int) ($ip_arr[2])) . chr((int) ($ip_arr[1])) . chr((int) ($ip_arr[0]))
        . chr((int) ($ip_arr[1])) . chr((int) ($ip_arr[3])) . chr((int) ($ip_arr[0])) . chr((int) ($ip_arr[2]))
        . chr((int) ($ip_arr[2])) . chr((int) ($ip_arr[1])) . chr((int) ($ip_arr[0])) . chr((int) ($ip_arr[3]));

    } else {
        $key = chr((int) ($ip_arr[0])) . chr((int) ($ip_arr[1])) . chr((int) ($ip_arr[2])) . chr((int) ($ip_arr[3]))
        . chr((int) ($ip_arr[3])) . chr((int) ($ip_arr[2])) . chr((int) ($ip_arr[1])) . chr((int) ($ip_arr[0]))
        . chr((int) ($ip_arr[1])) . chr((int) ($ip_arr[3])) . chr((int) ($ip_arr[0])) . chr((int) ($ip_arr[2]))
        . chr((int) ($ip_arr[2])) . chr((int) ($ip_arr[1])) . chr((int) ($ip_arr[0])) . chr((int) ($ip_arr[3]));
    }
    return $key;
}

//檢查key是否合理
function checkKeyVaild($token, $input)
{

    $privateKey = key_generator(get_client_ip(), 0); //get_client_ip()可以直改成任意IP組合來做測試 如140.127.51.191

    $iv            = "NKNUWEBSERVICE!!";
    $encryptedData = base64_decode($token);
    $decrypted     = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $privateKey, $encryptedData, MCRYPT_MODE_CBC, $iv);
    $decrypted     = preg_replace('/[\x00-\x1F\x7F]/', '', $decrypted);

    if ($decrypted === $input) { //如果解回來的$decrypted跟$input就pass
        return true;
    } else {
        return false;
    }

}

function decryptedToken($token){
  $privateKey = key_generator(get_client_ip(), 0); //get_client_ip()可以直改成任意IP組合來做測試 如140.127.51.191

  $iv            = "NKNUWEBSERVICE!!";
  $encryptedData = base64_decode($token);
  $decrypted     = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $privateKey, $encryptedData, MCRYPT_MODE_CBC, $iv);
  $decrypted     = preg_replace('/[\x00-\x1F\x7F]/', '', $decrypted);
  return $decrypted;
}

// //如果要自己測試可以改自己設定好的token
function decodeToken($inputToken, $inputStuID){

  if (checkKeyVaild($inputToken, $inputStuID)) {
      echo "success"; //直接走到登入成功的那一段
  } else {
      echo "fail"; //登入失敗
  }

}

// 加密 這段可以拿來自己產生token測試

//AES initial
function eccodeToken(){
  $privateKey = key_generator(get_client_ip(), 2); //這邊的IP要設定成跟47行的IP一樣
  $iv         = "NKNUWEBSERVICE!!"; //不要動
  $data       = "123"; //資料

  //加密
  $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $data, MCRYPT_MODE_CBC, $iv);
  $en_str    = base64_encode($encrypted);
  echo $en_str;
}
