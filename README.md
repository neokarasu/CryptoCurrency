# CryptoCurrency
Simplistic page to keep track of cryptocurrency value and profits (based on coinmarketcap)

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

Coins.php uses exchange rates for EUR/USD from fixer.io which are updated at 4pm CET every working day
Coins.php uses cryptocurrency exchange rates and percentage changes from Coinmarketcap that are updated every 5 minutes

For now it only has:
- Bitcoin
- Ethereum
- Litecoin

Plan to add:
- More coins
- Alternative to coinmarketcap
