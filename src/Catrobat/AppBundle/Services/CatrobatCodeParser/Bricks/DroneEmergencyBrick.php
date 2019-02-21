<?php

namespace Catrobat\AppBundle\Services\CatrobatCodeParser\Bricks;

use Catrobat\AppBundle\Services\CatrobatCodeParser\Constants;

/**
 * Class DroneEmergencyBrick
 * @package Catrobat\AppBundle\Services\CatrobatCodeParser\Bricks
 */
class DroneEmergencyBrick extends Brick
{
  /**
   *
   */
  protected function create()
  {
    $this->type = Constants::AR_DRONE_EMERGENCY_BRICK;
    $this->caption = "Emergency";

    $this->setImgFile(Constants::AR_DRONE_BRICK_IMG);
  }
}