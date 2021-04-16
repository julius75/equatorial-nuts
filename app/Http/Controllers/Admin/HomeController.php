<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $first_letter = ucfirst(substr($user->username, 0, 1));
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        return view('admin.dashboard', compact('page_title', 'page_description','user','first_letter'));
    }

    /**
     * Get Teleco Providers DataTable
     *
     * @return \Illuminate\Http\Response
     */

}
