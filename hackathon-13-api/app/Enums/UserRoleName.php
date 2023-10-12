<?php

namespace App\Enums;

use ReflectionClass;

enum UserRoleName: int
{
  case ADMINISTRATOR = 1;
  case EMPLOYEE = 2;
  case PARTNER = 3;
  case GUEST = 4;

  public function isAdministrator(): bool
  {
    return $this === self::ADMINISTRATOR;
  }

  public function isEmployee(): bool
  {
    return $this === self::EMPLOYEE;
  }

  public function isPartner(): bool
  {
    return $this === self::PARTNER;
  }

  public function isGuest(): bool
  {
    return $this === self::GUEST;
  }

  public function getBadgeText(): string
  {
    return match ($this) {
      self::ADMINISTRATOR => 'Administrator',
      self::EMPLOYEE => 'Employee',
      self::PARTNER => 'Partner',
      self::GUEST => 'Guest'
    };
  }

  public static function toArray(): array
  {
    $reflection = new ReflectionClass(self::class);

    return array_values($reflection->getConstants());
  }

  public static function count(): int
  {
    $reflection = new ReflectionClass(self::class);

    return count($reflection->getConstants());
  }

  public function getBadgeColor(): string
  {
    return match ($this) {
      self::ADMINISTRATOR => 'text-bg-danger',
      self::EMPLOYEE => 'text-bg-primary',
      self::PARTNER => 'text-bg-success',
      self::GUEST => 'text-bg-info',
    };
  }

  public function getBadgeHTML(): string
  {
    return sprintf('<span class="badge %s">%s</span>',
      $this->getBadgeColor(), $this->getBadgeText());
  }
}