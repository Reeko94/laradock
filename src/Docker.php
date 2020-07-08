<?php


namespace Scolabs\Docker;


class Docker
{
    private $containers;

    private $socket;

    private $container;

    /**
     * Docker constructor.
     * @param string $socket
     */
    public function __construct(string $socket = '/var/run/docker.sock')
    {
        $this->socket = $socket;
    }

    /**
     * @return mixed
     */
    public function getContainersFromDocker()
    {
        $ch = $this->getConfig();

        curl_setopt($ch, CURLOPT_WRITEFUNCTION, function ($ch, $string) {
            $this->containers = json_decode($string);
            return strlen($string);
        });

        curl_setopt($ch, CURLOPT_URL, "http:/v1.40/containers/json");

        curl_exec($ch);

        return $this->containers;
    }

    /**
     * @param string $idContainer
     */
    public function getInfoAboutContainer(string $idContainer)
    {
        $ch = $this->getConfig();

        curl_setopt($ch, CURLOPT_WRITEFUNCTION, function ($ch, $string) {
            $this->container = json_decode($string);
            return strlen($string);
        });

        curl_setopt($ch, CURLOPT_URL, "http:/v1.40/containers/" . $idContainer . "/json");

        curl_exec($ch);
    }

    public function stopContainer(string $idContainer)
    {
        $ch = $this->getConfig();

        curl_setopt($ch, CURLOPT_URL,"http:/v1.40/containers/" . $idContainer . "/stop");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
    }  

    /**
     * @return mixed
     */
    public function getContainers()
    {
        return $this->containers;
    }

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @return false|resource
     */
    private function getConfig()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_UNIX_SOCKET_PATH, $this->socket);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000000);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        return $ch;
    }
}
