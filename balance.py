from operator import truediv
import requests
import asyncio
from solana.rpc.async_api import AsyncClient

SOLANA_ENDPOINT = 'https://api.mainnet-beta.solana.com'
SOL_PROGRAM_ID  = 'TokenkegQfeZyiNwAJbNbGKPFXCWuBvf9Ss623VQ5DA'
# 今回は、このウォレットアドレスにしていますが、自分のがあれば書き換えてください！
SOL_WALLET = 'EDuVpfE29Rb7S9q1bM5Db8WwtqMAPbZb8bqrfNcNt24c'

# connection api server
async def main():
    async with AsyncClient(SOLANA_ENDPOINT) as client:
        res: bool = await client.is_connected()
    if res == 1:
        print("connection success")  # True
    elif res == 0:
        print("connection failed") # False

    payload = {
        'jsonrpc': '2.0',
        'id': 1,
        'method': 'getTokenAccountsByOwner',
        'params': [
            f'{SOL_WALLET}',
            {
                'programId': f'{SOL_PROGRAM_ID}'
            },
            {
                'encoding': 'jsonParsed'
            }
        ]
    }
    r = requests.post(SOLANA_ENDPOINT, json = payload)
    j = r.json()

    print(j)

    await client.close()

asyncio.run(main())


