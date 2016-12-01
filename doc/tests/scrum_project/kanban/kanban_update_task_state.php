<?php
class Example extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*chrome");
    $this->setBrowserUrl("http://scrum.dev/");
  }

  public function testMyTestCase()
  {
    $this->dragAndDropToObject("css=div.panel-heading.text-center", "css=td#column2");
    $this->click("link=Sprints");
    $this->waitForPageToLoad("30000");
    $this->click("link=Sprint 1");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isElementPresent("//td[@id='column2']/div"));
  }
}
?>