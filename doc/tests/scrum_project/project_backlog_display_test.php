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
    $this->assertTrue((bool)preg_match('/http:\/\/localhost\/ScrumDev\/src\/web\/backlogProject.php\?id_project=+[1-9]/',$this->getLocation()));
    $this->click("link=Backlog");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("xpath=(//button[@type='button'])[7]"));
  }
}
?>