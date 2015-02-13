<?php

namespace piotrpasich\CodeQualityThreshold\Tool;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class Tool
{

    /**
     * @var array
     */
    protected $configuration;

    protected $defaultOptions = [];

    public function __construct(array $configuration = [])
    {
        if (isset($configuration['options'])) {
            $this->configuration = $this->resolveConfigurationOptions($configuration['options']);
        }
    }

    /**
     * Returns a string with bash command
     *
     * @return string
     */
    abstract public function composeCommand();

    /**
     * Returns an integer with the threshold
     *
     * @return Integer
     */
    abstract public function getThreshold();

    /**
     * Returns error message if exception occurs
     *
     * @return string
     */
    abstract public function getErrorMessage();

    /**
     * Returns a message when succeed
     *
     * @return string
     */
    abstract public function getSuccessMessage();

    public function getTimeout()
    {
        return $this->configuration['timeout'];
    }

    /**
     * Resolves options
     *
     * @param array $options
     * @return array
     */
    protected function resolveConfigurationOptions(array $configurationOptions)
    {
        $optionsResolver = new OptionsResolver();
        $optionsResolver->setDefaults($this->defaultOptions);
        $optionsResolver->setRequired(array_keys($this->defaultOptions));

        return $optionsResolver->resolve($configurationOptions);
    }

}