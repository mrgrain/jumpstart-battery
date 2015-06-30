<?php
namespace Jumpstart\Battery;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Jumpstart\Battery
 * @author     Moritz Kornher <mail@moritzkornher.de>
 */
class I18n extends Component
{
    /**
     * The domain specified for this plugin.
     *
     * @since   1.0.0
     * @access  protected
     * @var     string     $domain The domain identifier for this plugin.
     */
    protected $domain;

    /**
     * The base path of this plugin.
     *
     * @since   1.0.0
     * @access  protected
     * @var     string     $path   The base path of this plugin.
     */
    protected $path;

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since   1.0.0
     * @access  protected
     * @var     Loader  $loader     Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    public function __construct($domain, $path, $loader)
    {
        $this->setDomain($domain);
        $this->setPath($path);
        $this->loader = $loader;
        parent::__construct();
    }

    /**
     * Load components and register hooks with WordPress.
     *
     * @since       1.0.0
     * @access      protected
     * @return      void
     */
    protected function run()
    {
        $this->loader->action('plugins_loaded', array($this, 'loadTextDomain'));
    }

    /**
     * Set the domain equal to that of the specified domain.
     *
     * @since    1.0.0
     * @param    string     $domain The domain that represents the locale of this plugin.
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * Set the base path of the plugin.
     *
     * @since    1.0.0
     * @param    string     $path   The base path of the plugin.
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function loadTextDomain()
    {
        load_plugin_textdomain(
            $this->domain,
            false,
            plugin_basename($this->path) . '/languages/'
        );
    }
}
