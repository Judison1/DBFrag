<?php 
use PHPUnit\Framework\TestCase;
use Judison1\DBFrag\Fragmentation;
/**
*  Corresponding Class to test Fragmentation class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author yourname
*/
class FragmentationTest extends TestCase
{

    /**
    * Just check if the Fragmentation has no syntax error
    *
    * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
    * any typo before you even use this library in a real project.
    *
    */
    public function testIsThereAnySyntaxError()
    {
    $var = new Fragmentation();
    $this->assertTrue(is_object($var));
    unset($var);
    }
    /**
    * Just check if the Fragmentation has no syntax error
    *
    * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
    * any typo before you even use this library in a real project.
    *
    */
    public function testFragByArray()
    {

        $frag = new Fragmentation();
        $user1  = array(
            'id' => 1,
            'updated_at' => '2018-10-24 14:18:17',
            'nome' => "John Doe",
            'nome_updated_at' => '2018-10-24 14:18:17',
            'email' => "johndoe@email.com",
            'email_updated_at' => '2018-10-24 12:18:17',
            'senha' => "johndoe@email.com",
            'senha_updated_at' => '2018-10-24 12:18:17',
            'cpf' => '155.555.258-52',
            'cpf_updated_at' => '2018-10-24 14:18:17',
            'rg' => '154652',
            'rg_updated_at' => '2018-10-24 14:18:17'
      );
      $expected = array(
          'id' => 1,
          'nome' => "John Doe",
      );

      $actual = $frag->fragByArray('2018-10-24 12:18:17', $user1, ['usuario']);

      $this->assertEquals($expected,$actual);

      unset($frag);
      unset($user1);
      unset($expected);
      unset($actual);
    }

    public function testFragByArrays()
    {

        $frag = new Fragmentation();
        $user1  = array(
            array(
            'id' => 1,
            'updated_at' => '2018-10-24 14:18:17',
            'nome' => "John Doe",
            'nome_updated_at' => '2018-10-24 14:18:17',
            'email' => "johndoe@email.com",
            'email_updated_at' => '2018-10-24 12:18:17',
            'senha' => "johndoe@email.com",
            'senha_updated_at' => '2018-10-24 12:18:17',
            'cpf' => '155.555.258-52',
            'cpf_updated_at' => '2018-10-24 14:18:17',
            'rg' => '154652',
            'rg_updated_at' => '2018-10-24 14:18:17'
        ),
            array(
                'id' => 2,
                'updated_at' => '2018-10-24 14:18:17',
                'nome' => "John Doe",
                'nome_updated_at' => '2018-10-24 14:18:17',
                'email' => "johndoe@email.com",
                'email_updated_at' => '2018-10-24 12:18:17',
                'senha' => "johndoe@email.com",
                'senha_updated_at' => '2018-10-24 12:18:17',
                'cpf' => '155.555.258-52',
                'cpf_updated_at' => '2018-10-24 14:18:17',
                'rg' => '154652',
                'rg_updated_at' => '2018-10-24 14:18:17'
            ));
        $expected = array(
            array(
            'id' => 1,
            'updated_at' => '2018-10-24 14:18:17',
            'nome' => "John Doe",
        )  ,array(
                'id' => 2,
                'updated_at' => '2018-10-24 14:18:17',
                'nome' => "John Doe",
            )
        );

        $actual = $frag->fragByArrays('2018-10-24 12:18:17', $user1, ['usuario']);

        $this->assertEquals($expected,$actual);

        unset($frag);
        unset($user1);
        unset($expected);
        unset($actual);
    }
    public function fragUpgradeTest(){

    }

}
