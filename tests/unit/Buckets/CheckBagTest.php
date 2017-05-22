<?php
namespace Buckets;


use Phizzl\HeartbeatTools\Buckets\CheckBag;

class CheckBagTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testConstruct()
    {
        $testObject = new CheckBag();
        $this->assertSame(0, count($testObject->all()));
    }

    public function testAddCheck(){
        $testObject = new CheckBag();
        $mockedCheck = $this->createMock('Phizzl\HeartbeatTools\Checks\AbstractCheck');

        $testObject->addCheck($mockedCheck);
        $this->assertSame(1, count($testObject->all()));
    }
}