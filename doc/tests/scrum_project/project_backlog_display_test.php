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
    $this->open("/ScrumDev/src/web/homeProject.php?id_project=3");
    $this->click("link=Backlog");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("xpath=(//button[@type='button'])[7]"));
  }
}
?>