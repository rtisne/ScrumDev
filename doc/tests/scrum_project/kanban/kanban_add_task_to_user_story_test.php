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
    $this->assertTrue((bool)preg_match('/http:\/\/localhost\/ScrumDev\/src\/web\/kanban.php\?id_project=+[1-9]\&id_sprint=+[1-9]/',$this->getLocation()));
    $this->click("xpath=(//button[@type='button'])[8]");
    $this->assertEquals("Creer une tâche", $this->getText("css=h4.modal-title"));
    $this->assertEquals("Titre de la tâche", $this->getText("css=label"));
    $this->type("name=title", "Tache one");
    $this->assertEquals("Detail", $this->getText("css=label.control-label"));
    $this->type("name=detail", "Première tâche");
    $this->assertEquals("Développeur", $this->getText("//div[@id='createTaskmodal']/div/div/form/div/div[3]/label"));
    $this->assertEquals("Dépendences", $this->getText("//div[@id='createTaskmodal']/div/div/form/div/div[4]/label"));
    $this->click("name=submit");
    $this->waitForPageToLoad("30000");
    $this->assertTrue((bool)preg_match('/http:\/\/localhost\/ScrumDev\/src\/web\/kanban.php\?id_project.+[1-9]\&id_sprint.+[1-9]/',$this->getLocation()));
    }
}
?>