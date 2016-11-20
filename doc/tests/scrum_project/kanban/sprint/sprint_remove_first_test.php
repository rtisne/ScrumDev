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
    $this->assertTrue((bool)preg_match('/http:\/\/localhost\/ScrumDev\/src\/web\/sprintsProject.php\?id_project=+[1-9]/',$this->getLocation()));
    $sprint_number = $this->getText("css=tbody > tr > th.text-center");
    $this->click("link=Supprimer");
    $this->waitForPageToLoad("30000");
 	// suppose that sprint number is unique for a project
    $this->assertNotEquals($sprint_number, $this->getText("css=tbody > tr > th.text-center"));  }
}
?>