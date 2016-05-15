<?php
namespace Jumpstart\Battery;

/**
 * The core plugin class.
 *
 * This is used to define internationalization and load components.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since           1.0.0
 * @package         Jumpstart\Battery
 * @author          Moritz Kornher <mail@moritzkornher.de>
 */
/**
 * Class Plugin
 * @package Jumpstart\Battery
 */
abstract class Plugin extends Component
{
    /**
     * The unique identifier of this plugin.
     *
     * @since       1.0.0
     * @access      protected
     * @var         string $slug The string used to uniquely identify this plugin.
     */
    protected $slug;

    /**
     * The current version of the plugin.
     *
     * @since       1.0.0
     * @access      protected
     * @var         string $version The current version of the plugin.
     */
    protected $version;

    /**
     * The plugin basename.
     *
     * @since       1.0.0
     * @access      protected
     * @var         string $basename The basename of the plugin.
     */
    protected $basename;

    /**
     * The base path of the plugin.
     *
     * @since       1.0.0
     * @access      protected
     * @var         string $path The base path of the plugin.
     */
    protected $path;

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since       1.0.0
     * @access      protected
     * @var         Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Define the locale and load the components.
     *
     * @since       {{version}}
     * @access      public
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->basename = plugin_basename($filename);
        $this->path = dirname($filename);
        $this->loader = new Loader($this->getSlug(), $this->getVersion(), $this->getPath());
        parent::__construct();
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since       1.0.0
     */
    public function jumpstart()
    {
        $this->getLoader()->action('activate_' . $this->getBasename(), array($this, 'activate'));
        $this->getLoader()->action('deactivate_' . $this->getBasename(), array($this, 'deactivate'));
        $this->getLoader()->action('uninstall_' . $this->getBasename(), array($this, 'uninstall'));
        $this->getLoader()->run();
    }

    /**
     * The plugin slug used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since       1.0.0
     * @return      string      The plugin slug.
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since       1.0.0
     * @return      string      The version number of the plugin.
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Retrieve the basename of the plugin.
     *
     * @since       1.0.0
     * @return      string      The basename of the plugin.
     */
    public function getBasename()
    {
        return $this->basename;
    }

    /**
     * Retrieve the base path of the plugin.
     *
     * @since       1.0.0
     * @return      string      The base path of the plugin.
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since       1.0.0
     * @return      Loader      Orchestrates the hooks of the plugin.
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     * Actions performed when activating the plugin.
     *
     * @since       1.0.0
     * @return      void
     */
    public function activate()
    {
    }

    /**
     * Actions performed when deactivating the plugin.
     *
     * @since       1.0.0
     * @return      void
     */
    public function deactivate()
    {
    }

    /**
     * Actions performed when uninstalling the plugin.
     *
     * @since       1.0.0
     * @return      void
     */
    public function uninstall()
    {
    }
}
