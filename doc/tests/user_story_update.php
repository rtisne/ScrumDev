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
    $this->open("/ScrumDev/src/web/backlogProject.php?id_project=3&page=2");
    $this->click("//td[7]/button");
    $this->type("id=update_form__user_story_title", "En tant que membre je souhaite me désinscrire pour supprimer ma session");
    $this->type("id=update_form__user_story_description", "Pour raison de sécurité informatique");
    $this->type("id=update_form__user_story_cost", "2");
    $this->type("id=update_form__user_story_priority", "1");
    $this->click("css=#edit_user_story > div.modal-dialog > form > div.modal-content > div.modal-footer. > button[name=\"submit\"]");
    $this->waitForPageToLoad("30000");
    $this->assertTrue((bool)preg_match('/^http:\/\/localhost\/ScrumDev\/src\/web\/backlogProject\.php[\s\S]id_project=3&page=2$/',$this->getLocation()));
  }
}
?>