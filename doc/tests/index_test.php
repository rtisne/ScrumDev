<?php
include_once('conf.php');
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
      $this->assertEquals("Scrumify", $this->title());
      $this->assertEquals("Connexion", $this->byCssSelector("h2.text-center")->text());
      $this->assertTrue($this->byLinkText("Connexion")->size()!=0);
      $this->assertTrue($this->byLinkText("Inscription")->size()!=0);
      $this->assertTrue($this->byName('email')->size()!=0);
      $this->assertTrue($this->byName('password')->size()!=0);
      $this->assertTrue($this->byName('submit')->size()!=0);
  }
}
?>