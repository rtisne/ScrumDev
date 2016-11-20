<?php
include_once('conf.php');
class Example extends PHPUnit_Extensions_Selenium2TestCase
{
  protected function setUp()
  {
      $this->setBrowser('chrome');
      $this->setBrowserUrl($GLOBALS['serverPath']);
  }

  public function testLogout()
  {
      $this->url("signin.php");
      $this->byName('email')->value('jeandupond@hotmail.fr');
      $this->byName('password')->value('password');
      $this->byName('submit')->click();
      $this->timeouts()->implicitWait(30000);
      $this->byLinkText('Dupond Jean')->click();
      $this->byId('logout_link')->click();
      $this->timeouts()->implicitWait(30000);
      $this->assertContains('signin.php', $this->url());
  }
}
?>