<?php

namespace App\Http\Controllers;

use App\Careers\Posting;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $postings = Posting::live()->ordered()->take(4)->get();

        return view('front.home.page', ['postings' => $postings]);
    }

    public function about()
    {
        $team = [


            [
                'name' => 'Chris',
                'title' => 'Software Developer',
                'profile' => '/images/profiles/chris.jpg',
                'quote' => '“The second mouse gets the cheese” — Ernst Berg',
            ],
            [
                'name' => 'Kilari',
                'title' => 'Site Reliability Engineer',
                'profile' => '/images/profiles/kilari.png',
                'quote' => '“If you would not be forgotten as soon as you are dead, either write something worth reading or do things worth writing.” - Benjamin Franklin',
            ],
            [
                'name' => 'Sullivan',
                'title' => 'Frontend Developer',
                'profile' => '/images/profiles/sullivan.jpg',
                'quote' => '“Never stop investing. Never stop improving. Never stop doing something new.” - Bob Parsons',
            ],

            [
                'name' => 'Jason',
                'title' => 'QA & Product Support',
                'profile' => '/images/profiles/jason.png',
                'quote' => '“Do not go gentle into that good night, old age should burn and rave at close of day; Rage, rage against the dying of the light.” - Dylan Thomas',
            ],
            [
                'name' => 'Mushin',
                'title' => 'Product Liaison',
                'profile' => '/images/profiles/mushin.png',
                'quote' => '“I never think of the future – it comes soon enough.” -Albert Einstein',
            ],

            [
                'name' => 'Leo',
                'title' => 'BI & Data Services',
                'profile' => '/images/profiles/leo.png',
                'quote' => '“When you want something, all the universe conspires in helping you to achieve it.”   – Paulo Coelho, The Alchemist',
            ],
            [
                'name' => 'Derek',
                'title' => 'Business Development',
                'profile' => '/images/profiles/derek.png',
                'quote' => '“Innovation distinguishes between a leader and a follower.” —Steve Jobs',
            ],
            [
                'name' => 'Gary',
                'title' => 'Data Scientist',
                'profile' => '/images/profiles/gary.png',
                'quote' => '“No man can win every battle, but no man should fall without a struggle.”  - Peter Parker',
            ],
            [
                'name' => 'Lukas',
                'title' => 'Software Engineer',
                'profile' => '/images/profiles/lukas.png',
                'quote' => '“Our virtues and our failings are inseparable, like force and matter. When they separate, man is no more.” - Nikola Tesla',
            ],
            [
                'name' => 'Stacy',
                'title' => 'Office Administration',
                'profile' => '/images/profiles/stacy.png',
                'quote' => '“For good ideas and true innovation, you need human interaction, conflict, argument, debate.” -Margaret Heffernan',
            ],

            [
                'name' => 'Enrique',
                'title' => 'Strategy',
                'profile' => '/images/profiles/enrique.png',
                'quote' => '“Knowing what you’re doing gets you halfway there..”',
            ],


        ];

        return view('front.about.page', ['team' => $team]);
    }

    public function services()
    {
        $service_points = [
            [
                'heading' => 'See The Big Picture, Understand the Story',
                'content' => 'Ability to break down text into subcomponents that include proper name extraction, summarization, language identification, link analysis and categorization to help you absorb only the relevant  data.',
            ],
            [
                'heading' => 'Understand the Essence',
                'content' => 'Using deep learning methodologies, we segment information by topic and organize it in a way that makes sense to you.',
            ],
            [
                'heading' => 'Identify key Players and Elements - See How Things Relate',
                'content' => 'Ability to identify proper names that include company names, persons, stock tickers, numerical value ranges and link analysis capable of identifying and aggregating link recurrence to understand why a link is popular and help you find your way to the most important data.',
            ],
            [
                'heading' => 'Check the Mood',
                'content' => 'Utilizing sentiment analysis to determine the mood of the content.',
            ],
            [
                'heading' => 'Classifying & Topic Extraction',
                'content' => 'Organizing information to derived topics and identify targeted information for decision making process.',
            ],
            [
                'heading' => 'Get To the Point',
                'content' => 'The ability to quickly summarize data and provide key components you need to scan through only the relevant information.',
            ],
        ];
        return view('front.services.page', ['service_points' => $service_points]);
    }

    public function thanks()
    {

        return view('front.thanks', ['name' => request('name')]);
    }
}
