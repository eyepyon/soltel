<?php

// 転送元電話番号と転送先電話番号
$fromTel = '+815037337000';
//$toTel = '+818048563939';// iphone
$toTel = '+818056420444';// android

//$target = 0.8;// 転送する残高
$target = 0.2;// 転送する残高
// チェックするウォレット
// $address = 'B9QarUUxxoBktShqdzgKuVZP9DnYTm3ChaggEqTwBF76'; // iPhone
$address = '4ss8BBTry3isDgALXHMNRoZVDUi96yfBmLEpTkZXFsMK'; // PC

function getSolanaBalance($address)
{
    $url = 'https://api.mainnet-beta.solana.com';

    $data = [
        'jsonrpc' => '2.0',
        'id' => 1,
        'method' => 'getBalance',
        'params' => [$address]
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        die('Error fetching balance');
    }

    $response = json_decode($result, true);

    if (isset($response['result']['value'])) {
        // The balance is returned in lamports (1 SOL = 1,000,000,000 lamports)
        $balanceInLamports = $response['result']['value'];
        $balanceInSol = $balanceInLamports / 1000000000;
        return $balanceInSol;
    } else {
        die('Error in response: ' . print_r($response, true));
    }
}

/**
 * @param $fromTel
 * @param $toTel
 * @return void
 */
function telTranceOK($fromTel="", $toTel="")
{
    print '<Say language="ja-jp" voice="woman">おめでとうございます。指定の残高まで集まりました。</Say>';
    print '<Say language="ja-jp" voice="woman">呼び出しますので少々お待ちください。</Say>';
    printf('<Dial callerId="%s">%s</Dial>', $fromTel, $toTel);
    print "</Response>\n";
    exit;
}
function telTranceNG($target=0,$balance=0)
{
    print '<Say language="ja-jp" voice="woman">指定の残高に足りないのでお繋ぎすることができません。</Say>';
    printf('<Say language="ja-jp" voice="woman">指定の残高は %s ソルです。</Say>',$target);
    print '<Say language="ja-jp" voice="woman">現在の残高は</Say>';
    printf('<Say language="ja-jp" voice="woman">%s ソルです。</Say>', $balance);
    print '<Say language="ja-jp" voice="woman">指定の残高まで</Say>';
    $last = $target - $balance;
    printf('<Say language="ja-jp" voice="woman">%s ソルです。</Say>',$last);
    print '<Say language="ja-jp" voice="woman">頑張って集めてください。健闘を祈ります。</Say>';
    print "</Response>\n";
    exit;
}

header("content-type: text/xml");
print "<" . "?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">\n";

print "<Response>\n";
print '<Say language="ja-jp" voice="woman">お電話ありがとうございます。</Say>';
print '<Say language="ja-jp" voice="woman">ソル・テルです。</Say>';

// 残高を取得
$balance = getSolanaBalance($address);
$log = "The balance for address $address is $balance SOL\n";
$caller = trim($_REQUEST['From']);
$log .= "Caller: $caller\n";
error_log($log, 3, "/var/www/soltel/log/debug.log");

if($target <= $balance){
    telTranceOK($fromTel, $toTel);
}else{
    telTranceNG($target, $balance);
}


