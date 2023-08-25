<?php

namespace App\Service;

/**
 * Working with configs
 */
class Config
{
    /**
     * @var array Variables by config files
     */
    private $data = [];

    /**
     * @var Config Stored config instance
     */
    private static $instance;

    /**
     * Singleton instance
     *
     * @return self
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Init config
     *
     * @param array $configs Config files names
     * @return void
     */
    public static function init(array $configs): void
    {
        $instance = self::getInstance();
        foreach ($configs as $config) {
            $instance->loadConfigFile($config);
        }
    }

    /**
     * Get variable from config
     *
     * @param string $var
     * @param mixed|null $default
     * @return array|mixed|null
     */
    public static function get(string $var, mixed $default = null)
    {
        $dotPosition = strpos($var, '.');
        $configName = substr($var, 0, $dotPosition);
        $var = substr($var, $dotPosition+1);
        $instance = self::getInstance();
        return $instance->getValue($configName, $var, $default);
    }

    /**
     * Load config variables from file
     *
     * @param string $name
     * @return void
     */
    public function loadConfigFile(string $name)
    {
        if (is_readable(PATH.'/app/configs/'.$name.'.php')) {
            $this->data[$name] = include(PATH.'/app/configs/'.$name.'.php');
        }
    }

    /**
     * Search variable in config
     *
     * @param string $configName
     * @param string $var
     * @param mixed|null $default
     * @return array|mixed|null
     */
    public function getValue(string $configName, string $var, mixed $default = null)
    {
        $var = explode('.', $var);
        $value = $this->data[$configName] ?? [];
        foreach ($var as $item) {
            if (is_array($value) && array_key_exists($item, $value)) {
                $value = $value[$item];
            } else return $default;
        }
        return $value;
    }
}