<?php
/**
 * 测试
 *
 * @author taozywu <wutaoa@***.com>
 * @date 2016/05/18
 * CMD: ./phpunit --bootstrap ./init.php ./Test/ExampleTest.php 
 */

namespace Test;

ini_set('display_errors', 'On');
error_reporting(E_ALL);

/**
 * Example Test Case.
 */
class ExampleTest extends \PHPUnit_Framework_TestCase
{

    private $testFlag = true;
    
    /**
     * SetUp.
     *
     * @return boolean.
     */
    public function setUp()
    {
        $this->stack = array();
        return true;
    }

    /**
     * TearDown.
     *
     * @return boolean.
     */
    public function tearDown()
    {
        if ($this->testFlag === false) {
            echo "\n==============TEST FAILED===========\n\n";
        }
        return true;
    }

    /**
     * 测试处理.
     * 
     * @param array $d D参数.
     * 
     * @return mixed.
     */
    public function test(array $d)
    {
        $className = $d['class'];
        $this->testFlag = true;

        $class = new \ReflectionClass($className);
        $classInstance = $class->newInstance();
        $action = $class->getMethod($d['method']);
        $result = $action->invokeArgs($classInstance, $d['args']);

        echo "\n".$d['testname']."==>$className::{$d['method']} ";

        // 针对有回调的情况处理.
        if (isset($d['callback'])) {
            if ($result) {
                echo "IS OK\n\n";
                $this->callbackClass($d['callback'], $result);
                unset($d['callback']);
            }

            unset($d, $result, $class, $classInstance);

            return true;
        }

        // 无回调的情况处理。
        if ($d['result'] === $result) {
            echo "IS OK\n\n";
        } else {
            echo "\nresult=" . var_export($result, true);
            $this->testFlag = false;
        }

        unset($d, $result, $class, $classInstance);

        return true;
    }

    /**
     * 处理回调情况.
     * 
     * @param array $callback Callback.
     * @param mixed $id       ID.
     * 
     * @return mixed.
     */
    private function callbackClass(array $callback, $id)
    {
        foreach ($callback as $ck => $cv) {
            $class = new \ReflectionClass($cv['class']);
            $classInstance = $class->newInstance();
            $action = $class->getMethod($cv['method']);
            // 处理key
            if (isset($cv['argk'])) {
                $cv['args'] = str_replace($cv['argk'], $id, $cv['args']);
            }
            $result = $action->invokeArgs($classInstance, $cv['args']);

            echo "\nDATA=" . var_export($result, true)."\n";
            unset($class, $classInstance);
        }
        unset($callback);
        return true;
    }

    /**
     * Data provider.
     * 
     * @return array.
     */
    public function additionProvider()
    {
        $data = array();
        
        // 获取基本信息
        $data[][] = array(
                'testname' => 'getExampleInfo',
                'result' => array (
                    'tid' => '3428',
                    'taskstatus' => '4',
                ),
                'class' => 'Example',
                'method' => 'getExampleInfo',
                'args' => array(1, 3428)
        );

        // 获取H5首页
        $data[][] = array(
                'testname' => 'getIndex',
                'result' => array (
                    "overview_count" => array(0,1,0,2,12,152),
                    "today_count" => 0,
                    "recently_count" => 0,
                    "manage_count" => 130,
                    "assign_count" => 144,
                    "join_count" => 13,
                    "know_count" => 7,
                    "today_list" => [],
                    "recently_list" => []
                ),
                'class' => 'Example',
                'method' => 'getIndex',
                'args' => array(1, 3922)
        );

        // 添加
        $data[][] = array(
                'testname' => 'add',
                'result' => null,
                'class' => 'Example',
                'method' => 'edit',
                'args' => array(1, 3922, 0, "good", "good text", "12345", "67890", '3922', array(1,2,3), array(4,5,6), array(1,2,3), array(), array(1,2,3), 1, 1, 1, 1),
                'callback' => array (
                    '0' => array (
                        'class' => 'Example',
                        'method' => 'getExampleInfo',
                        'argk' => '__tid__',
                        'args' => array(1,'__tid__','*')
                    ),
                )
        );

        return $data;
    }

}
