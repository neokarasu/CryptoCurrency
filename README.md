# CryptoCurrency
Page to keep track of value & profits of a portfolio of cryptocurrency (based on Coinmarketcap, Binance and Bitfinex)

## Features:
- Login screen
- No database required for anything
- A tab to keep track of your paper wallet portfolio, supporting multiple public keys
- A tab to keep track of your Bitfinex portfolio
- A tab to keep track of your Binance portfolio
- A tab to keep track of potential coins with simulated profit
- A summary tab listing profits per paper wallet/exchange only
- API integration with your Bitfinex and Binance account for balance information
- Easy to add interesting coins if necessary

## Coins for paper wallet, using (multiple) public keys:
- Bitcoin
- Ethereum
- Litecoin

## Coins for exchanges:
- Any coin that's on the Exchange and on CoinMarketCap is supported, for example:
   - Bitcoin
   - Bitcoin cash
   - Cardano
   - Ethereum Classic
   - Iota
   - Litecoin
   - Monero
   - Neo
   - Ripple
   - VeChain
   - and so on

## Coins for watchlist:
- Any coin that's on the Exchange and on CoinMarketCap is supported, for example:
   - Burst
   - Eos
   - Verge
   - Waves
   - Zcash
   - and so on

## How to use:

Add the following to input.php:
- Your username and password for logging into the site
- Public key(s) of owned coins/tokens. Multiple per coin supported. Limited to BTC, ETH, LTC
- Buyin rate: value of 1 of each coin at moment of buying, in dollars
- Buyin costs: Amount of money spent on purchase per coin, in dollars
- Buyin rates for coins on the watchlist: value of coin you want to simulate as a buyin rate, in dollars
- Cryptosymbols: supporteed coin types, easily extended
- Binance Fiat withdrawal cost and Tradefee, in dollars
- API keys for:
   - Binance
   - Bitfinex
   - openExchangeRates
   - EtherScan
   - Chainz.cryptoid.info
   - CoinMarketCap

Check coins.php for basic info on:
- Actual rate of a coin according to Coinmarketcap
- Recent percentage changes according to Coinmarketcap per 1 hour / 24 hours / 7 days
- Profit (absolute and percentage)
- Exit Profit (absolute and percentage) which is profit after deducting fees for cashing out to fiat

Dependencies:
- OpenExchangeRates.org for exchange rates of fiat. You need to sign up with them at https://openexchangerates.org for an API-key
- CoinMarketCap.com for rates of cryptocurrency. You need to sign up with them at https://coinmarketcap.com for an API-key
- Blockchain.info to fetch balance data for public BTC adresses.
- Etherscan.io to fetch balance data for public ETH adresses. You need to sign up with them at https://etherscan.io/apis for an API-key
- Chainz.cryptoid.info to fetch balance data for public LTC adresses. You need to sign up with them at https://chainz.cryptoid.info/api.key.dws for an API-key
- Blockcypher.com for actual transfer rates of BTC, LTC and ETH of paper wallets.
- Binance.com to fetch data of your balance at Binance. You need create an API-key in your account at https://www.binance.com/
- Bitfinex.com to fetch data of your balance at Bitfinex. You need create an API-key in your account at https://www.bitfinex.com/
