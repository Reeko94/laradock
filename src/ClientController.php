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
     * @var Docker
     */
    protected $docker;

    public function __construct(Docker $docker)
    {
        $this->docker = $docker;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        set_time_limit(0);

        $this->docker->getContainersFromDocker();

        while (is_null($this->docker->getContainers())) {
            $this->docker->getContainersFromDocker();
        }

        $containers = $this->objectToArray($this->docker->getContainers());

        return view('docker::index', compact('containers'));
    }

    public function stopContainer($id)
    {
        $this->docker->stopContainer($id);

        return redirect('containers');
    }

    public function renameContainer($id, Request $request)
    {
        $this->docker->renameContainer($id, $request->post("name"));
        return redirect('containers');
    }

    /**
     * @param $idContainer
     * @return Application|Factory|View
     */
    public function show($idContainer)
    {
        while (is_null($this->docker->getContainer())) {
            $this->docker->getInfoAboutContainer($idContainer);
        }

        $container = $this->objectToArray($this->docker->getContainer());
        return view("docker::show", compact('container'));
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
