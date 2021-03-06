<?php
/**
 * Part of the Joomla Framework Renderer Package
 *
 * @copyright  Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license    http://www.gnu.org/licenses/lgpl-2.1.txt GNU Lesser General Public License Version 2.1 or Later
 */

namespace Joomla\Renderer;

use League\Plates\Engine;

/**
 * Plates class for rendering output.
 *
 * @since  __DEPLOY_VERSION__
 */
class PlatesRenderer extends AbstractRenderer implements AddTemplateFolderInterface, ConfigurableFileExtensionInterface
{
	/**
	 * Rendering engine
	 *
	 * @var    Engine
	 * @since  __DEPLOY_VERSION__
	 */
	private $renderer;

	/**
	 * Constructor.
	 *
	 * @param   Engine  $renderer  Rendering engine
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function __construct(Engine $renderer = null)
	{
		$this->renderer = $renderer ?: new Engine;
	}

	/**
	 * Add a folder with alias to the renderer
	 *
	 * @param   string  $directory  The folder path
	 * @param   string  $alias      The folder alias
	 *
	 * @return  $this
	 *
	 * @since   __DEPLOY_VERSION__
	 * @throws  \InvalidArgumentException
	 */
	public function addFolder(string $directory, string $alias = '')
	{
		if ($alias === '')
		{
			throw new \InvalidArgumentException('Setting an alias is required in Plates');
		}

		$this->getRenderer()->addFolder($alias, $directory);

		return $this;
	}

	/**
	 * Get the rendering engine
	 *
	 * @return  Engine
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function getRenderer()
	{
		return $this->renderer;
	}

	/**
	 * Checks if folder, folder alias, template or template path exists
	 *
	 * @param   string  $path  Full path or part of a path
	 *
	 * @return  boolean  True if the path exists
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function pathExists(string $path): bool
	{
		return $this->getRenderer()->exists($path);
	}

	/**
	 * Render and return compiled data.
	 *
	 * @param   string  $template  The template file name
	 * @param   array   $data      The data to pass to the template
	 *
	 * @return  string  Compiled data
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function render(string $template, array $data = array()): string
	{
		$data = array_merge($this->data, $data);

		return $this->getRenderer()->render($template, $data);
	}

	/**
	 * Sets file extension for template loader
	 *
	 * @param   string  $extension  Template files extension
	 *
	 * @return  $this
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function setFileExtension(string $extension)
	{
		$this->getRenderer()->setFileExtension($extension);

		return $this;
	}
}
