<?php

namespace App\Enums;

use ReflectionClass;

enum UserGender: int
{
  case MALE = 1;
  case FEMALE = 2;

  public function isMale(): bool
  {
    return $this === self::MALE;
  }

  public function isFemale(): bool
  {
    return $this === self::FEMALE;
  }

  public function getLabelText(): string
  {
    return match ($this) {
      self::MALE => 'Male',
      self::FEMALE => 'Female'
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
}