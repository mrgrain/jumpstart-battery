<?php
namespace Jumpstart\Battery;

/**
 * An abstract plugin component.
 *
 * Defines conditions when to run a component and do so if they are met.
 *
 * @since       1.0.0
 * @package     Jumpstart\Battery
 * @author      Moritz Kornher <mail@moritzkornher.de>
 */
abstract class Component
{
    /**
     * Initialize the Component from the parent plugin.
     * Check if the conditions or met and if run the component.
     *
     * @since   1.0.0
     */
    public function __construct()
    {
        if ($this->conditions()) {
            $this->run();
        }
    }

    /**
     * Extend with checks whether the component should be used or not.
     *
     * @since   1.0.0
     * @access  protected
     * @return  boolean
     */
    protected function conditions()
    {
        return true;
    }

    /**
     * Load components and register hooks with WordPress.
     *
     * @since   1.0.0
     * @access  protected
     * @return  void
     */
    abstract protected function run();
}
