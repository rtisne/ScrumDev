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
    $this->click("link=Visitor visiteur");
    $this->click("id=logout_link");
    $this->waitForPageToLoad("30000");
    $this->assertEquals("http://localhost/ScrumDev/src/web/signin.php", $this->getLocation());
  }
}
?>