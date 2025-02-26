<?php

namespace App\DB\Entity\Project;

use App\DB\Entity\User\User;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="program_downloads")
 */
class ProgramDownloads
{
  final public const TYPE_PROJECT = 'project';
  final public const TYPE_APK = 'apk';

  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected ?int $id = null;

  /**
   * @ORM\ManyToOne(targetEntity=Program::class, inversedBy="program_downloads")
   * @ORM\JoinColumn(name="program_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
   */
  protected Program $program;

  /**
   * @ORM\ManyToOne(targetEntity=User::class)
   * @ORM\JoinColumn(name="user", referencedColumnName="id", nullable=true, onDelete="SET NULL")
   */
  protected ?User $user = null;

  /**
   * @ORM\Column(type="datetime")
   */
  protected ?\DateTime $downloaded_at = null;

  /**
   * @ORM\Column(type="string", options={"default": "project"})
   */
  protected ?string $type = self::TYPE_PROJECT;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function setId(int $id): ProgramDownloads
  {
    $this->id = $id;

    return $this;
  }

  public function getProgram(): Program
  {
    return $this->program;
  }

  public function setProgram(Program $program): ProgramDownloads
  {
    $this->program = $program;

    return $this;
  }

  public function getUser(): ?User
  {
    return $this->user;
  }

  public function setUser(?User $user): ProgramDownloads
  {
    $this->user = $user;

    return $this;
  }

  public function getDownloadedAt(): ?\DateTime
  {
    return $this->downloaded_at;
  }

  public function setDownloadedAt(?\DateTime $downloaded_at): ProgramDownloads
  {
    $this->downloaded_at = $downloaded_at;

    return $this;
  }

  public function getType(): ?string
  {
    return $this->type;
  }

  public function setType(?string $type): ProgramDownloads
  {
    $this->type = $type;

    return $this;
  }
}
