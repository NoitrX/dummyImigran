<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\DashboardRepository;

class DirekturController extends Controller
{

    private $dashboardRepository;
    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }
    public function index()
    {    try {
        $users = $this->dashboardRepository->index();
        return view('direktur.index', $users);
    }catch(Exception $e)
    {
        throw new Exception($e);
    }
     
    }
}
