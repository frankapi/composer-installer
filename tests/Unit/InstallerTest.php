<?php

use Composer\Composer;
use Composer\Config;
use Composer\Downloader\DownloadManager;
use Composer\IO\IOInterface;
use PHPUnit\Framework\TestCase;
use FrankApi\Composer\Installer;
use Mockery\Mock;

class InstallerTest extends TestCase
{

  public function testReturnsFalseIfPackageTypeDoesNotMatchOneOfTheAllowedOnes()
  {

    $ioInterfaceMock = Mockery::mock(IOInterface::class);
    /** @var Mock $configMock */
    $configMock = Mockery::mock(Config::class);
    $configMock
      ->shouldReceive('get')
      ->with('vendor-dir')
      ->andReturn('vendor');

    $configMock
      ->shouldReceive('get')
      ->with('bin-dir')
      ->andReturn('vendor/bin');
    
    $configMock
      ->shouldReceive('get')
      ->with('bin-compat')
      ->andReturn('auto');
      
    $composerMock = Mockery::mock(Composer::class);
    /** @var Mock $composerMock */
    /** @var IOInterface $ioInterfaceMock */
    $composerMock->shouldReceive('getDownloadManager')
      ->andReturn(new DownloadManager($ioInterfaceMock));
    $composerMock->shouldReceive('getConfig')
      ->andReturn($configMock);

    /** @var Composer $composerMock */
    $subject = new Installer($ioInterfaceMock, $composerMock, 'library');

    $this->assertFalse($subject->supports('library'));

  }


}