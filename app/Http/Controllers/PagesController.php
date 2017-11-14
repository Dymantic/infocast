<?php

namespace App\Http\Controllers;

use App\Careers\Posting;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $postings = Posting::live()->ordered()->take(4)->get();
        $team = [
            [
                'name' => 'Oliver',
                'title' => 'Front End',
                'profile' => '/images/profiles/oliver.png',
                'quote' => '“Your positive action combined with positive thinking results in success.” — Shiv Khera',
                'email' => 'oliver@infocast.tech'
            ],
            [
                'name' => 'Wei',
                'title' => 'Design',
                'profile' => '/images/profiles/wei.png',
                'quote' => '“You never ‘make’ it. There is no end goal in life so you should enjoy the journey.” — Unknown',
                'email' => 'wei@infocast.tech'
            ],
            [
                'name' => 'Ruoshin',
                'title' => 'Front End',
                'profile' => '/images/profiles/ruoshin.png',
                'quote' => '“Learn to… be what you are, and learn to resign with a good grace all that you are not.” — Henri Frederic Amiel',
                'email' => 'ruoshin@infocast.tech'
            ],
            [
                'name' => 'J-D',
                'title' => 'Projects',
                'profile' => '/images/profiles/JD.png',
                'quote' => '“Never half-ass two things. Whole-ass one thing.” — Ron Swanson',
                'email' => 'jd@infocast.tech'
            ],
            [
                'name' => 'Enrique',
                'title' => 'Strategy',
                'profile' => '/images/profiles/enrique.png',
                'quote' => '“Knowing what you’re doing gets you halfway there..”',
                'email' => 'enrique@infocast.tech'
            ],
            [
                'name' => 'Chris',
                'title' => 'Applications',
                'profile' => '/images/profiles/chris.png',
                'quote' => '“The second mouse gets the cheese” — Ernst Berg',
                'email' => 'chrisb@infocast.tech'
            ],
            [
                'name' => 'Mose',
                'title' => 'Operations',
                'profile' => '/images/profiles/mose.png',
                'quote' => '',
                'email' => 'mose@infocast.tech'
            ]
        ];
        return view('front.home.page', ['postings' => $postings, 'team' => $team]);
    }

    public function thanks()
    {
        return view('front.thanks', ['name' => request('name')]);
    }
}
