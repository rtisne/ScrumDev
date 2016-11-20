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
    $this->click("//button[@type='button']");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("http://localhost/ScrumDev/src/web/createProject.php", $this->getLocation());
    $this->verifyText("css=h2.text-center", "Creer un nouveau projet");
    $this->assertTrue($this->isElementPresent("//label['text()=Nom du projet']"));
    $this->type("name=name", "Scrum");
    $this->assertTrue($this->isElementPresent("//label['text()=Description du projet']"));
    $this->type("name=description", "Méthode agile");
    $this->assertTrue($this->isElementPresent("//label['text()=Membre']"));
    $this->type("id=add_member_input", "thom");
    $this->type("id=add_member_input", "romai");
    $this->assertTrue($this->isElementPresent("//label['text()=Product Owner']"));
    $this->click("name=submit");
    $this->waitForPageToLoad("30000");
    $this->verifyText("css=h3.panel-title", "Scrum");
    $this->verifyText("css=div.panel-body", "Méthode agile");
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
    $this->assertTrue((bool)preg_match('/http:\/\/localhost\/ScrumDev\/src\/web\/homeProject.php\?id_project=+[1-9]/',$this->getLocation()));
    $this->assertTrue($this->isElementPresent("link=Home"));
    $this->assertEquals("Home", $this->getText("link=Home"));
    $this->assertEquals("Description du projet", $this->getText("css=h3.panel-title"));
  }
}
?>