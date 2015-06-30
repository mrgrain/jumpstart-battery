<?php
namespace Jumpstart\Battery;

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @since       1.0.0
 * @package     Jumpstart\Battery
 * @author      Moritz Kornher <mail@moritzkornher.de>
 */
class Loader
{
    /**
     * The slug of this plugin.
     *
     * @since   1.0.0
     * @access  protected
     * @var     string $slug The slug of this plugin.
     */
    protected $slug;

    /**
     * The version of this plugin.
     *
     * @since   1.0.0
     * @access  protected
     * @var     string $version The current version of this plugin.
     */
    protected $version;

    /**
     * The base path of this plugin.
     *
     * @since   1.0.0
     * @access  protected
     * @var     string $path The base path of this plugin.
     */
    protected $path;

    /**
     * The array of actions registered with WordPress.
     *
     * @since   1.0.0
     * @access  protected
     * @var     array $actions The actions registered with WordPress to fire when the plugin loads.
     */
    protected $actions;

    /**
     * The array of filters registered with WordPress.
     *
     * @since   1.0.0
     * @access  protected
     * @var     array $filters The filters registered with WordPress to fire when the plugin loads.
     */
    protected $filters;

    /**
     * The array of styles registered with WordPress.
     *
     * @since   1.0.0
     * @access  protected
     * @var     array $styles The styles registered with WordPress to load when the plugin loads.
     */
    protected $styles;

    /**
     * The array of scripts registered with WordPress.
     *
     * @since   1.0.0
     * @access  protected
     * @var     array $scripts The scripts registered with WordPress to load when the plugin loads.
     */
    protected $scripts;

    /**
     * Initialize the collections used to maintain the actions and filters.
     *
     * @since   1.0.0
     * @param   $slug
     * @param   $version
     * @param   $path
     */
    public function __construct($slug, $version, $path)
    {
        $this->slug = $slug;
        $this->version = $version;
        $this->path = $path;

        $this->actions = array();
        $this->filters = array();
        $this->styles = array();
        $this->scripts = array();
    }

    /**
     * Add a new action to the collection to be registered with WordPress.
     *
     * @since   1.0.0
     * @param   string $hook The name of the WordPress action that is being registered.
     * @param   callable $callback The name of the function definition on the $component.
     * @param   int $priority The priority at which the function should be fired.
     * @param   int $accepted_args The number of arguments that should be passed to the $callback.
     */
    public function action($hook, $callback, $priority = 10, $accepted_args = 1)
    {
        $this->actions = $this->add($this->actions, $hook, $callback, $priority, $accepted_args);
    }

    /**
     * Add a new filter to the collection to be registered with WordPress.
     *
     * @since   1.0.0
     * @param   string $hook The name of the WordPress filter that is being registered.
     * @param   callable $callback The name of the function definition on the $component.
     * @param   int $priority The priority at which the function should be fired.
     * @param   int $accepted_args The number of arguments that should be passed to the $callback.
     */
    public function filter($hook, $callback, $priority = 10, $accepted_args = 1)
    {
        $this->filters = $this->add($this->filters, $hook, $callback, $priority, $accepted_args);
    }

    /**
     * A utility function that is used to register the actions and hooks into a single
     * collection.
     *
     * @since   1.0.0
     * @access  private
     * @param   array $hooks The collection of hooks that is being registered (that is, actions or filters).
     * @param   string $hook The name of the WordPress filter that is being registered.
     * @param   callable $callback The name of the function definition on the $component.
     * @param   int $priority The priority at which the function should be fired.
     * @param   int $accepted_args The number of arguments that should be passed to the $callback.
     * @return  array The collection of actions and filters registered with WordPress.
     */
    protected function add($hooks, $hook, $callback, $priority, $accepted_args)
    {
        $hooks[] = array(
            'hook' => $hook,
            'callback' => $callback,
            'priority' => $priority,
            'accepted_args' => $accepted_args
        );

        return $hooks;
    }


    /**
     * Add a new action to the collection to be registered with WordPress.
     *
     * @since 1.0.0
     * @param bool|string $src Path to the stylesheet from the root directory of the plugin.
     * @param array $deps An array of registered style handles this stylesheet depends on. Default empty array.
     * @param string $type Optional. Include in wp, admin or both.
     * @param string $media Optional. The media for which this stylesheet has been defined. Default 'all'. Accepts 'all', 'aural', 'braille', 'handheld', 'projection', 'print', 'screen', 'tty', or 'tv'.
     */
    public function style($src = false, $deps = array(), $type = 'both', $media = 'all')
    {
        $this->styles = $this->resource($this->styles, $src, $deps, $type, $media);
    }

    /**
     * Add a new filter to the collection to be registered with WordPress.
     *
     * @since   1.0.0
     * @param   bool|string $src Path to the script from the root directory of the plugin.
     * @param   array $deps An array of registered handles this script depends on. Default empty array.
     * @param   string $type Optional. Include in wp, admin or both.
     * @param   bool $in_footer Optional. Whether to enqueue the script before or before . Default 'false'. Accepts 'false' or 'true'.
     */
    public function script($src = false, $deps = array(), $type = 'both', $in_footer = false)
    {
        $this->scripts = $this->resource($this->scripts, $src, $deps, $type, $in_footer);
    }

    /**
     * A utility function that is used to register the actions and hooks into a single
     * collection.
     *
     * @since   1.0.0
     * @access  private
     * @param   array $resources The collection of resources that is being registered (that is, styles or scripts).
     * @param   bool|string $src Path to the resource from the root directory of the plugin.
     * @param   array $deps An array of registered handles this resource depends on. Default empty array.
     * @param   string $type Optional. Include in wp, admin or both.
     * @param   bool $cond
     * @return  array The collection of styles and scripts registered with WordPress.
     */
    private function resource($resources, $src, $deps, $type, $cond)
    {
        $resources[] = array(
            'handle' => $this->slug . '_' . $src,
            'src' => plugins_url('assets/css/' . $src, $this->path),
            'deps' => $deps,
            'type' => $type,
            'cond' => $cond
        );

        return $resources;
    }

    /**
     * Register the filters and actions with WordPress.
     *
     * @since   1.0.0
     */
    public function run()
    {
        // Enqueue styles and scripts
        $this->action('wp_enqueue_scripts', $this->enqueue('wp'));
        $this->action('admin_enqueue_scripts', $this->enqueue('admin'));

        foreach ($this->filters as $hook) {
            add_filter($hook['hook'], $hook['callback'], $hook['priority'], $hook['accepted_args']);
        }

        foreach ($this->actions as $hook) {
            add_action($hook['hook'], $hook['callback'], $hook['priority'], $hook['accepted_args']);
        }
    }

    /**
     * Create a callable to enqueue resources.
     *
     * @since   1.0.0
     * @access  protected
     * @param   $type
     * @return  callable
     */
    protected function enqueue($type)
    {
        $filter = function ($val) use ($type) {
            return in_array($val['type'], array($type, 'both'));
        };

        return function () use ($filter) {
            foreach (array_filter($this->styles, $filter) as $hook) {
                wp_enqueue_style($hook['handle'], $hook['src'], $hook['deps'], $this->version, $hook['cond']);
            }
            foreach (array_filter($this->scripts, $filter) as $hook) {
                wp_enqueue_script($hook['handle'], $hook['src'], $hook['deps'], $this->version, $hook['cond']);
            }
        };
    }
}
