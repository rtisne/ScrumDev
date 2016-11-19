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
    $this->open("/ScrumDev/src/web/kanban.php?id_project=3&id_sprint=22");
    $this->click("css=div.name_implementer.text-primary");
    $this->assertEquals("Modifier une tâche", $this->getText("css=#updateTaskmodal > div.modal-dialog > div.modal-content > div.modal-header > h4.modal-title"));
    $this->assertEquals("Titre de la tâche", $this->getText("css=#updateTaskmodal > div.modal-dialog > div.modal-content > form > div.modal-body > div.form-group > label"));
    $this->type("id=update_form__task_title", "Tache one modified");
    $this->assertEquals("Detail", $this->getText("css=#updateTaskmodal > div.modal-dialog > div.modal-content > form > div.modal-body > div.form-group > label.control-label"));
    $this->type("id=update_form__task_description", "modified");
    $this->assertEquals("Développeur", $this->getText("//div[@id='updateTaskmodal']/div/div/form/div/div[3]/label"));
    $this->select("id=update_form__task_implementer", "label=Ismael TRAORE");
    $this->assertEquals("Dépendences", $this->getText("//div[@id='updateTaskmodal']/div/div/form/div/div[4]/label"));
    $this->select("css=#updateTaskmodal > div.modal-dialog > div.modal-content > form > div.modal-body > div.form-group > div > ul.list-group.list_member > li.list-group-item > div.dropdown.dropdown-input > select[name=\"tasks\"]", "label=-- Selectionner une tâche --");
    $this->select("css=#updateTaskmodal > div.modal-dialog > div.modal-content > form > div.modal-body > div.form-group > div > ul.list-group.list_member > li.list-group-item > div.dropdown.dropdown-input > select[name=\"tasks\"]", "label=-- Selectionner une tâche --");
    $this->select("css=#updateTaskmodal > div.modal-dialog > div.modal-content > form > div.modal-body > div.form-group > div > ul.list-group.list_member > li.list-group-item > div.dropdown.dropdown-input > select[name=\"tasks\"]", "label=-- Selectionner une tâche --");
    $this->click("xpath=(//button[@name='submit'])[3]");
    $this->waitForPageToLoad("30000");
    $this->assertTrue((bool)preg_match('/http:\/\/localhost\/ScrumDev\/src\/web\/kanban.php\?id_project.*[0-9]\&id_sprint.*[0-9]/',$this->getLocation()));
  }
}
?>