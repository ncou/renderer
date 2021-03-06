<?php
/**
 * Part of the Joomla Framework Renderer Package
 *
 * @copyright  Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license    http://www.gnu.org/licenses/lgpl-2.1.txt GNU Lesser General Public License Version 2.1 or Later
 */

namespace Joomla\Renderer;

/**
 * Mustache class for rendering output.
 *
 * @since  __DEPLOY_VERSION__
 */
class MustacheRenderer extends AbstractRenderer
{
	/**
	 * Rendering engine
	 *
	 * @var    \Mustache_Engine
	 * @since  __DEPLOY_VERSION__
	 */
	private $renderer;

	/**
	 * Constructor
	 *
	 * @param   \Mustache_Engine  $renderer  Rendering engine
	 *
	 * @since   __DEPLOY_VERSION__
	 */
	public function __construct(\Mustache_Engine $renderer = null)
	{
		$this->renderer = $renderer ?: new \Mustache_Engine;
	}

	/**
	 * Get the rendering engine
	 *
	 * @return  \Mustache_Engine
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
		try
		{
			$this->getRenderer()->getLoader()->load($path);

			return true;
		}
		catch (\Mustache_Exception_UnknownTemplateException $e)
		{
			return false;
		}
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
}
