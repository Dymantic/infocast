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
                'name' => 'Enrique',
                'title' => 'Strategy',
                'profile' => '/images/profiles/enrique.png',
                'quote' => '“Knowing what you’re doing gets you halfway there..”',
            ],
            [
                'name' => 'Wei',
                'title' => 'Design',
                'profile' => '/images/profiles/wei.png',
                'quote' => '“You never ‘make’ it. There is no end goal in life so you should enjoy the journey.” — Unknown',
            ],
            [
                'name' => 'Oliver',
                'title' => 'Front End',
                'profile' => '/images/profiles/oliver.png',
                'quote' => '“Your positive action combined with positive thinking results in success.” — Shiv Khera',
            ],
            [
                'name' => 'J-D',
                'title' => 'Projects',
                'profile' => '/images/profiles/JD.png',
                'quote' => '“Never half-ass two things. Whole-ass one thing.” — Ron Swanson',
            ],
            [
                'name' => 'Ruoshin',
                'title' => 'Front End',
                'profile' => '/images/profiles/ruoshin.png',
                'quote' => '“Learn to… be what you are, and learn to resign with a good grace all that you are not.” — Henri Frederic Amiel',
            ],
            [
                'name' => 'Chris',
                'title' => 'Applications',
                'profile' => '/images/profiles/chris.jpg',
                'quote' => '“The second mouse gets the cheese” — Ernst Berg',
            ],
            [
                'name' => 'Kilari',
                'title' => 'Senior SRE',
                'profile' => '/images/profiles/kilari.png',
                'quote' => '“If you would not be forgotten as soon as you are dead, either write something worth reading or do things worth writing.” - Benjamin Franklin',
            ],
            [
                'name' => 'Sara',
                'title' => 'Office Manager',
                'profile' => '/images/profiles/sara.jpg',
                'quote' => '“Always remember that you are absolutely unique. Just like everyone else.” - Margaret Mead',
            ],
            [
                'name' => 'Alven',
                'title' => 'UI/Visual Designer',
                'profile' => '/images/profiles/alven.jpg',
                'quote' => '“We don’t get a chance to do that many things, and every one should be really excellent.” - Steve Jobs',
            ],
            [
                'name' => 'Kaiya',
                'title' => 'UI/Visual Designer',
                'profile' => '/images/profiles/kaiya.jpg',
                'quote' => '“For when I am weak, then I am strong.” - 2 Corinthians 12:10 Bible',
            ]
        ];
        return view('front.home.page', ['postings' => $postings, 'team' => $team]);
    }

    public function thanks()
    {
        return view('front.thanks', ['name' => request('name')]);
    }
}
