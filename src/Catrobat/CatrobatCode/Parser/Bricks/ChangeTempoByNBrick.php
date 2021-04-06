<?php

namespace App\Catrobat\CatrobatCode\Parser\Bricks;

use App\Catrobat\CatrobatCode\Parser\Constants;

class ChangeTempoByNBrick extends Brick
{
  protected function create(): void
  {
    $this->type = Constants::CHANGE_TEMPO_BY_N_BRICK;
    $this->caption = 'Change tempo by _';
    $this->setImgFile(Constants::SOUND_BRICK_IMG);
  }
}
