<?php

namespace BjornJohansen\WPPreCommitHook;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Package\AliasPackage;
use Composer\Package\PackageInterface;
use Composer\Package\RootpackageInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;
use Composer\Script\ScriptEvents;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Exception\LogicException;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Exception\RuntimeException;
use Symfony\Component\Process\ProcessBuilder;

class Plugin implements PluginInterface, EventSubscriberInterface {


	/**
	 * @var Composer
	 */
	private $composer;

	/**
	 * @var IOInterface
	 */
	private $io;

	/**
	 * Triggers the plugin's main functionality.
	 *
	 * Makes it possible to run the plugin as a custom command.
	 *
	 * @param Event $event
	 *
	 * @throws \InvalidArgumentException
	 * @throws \RuntimeException
	 * @throws LogicException
	 * @throws ProcessFailedException
	 * @throws RuntimeException
	 */
	public static function run( Event $event ) {
		$io = $event->getIO();
		$composer = $event->getComposer();
		$instance = new static();
		$instance->io = $io;
		$instance->composer = $composer;
		$instance->init();
		$instance->onDependenciesChangedEvent();
	}

	/**
	 * {@inheritDoc}
	 *
	 * @throws \RuntimeException
	 * @throws LogicException
	 * @throws RuntimeException
	 * @throws ProcessFailedException
	 */
	public function activate( Composer $composer, IOInterface $io ) {
		$this->composer = $composer;
		$this->io = $io;
		$this->init();
	}

	/**
	 * Prepares the plugin so it's main functionality can be run.
	 *
	 * @throws \RuntimeException
	 * @throws LogicException
	 * @throws ProcessFailedException
	 * @throws RuntimeException
	 */
	private function init() {
	}

	/**
	 * {@inheritDoc}
	 */
	public static function getSubscribedEvents() {
		return array(
			ScriptEvents::POST_INSTALL_CMD => array(
				array( 'onDependenciesChangedEvent', 0 ),
			),
			ScriptEvents::POST_UPDATE_CMD => array(
				array( 'onDependenciesChangedEvent', 0 ),
			),
		);
	}

	/**
	 * Entry point for post install and post update events.
	 *
	 * @throws \InvalidArgumentException
	 * @throws RuntimeException
	 * @throws LogicException
	 * @throws ProcessFailedException
	 */
	public function onDependenciesChangedEvent() {
		$target_dir = getcwd() . DIRECTORY_SEPARATOR . '.git' . DIRECTORY_SEPARATOR . 'hooks';
		if ( ! is_dir( $target_dir ) ) {
			mkdir( $target_dir, 0775, true );
		}

		copy( __DIR__ . DIRECTORY_SEPARATOR . 'pre-commit', $target_dir . DIRECTORY_SEPARATOR . 'pre-commit' );
		chmod( $target_dir . DIRECTORY_SEPARATOR . 'pre-commit', 0775 );
	}
}
