<?php

namespace App\Http\Controllers;

use App\Careers\Posting;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $postings = Posting::live()->latest()->take(4)->get();
        $team = [
            [
                'name' => 'Shunwen',
                'title' => 'VP of Engineering',
                'profile' => '/images/profiles/shunwen.png',
                'quote' => '“Whatever comes, let it come, what stays let stay, what goes let go.” ― Papaji',
                'email' => 'shunwen@infocast.tech'
            ],
            [
                'name' => 'Oliver',
                'title' => 'Senior Front End Developer',
                'profile' => '/images/profiles/oliver.png',
                'quote' => '“Your positive action combined with positive thinking results in success.” — Oliver Lin',
                'email' => 'oliver@infocast.tech'
            ],
            [
                'name' => 'Wei',
                'title' => 'Product Designer',
                'profile' => '/images/profiles/wei.png',
                'quote' => '“You never ‘make’ it. There is no end goal in life so you should enjoy the journey.” — Unknown',
                'email' => 'wei@infocast.tech'
            ],
            [
                'name' => 'Ruoshin',
                'title' => 'Front End Developer',
                'profile' => '/images/profiles/ruoshin.png',
                'quote' => '“Learn to… be what you are, and learn to resign with a good grace all that you are not.” — Henri Frederic Amiel',
                'email' => 'ruoshin@infocast.tech'
            ],
            [
                'name' => 'J-D',
                'title' => 'Project Manager',
                'profile' => '/images/profiles/JD.png',
                'quote' => '“Never half-ass two things. Whole-ass one thing.” — Ron Swanson',
                'email' => 'jd@infocast.tech'
            ],
            [
                'name' => 'Enrique',
                'title' => 'CEO',
                'profile' => '/images/profiles/enrique.png',
                'quote' => 'TBD - E.O.',
                'email' => 'enrique@infocast.tech'
            ],
            [
                'name' => 'Chris',
                'title' => 'Chief Application Developer',
                'profile' => '/images/profiles/chris.png',
                'quote' => '“The second mouse gets the cheese” — Ernst Berg',
                'email' => 'chrisb@infocast.tech'
            ]
        ];
        return view('front.home.page', ['postings' => $postings, 'team' => $team]);
    }

    public function thanks()
    {
        return view('front.thanks', ['name' => request('name')]);
    }
}
