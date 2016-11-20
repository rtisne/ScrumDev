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
    $this->open("/ScrumDev/src/web/listProjects.php");
    $this->click("css=div.panel-heading");
    $this->waitForPageToLoad("30000");
    $this->assertTrue((bool)preg_match('/http:\/\/localhost\/ScrumDev\/src\/web\/homeProject.php\?id_project=+[1-9]/',$this->getLocation()));
    $this->assertTrue($this->isElementPresent("link=Home"));
    $this->assertTrue($this->isElementPresent("link=Backlog"));
    $this->assertTrue($this->isElementPresent("link=Sprints"));
    $this->assertTrue($this->isElementPresent("link=Graphs"));
    $this->assertTrue($this->isElementPresent("link=Configuration"));
    $this->verifyText("css=h3.panel-title", "Description du projet");
  }
}
?>