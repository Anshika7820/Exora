<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Exhibition;
use App\Models\Booth;
use App\Models\Session;
use App\Models\Feedback;

class ExhibitionController extends Controller
{
    private $accessKey = "YOUR_UNSPLASH_ACCESS_KEY";

    public function hall() {
        return $this->fetchImages("virtual exhibition hall", "hall");
    }

    public function auditorium() {
        $dbSessions = Session::all();
        $apiImages = $this->fetchImagesOnly("conference auditorium");
        return view('auditorium', ['sessions' => $dbSessions, 'images' => $apiImages]);
    }

    public function booths() {
        $dbBooths = Booth::all();
        $apiImages = $this->fetchImagesOnly("trade show booth");
        return view('booths', ['dbBooths' => $dbBooths, 'images' => $apiImages]);
    }

    private function fetchImagesOnly($query) {
        $images = [
            ['urls' => ['small' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=500&q=80', 'regular' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=1080&q=80']],
            ['urls' => ['small' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=500&q=80', 'regular' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1080&q=80']],
            ['urls' => ['small' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=500&q=80', 'regular' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=1080&q=80']],
            ['urls' => ['small' => 'https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?w=500&q=80', 'regular' => 'https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?w=1080&q=80']],
            ['urls' => ['small' => 'https://images.unsplash.com/photo-1551818255-e6e10975bc17?w=500&q=80', 'regular' => 'https://images.unsplash.com/photo-1551818255-e6e10975bc17?w=1080&q=80']],
            ['urls' => ['small' => 'https://images.unsplash.com/photo-1515169067868-5387ec356754?w=500&q=80', 'regular' => 'https://images.unsplash.com/photo-1515169067868-5387ec356754?w=1080&q=80']]
        ];

        if ($this->accessKey !== "YOUR_UNSPLASH_ACCESS_KEY") {
            try {
                $response = Http::get('https://api.unsplash.com/search/photos', [
                    'query' => $query,
                    'client_id' => $this->accessKey
                ]);
                $data = $response->json();
                if (isset($data['results'])) {
                    $images = $data['results'];
                }
            } catch (\Exception $e) {}
        }
        return $images;
    }

    private function fetchImages($query, $view) {
        $images = $this->fetchImagesOnly($query);
        return view($view, compact('images'));
    }

    public function create() {
        return view('creator.exhibitions.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Exhibition::create([
            'title' => $request->title,
            'description' => $request->description,
            'creator_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard')->with('status', 'Exhibition created successfully!');
    }

    public function createBooth() {
        return view('creator.booths.create');
    }

    public function storeBooth(Request $request) {
        $request->validate([
            'exhibition_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        Booth::create($request->all());
        return redirect()->route('booths')->with('status', 'Booth added successfully!');
    }

    public function createSession() {
        return view('creator.sessions.create');
    }

    public function storeSession(Request $request) {
        $request->validate([
            'exhibition_id' => 'required',
            'title' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'video_url' => 'nullable|url',
        ]);

        Session::create($request->all());
        return redirect()->route('auditorium')->with('status', 'Session scheduled successfully!');
    }

    public function feedback() {
        return view('feedback');
    }

    public function storeFeedback(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Feedback::create([
            'name' => $request->name,
            'message' => $request->message,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('feedback')->with('status', 'Thank you for your feedback!');
    }
}
