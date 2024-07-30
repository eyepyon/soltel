# soltel

## タイトル
SolTEL(仮)  

## 概要
指定アドレスにsolを送金することで、指定の宛先に電話できる。  

## 使い方
1. 指定のアドレスにsolを送金
2. 指定の番号に電話をする
3. 電話が対象に転送される。

## 仕組み：
pythonのバッチで送金を監視し、送金があった場合、指定番号への電話の転送先を変える
番号と電話制御はtwilioを使用する

## 作った意味
そもそも電話って受け取るの苦痛ですよね。  
でももしsolが手に入って儲かるなら、電話を受けるのも悪くないかもしれません。


## 補足

決勝プレゼン用の素敵な資料は準備中
決勝プレゼンでみんな楽しめるようにしようかと思います。
お楽しみに

電話番号  
050-3733-7000

## コマンド等

アップグレードしてね  
python3 -m pip install --upgrade pip

必要なライブラリをインストール  
pip install requests asyncio solana

残高取得  
python balance.py

結果↓
```
connection success
{'jsonrpc': '2.0', 'result': {'context': {'apiVersion': '1.18.18', 'slot': 280557502}, 'value': [{'account': {'data': {'parsed': {'info': {'isNative': False, 'mint': '6tdc45bNDHVLTHbXvPypc7xHJ6MZYcFqaS7ugpopgb5n', 'owner': 'EDuVpfE29Rb7S9q1bM5Db8WwtqMAPbZb8bqrfNcNt24c', 'state': 'initialized', 'tokenAmount': {'amount': '1', 'decimals': 0, 'uiAmount': 1.0, 'uiAmountString': '1'}}, 'type': 'account'}, 'program': 'spl-token', 'space': 165}, 'executable': False, 'lamports': 2039280, 'owner': 'TokenkegQfeZyiNwAJbNbGKPFXCWuBvf9Ss623VQ5DA', 'rentEpoch': 18446744073709551615, 'space': 165}, 'pubkey': 'EE6R7FeBg6xmFYA6x2MVrM8CX7z4W7V1geTeF6yrc5dp'}]}, 'id': 1}
```

## その他情報

Github  
https://github.com/eyepyon/soltel

作った人  
https://x.com/masafumiaida

Superteam Japan Earn  
https://earn.superteam.fun/t/eye/
