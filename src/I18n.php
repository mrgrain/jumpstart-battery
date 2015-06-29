<?php
namespace Jumpstart\Trampoline;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Jumpstart\Trampoline
 * @author     Moritz Kornher <mail@moritzkornher.de>
 */
class I18n
{
    /**
     * The domain specified for this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $domain The domain identifier for this plugin.
     */
    protected $domain;

    /**
     * The base path of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $path The base path of this plugin.
     */
    protected $path;

    /**
     * Initialize with the plugin base path.
     *
     * @since    1.0.0
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function loadTextdomain()
    {
        load_plugin_textdomain(
            $this->domain,
            false,
            plugin_basename($this->path) . '/languages/'
        );
    }

    /**
     * Set the domain equal to that of the specified domain.
     *
     * @since    1.0.0
     * @param    string $domain The domain that represents the locale of this plugin.
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }
}
