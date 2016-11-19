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
    $this->click("css=h3.panel-title");
    $this->waitForPageToLoad("30000");
    $this->click("link=Configuration");
    $this->waitForPageToLoad("30000");
    $this->verifyText("css=h2.text-center", "Modifier le projet");
    $this->assertEquals("Nom", $this->getText("css=label.col-sm-2.control-label"));
    $this->type("name=name", "Scrumify");
    $this->assertEquals("Description", $this->getText("//div[2]/label"));
    $this->type("name=description", "Méthode agile dev");
    $this->assertEquals("Membres", $this->getText("//div[3]/label"));
    $this->assertEquals("Product Owner", $this->getText("//div[4]/label"));
    $this->click("name=submit");
    $this->waitForPageToLoad("30000");
    $this->assertTrue((bool)preg_match('/http:\/\/localhost\/ScrumDev\/src\/web\/homeProject.php\?id_project=*[0-9]/',$this->getLocation()));
  }
}
?>