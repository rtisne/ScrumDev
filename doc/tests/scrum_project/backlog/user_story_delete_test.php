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
    $this->open("/ScrumDev/src/web/backlogProject.php?id_project=3&page=1");
    $this->click("//td[8]/button");
    $this->click("css=div.modal-content > div.modal-footer. > button[name=\"submit\"]");
    $this->waitForPageToLoad("30000");
    $this->click("xpath=(//button[@type='button'])[7]");
  }
}
?>