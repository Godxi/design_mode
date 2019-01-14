<?php
/**
 *
 * 角色
 * 1.抽象组件角色(Component):定义一个对象接口，以规范准备接受附加责任的对象，即可以给这些对象动态地添加职责。
 * 2.具体组件角色(ConcreteComponent):被装饰者，定义一个将要被装饰增加功能的类。可以给这个对象添加一些职责。
 * 3.抽象装饰器(Decorator):维持一个指向构建Component对象的实例，并定义一个与抽象组件角色Component接口一致的接口。
 * 4.具体装饰器角色(ConcreteDecorator):想组件添加职责。
 *
 *
 * 适用场景
 * 1.需要动态地给一个对象添加功能，这些功能可以再动态地撤销
 * 2.需要增加由一些基本功能的排列组合而产生的非常大量的功能，从而使继承关系变得不现实。
 * 3.当不能采用生成子类的方法进行扩充时。一种情况是，可能有大量独立的扩展，为支持每一种组合将产生大量的子类，使得子类数目呈爆炸式增长。另一种情况
 * 可能是因为类定义被隐藏，或类定义不能用于生成子类。
 *
 *
 * Created by PhpStorm.
 * User: 25380
 * Date: 2019/1/14 0014
 * Time: 下午 4:02
 */

//header('Content-type:text/html;charset=utf-8');

/**
 * Interface IComponent 组件对象接口
 */
interface IComponent
{
    public function display();
}

/**
 * Class Person 待装饰对象
 */
class Person implements IComponent
{
    private $_name;

    public function __construct($name)
    {
        $this->_name = $name;
    }

    public function display()
    {
        echo "装扮着：{$this->_name}<br />";
    }
}

/**
 * Class Clothes 所有装饰器父类-服装类
 */
class Clothes implements IComponent
{
    public function display()
    {
        if(!empty($this->component))
        {
            $this->component->display();
        }
    }

    protected $component;

    /**
     * 接受装饰器对象
     *
     * @param IComponent $component
     */
    public function decorate(IComponent $component)
    {
        $this->component = $component;
    }
}

//下面为具体装饰器类

/**
 * Class Sneaker 运动鞋
 */
class Sneaker extends Clothes
{
    public function display()
    {
        echo '运动鞋 ';
        parent::display();
    }
}


/**
 * Class Tshirt T恤
 */
class Tshirt extends Clothes
{
    public function display()
    {
        echo 'T恤 ';
        parent::display();
    }
}


/**
 * Class Coat 外套
 */
class Coat extends Clothes
{
    public function display()
    {
        echo '外套 ';
        parent::display();
    }
}

/**
 * Class Trousers 裤子
 */
class Trousers extends Clothes
{
    public function display()
    {
        echo '裤子 ';
        parent::display();
    }
}

/**
 * Class Client 客户端测试代码
 */
class Client
{
    public static function test()
    {
        $zhangsan = new Person('张三');
        $lisi = new Person('李四');

        $sneaker = new Sneaker();
        $coat = new Coat();

        $sneaker->decorate($zhangsan);
        $coat->decorate($sneaker);
        $coat->display();

        echo '<hr />';


        $trousers = new Trousers();
        $tshirt = new Tshirt();

        $trousers->decorate($lisi);
        $tshirt->decorate($trousers);
        $tshirt->display();


    }


}


client::test();


