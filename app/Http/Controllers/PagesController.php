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
                'name' => 'Kaiya',
                'title' => 'UI/Visual',
                'profile' => '/images/profiles/kaiya_2.jpg',
                'quote' => '“As your days, so shall your strength be.” Deuteronomy 33:25 Bible',
            ],
            [
                'name' => 'Sullivan',
                'title' => 'Front End',
                'profile' => '/images/profiles/sullivan.jpg',
                'quote' => '“Never stop investing. Never stop improving. Never stop doing something new.” - Bob Parsons',
            ],
            [
                'name' => 'Tony',
                'title' => 'Back End',
                'profile' => '/images/profiles/tony.jpg',
                'quote' => '“The first step is to establish that something is possible; then probability will occur.” - Elon Musk',
            ],
            [
                'name' => 'Jason',
                'title' => 'Quality Assurance',
                'profile' => '/images/profiles/jason.png',
                'quote' => '“Do not go gentle into that good night, old age should burn and rave at close of day; Rage, rage against the dying of the light.” - Dylan Thomas',
            ],
            [
                'name' => 'Mushin',
                'title' => 'Product Manager',
                'profile' => '/images/profiles/mushin.png',
                'quote' => '“I never think of the future – it comes soon enough.” -Albert Einstein',
            ],
            [
                'name' => 'Wanyu',
                'title' => 'Front End',
                'profile' => '/images/profiles/wanyu.png',
                'quote' => '“Always pass on what you have learned.” - Master Yoda',
            ],
            [
                'name' => 'Leo',
                'title' => 'Business Intelligence',
                'profile' => '/images/profiles/leo.png',
                'quote' => '“When you want something, all the universe conspires in helping you to achieve it.”   – Paulo Coelho, The Alchemist',
            ],
            [
                'name' => 'Irish',
                'title' => 'Lead UX Designer',
                'profile' => '/images/profiles/irish.png',
                'quote' => '“Good designers copy, great designers steal.” -Pablo Picasso',
            ],
            [
                'name' => 'Derek',
                'title' => 'Jnr. Business Dev',
                'profile' => '/images/profiles/derek.png',
                'quote' => '“Innovation distinguishes between a leader and a follower.” —Steve Jobs',
            ],
            [
                'name' => 'Gary',
                'title' => 'Jnr. Data Scientist',
                'profile' => '/images/profiles/gary.png',
                'quote' => '“No man can win every battle, but no man should fall without a struggle.”  - Peter Parker',
            ],


        ];
        return view('front.home.page', ['postings' => $postings, 'team' => $team]);
    }

    public function thanks()
    {
        return view('front.thanks', ['name' => request('name')]);
    }
}
