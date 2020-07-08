<?php

namespace Scolabs\Docker;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        set_time_limit(0);
        $docker = new Docker();
        if (isset($_POST['containerid'])) {

            while (is_null($docker->getContainer())) {
                $docker->getInfoAboutContainer($_POST['containerid']);
            }

            $singleContainer = $this->objectToArray($docker->getContainer());
        }

        $docker->getContainersFromDocker();

        while (is_null($docker->getContainers())) {
            $docker->getContainersFromDocker();
        }

        $containers = $this->objectToArray($docker->getContainers());

        if (!isset($singleContainer)){
            return view('docker::index', compact('containers'));
        } else {
            return view ('docker::index', compact('containers', 'singleContainer'));
        }
    }

    /**
     * @param $d
     * @return array
     */
    private function objectToArray($d)
    {
        if (is_object($d)) {
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            return array_map(array($this, __FUNCTION__), $d);
        } else {
            return $d;
        }
    }
}
