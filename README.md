# CryptoCurrency
Page to keep track of value & profits of a portfolio of cryptocurrency (based on Coinmarketcap, Bitfinex and Binance)

Features:
- Login screen, no database required
- A tab to keep track of your paper wallet portfolio
- A tab to keep track of your Bitfinex portfolio
- A tab to keep track of your Binance portfolio
- A tab to keep track of potential coins with simulated profit
- A summary tab listing profits per paper wallet/exchange only
- Easy to add interesting coins if necessary

Coins for paper wallet, using public keys:
- Bitcoin
- Ethereum
- Litecoin
- WePower (technically a token but yeah)

Coins for exchanges, manual entry:
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

Coins for watchlist:
- Burst
- Eos
- Verge
- Waves
- Zcash

How to use:

Input.php can be used to add:
- Public key of owned coins/tokens, 1 per coin only. Limited to BTC, ETH, LTC and WPR
- Buyin rate: value of 1 of each coin at moment of buying, in dollars
- Buyin costs: Amount of money spent on purchase per coin, in dollars
- Transferfee: The usual transfer fee in the respective coin, not dollars
- Withdrawalfee: The withdrawal fee for the coin at the specific exchange in the respective coin, not dollars

Coins.php shows basic information on:
- Actual rate of a coin according to Coinmarketcap
- Recent percentage changes according to Coinmarketcap per 1 hour / 24 hours / 7 days
- Profit (absolute and percentage)
- Profit deducting regular fees (absolute and percentage)

Dependencies:
- Coins.php uses exchange rates for EUR/USD from fixer.io which are updated at 4pm CET every working day
- Coins.php uses cryptocurrency exchange rates and percentage changes from Coinmarketcap that are updated every 5 minutes
- Balance.php uses Blockchain.info, Etherscan.io and Chainz.cryptoid.info to fetch balance data for public adresses
- Bitfinex.php uses Bitfinex API to fetch data for rates of coins at Bitfinex
- Binance.php uses Binance API to fetch data for rates of coins at Bitfinex

Plan to change:
- Add actual fees (if any site supplies this through an API)
- Fix some of the logic & implement improved exit-cashout logic instead of estimates
- Reduce necessary manual input for balances on exchanges
- Add ATH (all time high and 2/3 of ATH as info if any site supplies this through an API)
