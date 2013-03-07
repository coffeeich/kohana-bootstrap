<?php defined('SYSPATH') OR die('No direct script access.');

class Config_File extends Kohana_Config_File {

    const HTTP_HOST_SUFFIX = 'host';

    /**
     * Load and merge all of the configuration files in this group.
     *
     *     $config->load($name);
     *
     * It means that if application runs on yours.domain.name.com the groups
     * list would be somothing like that:
     *  - "cookie" - default application configuration, which could be under under cvs
     *  - "cookie.host.yours.domain.name.com" - hostname oriented configuration, which could be used on stages
     *  - "cookie.local" - most powerfull configuration is development environment
     * @param   string  $group  configuration group name
     * @return  $this   current object
     * @uses    Kohana::load
     */
    public function load($group) {
        $config = array();

        $groups = Arr::merge(
            array($group),
            $this->build_hosts_groups($group, $_SERVER['HTTP_HOST'], self::HTTP_HOST_SUFFIX),
            array($group . '.local')
        );

        if ($groups) {
            foreach ($groups as $group) {
                // Merge each file to the configuration array
                $config = Arr::merge($config, parent::load($group));
            }
        }

        return $config;
    }

    /**
     * Build list of configs based on host name
     * @param string $group     configuration group name
     * @param string $host      host name
     * @param string $suffix    configuration group suffix
     * @return array
     */
    private function build_hosts_groups($group, $host, $suffix) {
        $groups = array();
        $tail   = array();

        foreach (array_reverse(explode('.', $host)) as $index => $part) {
            array_unshift($tail, $part);

            if ($index !== 0)  {
                $groups[] = "$group.$suffix." . join('.', $tail);
            }
        }

        return $groups;
    }

}