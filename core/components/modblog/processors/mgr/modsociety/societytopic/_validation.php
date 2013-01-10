<?php
/**
 * Handles common validation for user processors
 *
 * @package modx
 */
class SocietyBlogValidation {
    /** @var modX $modx */
    public $modx;
    /** @var modUserCreateProcessor|modUserUpdateProcessor $processor */
    public $processor;
    
    public $resource;
    
    public $attributes;

    function __construct(modObjectProcessor &$processor, modResource &$resource, SocietyBlogAttributes &$attributes) {
        $this->processor =& $processor;
        $this->modx =& $processor->modx;
        $this->resource =& $resource;
        $this->attributes =& $attributes;
    }

    public function validate() {
        return !$this->processor->hasErrors();
    }
}