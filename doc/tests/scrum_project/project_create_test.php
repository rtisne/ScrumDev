<?php
include_once('config.php');
class Example extends PHPUnit_Extensions_Selenium2TestCase
{
  protected function setUp()
  {
      $this->setBrowser('chrome');
      $this->setBrowserUrl($GLOBALS['serverPath']);
  }

  public function testCreateProject()
  {
      $this->url('listProjects.php');
      $this->byCssSelector('button')->click();
      $this->timeouts()->implicitWait(30000);
      $this->assertContains('createProjects.php', $this->url());
      $this->byName('name')->value('Mon super projet');
      $this->byName('description')->value('Description de mon super projet.');
      $this->byId('add_member_input')->value('thom');
      $this->byId('member_proposal')->click();
      $this->byName('product_owner')->selectOptionByValue(1);
      $this->byName('submit')->click();

  }
}

/*
$this->open("/ScrumDev/src/web/listProjects.php");
$this->click("//button[@type='button']");
$this->waitForPageToLoad("30000");
$this->assertEquals("http://localhost/ScrumDev/src/web/createProject.php", $this->getLocation());
$this->verifyText("css=h2.text-center", "Creer un nouveau projet");
$this->assertTrue($this->isElementPresent("//label['text()=Nom du projet']"));
$this->type("name=name", "Scrum");
$this->assertTrue($this->isElementPresent("//label['text()=Description du projet']"));
$this->type("name=description", "Méthode agile");
$this->assertTrue($this->isElementPresent("//label['text()=Membre']"));
$this->type("id=add_member_input", "thom");
$this->type("id=add_member_input", "romai");
$this->assertTrue($this->isElementPresent("//label['text()=Product Owner']"));
$this->click("name=submit");
$this->waitForPageToLoad("30000");
$this->verifyText("css=h3.panel-title", "Scrum");
$this->verifyText("css=div.panel-body", "Méthode agile");
*/

?>