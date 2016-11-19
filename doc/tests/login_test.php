<?php
class Example extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*chrome");
    $this->setBrowserUrl("http://localhost/");
  }

  public function testMyTestCase()
  {
    $this->open("/ScrumDev/src/web/signin.php");
    $this->type("id=email", "ismo1652@hotmail.fr");
    $this->type("id=password", "hello");
    $this->click("name=submit");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("http://localhost/ScrumDev/src/web/listProjects.php", $this->getLocation());
    $this->assertTrue($this->isElementPresent("link=TRAORE Ismael"));
    $this->assertTrue($this->isElementPresent("//button[@type='button']"));
  }
}
?>