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
    $this->click("link=US#3");
    $this->click("id=removeUS");
  }
}
?>