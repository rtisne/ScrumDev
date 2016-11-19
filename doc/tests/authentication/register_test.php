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
    $this->click("link=Inscription");
    $this->waitForPageToLoad("30000");
    $this->verifyText("css=h2.text-center", "Inscription");
    $this->assertEquals("Nom", $this->getText("css=label.col-sm-2.control-label"));
    $this->type("id=last_name", "Visitor");
    $this->assertEquals("Prenom", $this->getText("//div[2]/label"));
    $this->type("id=first_name", "visiteur");
    $this->assertEquals("Email", $this->getText("//div[3]/label"));
    $this->type("id=email", "visiteur@hotmail.fr");
    $this->assertEquals("Password", $this->getText("//div[4]/label"));
    $this->type("id=password", "visiteurScrum");
    $this->click("name=submit");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("http://localhost/ScrumDev/src/web/listProjects.php", $this->getLocation());
  }
}
?>