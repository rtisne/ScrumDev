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
    $this->assertTrue((bool)preg_match('/http:\/\/localhost\/ScrumDev\/src\/web\/sprintsProject.php\?id_project=[1-9]+\&id_sprint=[1-9]+/',$this->getLocation()));
    $this->click("link=Sprint one");
    $this->waitForPageToLoad("30000");
    $this->assertTrue((bool)preg_match('/http:\/\/localhost\/ScrumDev\/src\/web\/kanban.php\?id_project=+[1-9]\&id_sprint=+[1-9]/',$this->getLocation()));
    $this->click("css=th.text-center > button.btn.btn-primary");
    $this->assertEquals("Liste des US", $this->getText("css=#addUSToKanbanmodal > div.modal-dialog > div.modal-content > form > div.modal-body > div.form-group > label.control-label"));
    $this->click("id=addUS");
    $this->assertTrue((bool)preg_match('/http:\/\/localhost\/ScrumDev\/src\/web\/kanban.php\?id_project=+[1-9]\&id_sprint=+[1-9]/',$this->getLocation()));
    $this->assertTrue($this->isElementPresent("link=regexp:US#[1-9]+$"));
  }
}
?>