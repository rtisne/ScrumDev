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
    $this->click("xpath=(//button[@type='button'])[3]");
    $this->verifyText("css=h4.modal-title", "Creer un sprint");
    $this->verifyText("css=label", "Titre du sprint");
    $this->type("id=title", "Sprint one");
    $this->verifyText("//div[@id='createSprintmodal']/div/div/form/div/div[2]/label", "Date de début");
    $this->click("css=i.glyphicon.glyphicon-th");
    $this->click("css=span.input-group-addon");
    $this->type("id=date_start", "2016/11/19");
    $this->verifyText("//div[@id='createSprintmodal']/div/div/form/div/div[3]/label", "Date de fin");
    $this->click("css=i.glyphicon.glyphicon-th");
    $this->click("//tr[4]/td[7]");
    $this->type("id=date_end", "2016/11/26");
    $this->click("name=submit");
    $this->waitForPageToLoad("30000");
    $this->assertTrue((bool)preg_match('/http:\/\/localhost\/ScrumDev\/src\/web\/kanban.php\?id_project=+[1-9]\&id_sprint=+[1-9]/',$this->getLocation()));
  }
}
?>