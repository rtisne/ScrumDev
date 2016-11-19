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
    $this->open("/ScrumDev/src/web/signin.php");
    $this->assertEquals("http://localhost/ScrumDev/src/web/listProjects.php", $this->getLocation());
    $this->open("/ScrumDev/src/web/signin.php");
    $this->assertEquals("http://localhost/ScrumDev/src/web/listProjects.php", $this->getLocation());
  }
}
?>