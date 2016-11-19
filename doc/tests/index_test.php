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
    $this->open("http://localhost/ScrumDev/src/web/signin.php");
    $this->assertEquals("Scrumify", $this->getTitle());
    $this->assertEquals("Connexion", $this->getText("css=h2.text-center"));
    $this->assertTrue($this->isElementPresent("link=Connexion"));
    $this->assertTrue($this->isElementPresent("link=Inscription"));
    $this->verifyText("//label[text()='Email']", "Email");
    $this->verifyText("//label[text()='Password']", "Password");
    $this->assertTrue($this->isElementPresent("name=submit"));
  }
}
?>