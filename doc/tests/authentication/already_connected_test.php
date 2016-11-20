<?php
include_once('conf.php');
class Example extends PHPUnit_Extensions_Selenium2TestCase
{
  protected function setUp()
  {
      $this->setBrowser("chrome");
      $this->setBrowserUrl($GLOBALS['serverPath']);
  }

  public function testMyTestCase()
  {
      $this->url("signin.php");
      $this->assertContains("listProjects.php", $this->getLocation());
  }
}
?>