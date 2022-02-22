# Open Api for Magento 2.4

This module will display the world currency on the top bar on every page.

## Requirements
1. Create an environment with Magento 2.4.1 or above
2. Use Linux environment
3. Create a custom extension in Magento 2 and integrate any open API then display the information in the frontend
4. Bonus: Use docker to implement the environment, use Magento 2's MVVM framework

## Installation

- Clone this module and put in `app/code/Branch8/OpenAPI` directory.
- Enter following commands to enable module:
```
php bin/magento module:enable Branch8_OpenApi
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
```

## How to use

- Login to Magento Admin `Stores > Configuration`
- Open `Branch8 > Open API` section
- Enable the module by choosing “Yes” in the required field.
- Save config.


![configuration page](https://i.imgur.com/uyhdOka.png)

## Final result

When customer logged in, the small top bar will show up with current customer group

![Final result](https://i.imgur.com/BPeBy3O.png)
