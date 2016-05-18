# phpunit-test
test phpunit

## What's PHPunit 
PHPUnit是一个面向PHP程序员的测试框架，这是一个xUnit的体系结构的单元测试框架。

### install
Getting Started with PHPUnit<br>
Download<br>
We distribute a PHP Archive (PHAR) that contains everything you need in order to use PHPUnit. Simply download it from here, make it executable, and put it into your $PATH, for instance:<br>

➜ wget https://phar.phpunit.de/phpunit.phar<br>

➜ chmod +x phpunit.phar<br>

➜ sudo mv phpunit.phar /usr/local/bin/phpunit<br>

➜ phpunit --version<br>
PHPUnit 4.4.0 by Sebastian Bergmann.<br>
You can also immediately use the PHAR after you have downloaded it, of course:<br>

➜ wget https://phar.phpunit.de/phpunit.phar<br>

➜ php phpunit.phar --version<br>
PHPUnit 4.4.0 by Sebastian Bergmann<br>

#### 使用
使用方式有好几种，详细使用说明可以参考官方文档 http://www.phpunit.cn/<br>

这里我把我的使用告知下。难免有错误的地方请提出来，感谢！！<br>

强调几点：
1）大致流程 setup->test××->teardown;<br>
2）setUp：test测试方法调用前执行，用于初始化测试数据。<br>
3）tearDown：test测试方法执行结束后运行，用于清理测试公共数据。<br>
4）provider：phpunit提供@dataProvider标签，则在你的test方法上加上此标签，则数据会自动映射到该标签的方法里面。<br>


联系请移步 https://github.com/taozywu/JD<br>

参考文件：ExampleTest.php
