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
    $this->open("/ScrumDev/src/web/backlogProject.php?id_project=3");
    $this->click("xpath=(//button[@type='button'])[7]");
    $this->type("name=title", "En tant que membre je souhaite me désinscrire");
    $this->type("name=description", "Pour raison de sécurité");
    $this->type("name=cost", "12");
    $this->type("name=priority", "14");
    $this->click("name=submit");
    $this->waitForPageToLoad("30000");
    $this->assertTrue((bool)preg_match('/^http:\/\/localhost\/ScrumDev\/src\/web\/backlogProject\.php[\s\S]id_project=3$/',$this->getLocation()));
  }
}
?>