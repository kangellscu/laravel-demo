This demo created for initializing a empty laravel project fastly and easely
This demo projects shiped with some features, as below:

### output format auto convert
> 框架根据Request header: Accept进行检查，确定是否执行对应格式输出
> * json -- application/json
> * xml -- text/xml
> * txt -- text/plain
> * html -- text/html
> * 如果Accept缺失，默认为text/html（laravel框架确定）

### 使用自定义的hashing类替换laravel提供的hashing类
> 参见app/Hasing/PasswordHasher.php

### Utils
* HTTPRequestUtil
> a guzzle wrapper class

* MoneyUnitConvertUtil
> util for money unit from fen to yuan, or from yuan to fen

### 支持wechat
[laravel vendor](https://github.com/overtrue/laravel-wechat)
[easywechat official site](https://easywechat.org/)
