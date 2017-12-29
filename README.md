# CryptoCurrency
Page to keep track of value & profits of portfolio of cryptocurrency (based on coinmarketcap)

Features:
- Login screen, no database required
- A tab to keep track of your portfolio
- A tab to keep track of potential coins with simulated profit
- Easy to add interesting coins if necessary

Coins added for portfolio:
- Bitcoin
- Ethereum
- Litecoin

Coins added for watchlist:
- Burst
- Cardano
- Eos
- Iota
- Neo
- Ripple
- Verge
- Waves
- Zcash

How to use:

Input.php can be used to add:
- Amount of coins owned per coin
- Buyin rate: value of 1 of each coin at moment of buying, in dollars
- Buyin costs: Amount of money spent on purchase per coin, in dollars
- Transferfee: The usual transfer fee in the respective coin, not dollars

Coins.php shows basic information on:
- Actual rate of a coin according to Coinmarketcap
- Recent percentage changes according to Coinmarketcap
- Profit (absolute and percentage)
- Profit deducting regular fees (absolute and percentage)

Dependencies:
- Coins.php uses exchange rates for EUR/USD from fixer.io which are updated at 4pm CET every working day
- Coins.php uses cryptocurrency exchange rates and percentage changes from Coinmarketcap that are updated every 5 minutes

Plan to change:
- Add ATH (all time high and 2/3 of ATH as info if any site supplies this through an API)
- Add more coins
- Add alternatives to coinmarketcap
