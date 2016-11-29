<?php
include_once("conf.php");

class Example extends PHPUnit_Extensions_Selenium2TestCase
{
  protected function setUp()
  {
      $this->setBrowser("chrome");
      $this->setBrowserUrl($GLOBALS['serverPath']);
  }

  public function testPage()
  {
      $this->url("signin.php");
      $this->assertEquals( $this->byCssSelector("h2.text-center")->text(), "Connexion");
      $this->assertTrue($this->byName('email')->size()!=0);
      $this->assertTrue($this->byName('password')->size()!=0);
      $this->assertTrue($this->byName('submit')->size()!=0);

  }

  public function testLogin()
  {
      $this->url("signin.php");
      $this->byName('email')->value('jeandupond@hotmail.fr');
      $this->byName('password')->value('password');
      $this->byName('submit')->click();
      $this->timeouts()->implicitWait(30000);
      $this->assertContains('listProjects.php', $this->url());
      $this->assertEquals( $this->byCssSelector(".nav .dropdown a")->text(), "Dupond Jean");
  }
}
?>