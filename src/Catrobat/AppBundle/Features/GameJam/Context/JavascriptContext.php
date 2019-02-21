<?php

namespace Catrobat\AppBundle\Features\GameJam\Context;


use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Catrobat\AppBundle\Entity\User;
use Symfony\Component\HttpKernel\KernelInterface;
use Catrobat\AppBundle\Features\Helpers\SymfonySupport;


/**
 * Class JavascriptContext
 * @package Catrobat\AppBundle\Features\GameJam\Context
 */
class JavascriptContext extends MinkContext implements KernelAwareContext
{
  /**
   *
   */
  const FIXTUREDIR = './testdata/DataFixtures/';

  /**
   * @var SymfonySupport
   */
  private $symfony_support;

  /**
   * @var User
   */
  private $i;

  /**
   * JavascriptContext constructor.
   */
  public function __construct()
  {
    $this->symfony_support = new SymfonySupport(self::FIXTUREDIR);
  }

  /*
   * (non-PHPdoc)
   * @see \Behat\Symfony2Extension\Context\KernelAwareContext::setKernel()
   */
  /**
   * @param KernelInterface $kernel
   */
  public function setKernel(KernelInterface $kernel)
  {
    $this->symfony_support->setKernel($kernel);
  }

  /**
   * @return SymfonySupport
   */
  public function getSymfonySupport()
  {
    return $this->symfony_support;
  }

  /**
   * @Given I am logged in
   */
  public function iAmLoggedIn()
  {
    $this->i = $this->getSymfonySupport()->insertUser(['name' => 'Generated', 'password' => 'generated']);
    $this->visitPath("/pocketcode/login");
    $this->fillField("username", "Generated");
    $this->fillField("password", "generated");
    $button = $this->getSession()->getPage()->find("css", "#_submit");
    $button->click();
  }

  /**
   * @Given I have a limited account
   *
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function iHaveALimitedAccount()
  {
    $this->i->setLimited(true);
    $this->getSymfonySupport()->getManager()->persist($this->i);
    $this->getSymfonySupport()->getManager()->flush($this->i);
  }

  /**
   * @Given I have a program named :arg1
   *
   * @param $arg1
   *
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function iHaveAProgramNamed($arg1)
  {
    $this->getSymfonySupport()->insertProgram($this->i, ['name' => $arg1]);
  }

  /**
   * @When I visit my profile
   */
  public function iVisitMyProfile()
  {
    $this->visit("/pocketcode/profile");
  }

  /**
   * @Then I see the program :arg1
   *
   * @param $arg1
   */
  public function iSeeTheProgram($arg1)
  {
    $this->assertPageContainsText($arg1);
  }

  /**
   * @Then I do not see a delete button
   */
  public function iDoNotSeeADeleteButton()
  {
    $this->assertElementNotOnPage(".img-delete");
  }
}
