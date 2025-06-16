<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_Management;
use App\Models\admin_Management;
use App\Models\Effect;
use App\Models\Form;
use App\Models\Layout;
use App\Models\UseInterface;

class DashboardController extends Controller
{
    public function index()
    {
        // 1 lấy số lượng
        $userCount = User_Management::where('role', 'user')->count();
        $managerCount = admin_Management::where('role', 'admin')->count();
        $effectCount = Effect::count();
        $layoutCount = Layout::count();
        $formCount = Form::count();
        $uiCount = UseInterface::count();

        // 2 hiển thị dữ liệu
        return view(
            'admin.admin_dashboard',
            compact('userCount', 'managerCount', 'effectCount', 'layoutCount', 'formCount', 'uiCount')
        );
    }
}
