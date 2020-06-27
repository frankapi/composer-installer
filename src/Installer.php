<?php

namespace FrankApi\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class Installer extends LibraryInstaller
{


  /**
   * @param PackageInterface $package
   * 
   * @return string
   */
  public function getInstallPath(PackageInterface $package): string
  {
    $type = $package->getType();

    $packageTypesFolderMap = $this->packageTypesFolderMap();
    if ($packageTypesFolderMap[$type]) {
      var_dump($package->getPrettyName());
      return $packageTypesFolderMap[$type] .'/'. $package->getPrettyName();
    }

  }

  /**
   * @param mixed $packageType
   * 
   * @return bool
   */
  public function supports($packageType): bool
  {
    return array_key_exists($packageType, $this->packageTypesFolderMap());
  }

  /**
   * Returns the allowed Frank Api package types.
   * 
   * @return array
   */
  private function packageTypesFolderMap(): array
  {

    return [
      'frankapi-module' => 'modules',
      'frankapi-plugin' => 'plugins'
    ];

  }


}