<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Dashboard extends Controller
{
    public function dashboard(Request $request)
    {

        //Annoucement Section to display the latest 5 announcements and the remaining announcements
        $today = Carbon::today();
        $announcements = Announcement::where('date', '>=', $today->subDays(14))
            ->orderBy('date', 'desc')
            ->get();

        $latestAnnouncements = $announcements->take(5);
        $remainingAnnouncements = $announcements->skip(5);

        return view('dashboard', compact('latestAnnouncements', 'remainingAnnouncements'));
    }
}
