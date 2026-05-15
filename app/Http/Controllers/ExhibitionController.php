<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Exhibition;
use App\Models\Booth;
use App\Models\Session;
use App\Models\Feedback;
use App\Models\Contact;
use App\Models\ExhibitItem;

class ExhibitionController extends Controller
{
    private $accessKey = "YOUR_UNSPLASH_ACCESS_KEY";

    public function hall($id = '1') {
        $halls = [
            '1' => [
                'id' => '1',
                'title' => 'Atrium A',
                'desc' => 'Navigating through the Main Atrium. Engage with high-fidelity exhibits.',
                'query' => 'virtual exhibition hall',
                'env_image' => 'https://images.unsplash.com/photo-1541123356219-284ebe98ae3b?w=4000&q=80',
                'theme_color' => 'cyan',
                'classes' => ['bg' => 'bg-cyan-600', 'text' => 'text-cyan-500', 'border' => 'border-cyan-500', 'hover_border' => 'hover:border-cyan-500', 'shadow' => 'shadow-[0_0_15px_rgba(8,145,178,0.4)]', 'hover_shadow' => 'hover:shadow-[0_0_30px_rgba(34,211,238,0.15)]']
            ],
            '2' => [
                'id' => '2',
                'title' => 'Tech-Expanse B',
                'desc' => 'Exploring the Digital Frontier. Immerse yourself in the future.',
                'query' => 'futuristic digital architecture',
                'env_image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=4000&q=80',
                'theme_color' => 'purple',
                'classes' => ['bg' => 'bg-purple-600', 'text' => 'text-purple-500', 'border' => 'border-purple-500', 'hover_border' => 'hover:border-purple-500', 'shadow' => 'shadow-[0_0_15px_rgba(147,51,234,0.4)]', 'hover_shadow' => 'hover:shadow-[0_0_30px_rgba(168,85,247,0.15)]']
            ],
            '3' => [
                'id' => '3',
                'title' => 'Robotics Hub',
                'desc' => 'Advanced AI and Robotics display. See the technology of tomorrow.',
                'query' => 'robotics technology',
                'env_image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=4000&q=80',
                'theme_color' => 'blue',
                'classes' => ['bg' => 'bg-blue-600', 'text' => 'text-blue-500', 'border' => 'border-blue-500', 'hover_border' => 'hover:border-blue-500', 'shadow' => 'shadow-[0_0_15px_rgba(37,99,235,0.4)]', 'hover_shadow' => 'hover:shadow-[0_0_30px_rgba(59,130,246,0.15)]']
            ],
            '4' => [
                'id' => '4',
                'title' => 'Diamond Vault',
                'desc' => 'A showcase of exquisite diamonds and high-end jewelry.',
                'query' => 'diamonds jewelry',
                'env_image' => 'https://images.unsplash.com/photo-1511447333015-45b65e60f6d5?fm=jpg&w=1080&q=80',
                'theme_color' => 'teal',
                'classes' => ['bg' => 'bg-teal-600', 'text' => 'text-teal-500', 'border' => 'border-teal-500', 'hover_border' => 'hover:border-teal-500', 'shadow' => 'shadow-[0_0_15px_rgba(13,148,136,0.4)]', 'hover_shadow' => 'hover:shadow-[0_0_30px_rgba(20,184,166,0.15)]']
            ],
            '5' => [
                'id' => '5',
                'title' => 'Global Book Fair',
                'desc' => 'Explore the vast virtual library and discover new literature.',
                'query' => 'library books',
                'env_image' => 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=4000&q=80',
                'theme_color' => 'amber',
                'classes' => ['bg' => 'bg-amber-600', 'text' => 'text-amber-500', 'border' => 'border-amber-500', 'hover_border' => 'hover:border-amber-500', 'shadow' => 'shadow-[0_0_15px_rgba(217,119,6,0.4)]', 'hover_shadow' => 'hover:shadow-[0_0_30px_rgba(245,158,11,0.15)]']
            ],
            '6' => [
                'id' => '6',
                'title' => 'Masterpiece Art Gallery',
                'desc' => 'Stunning classical and modern paintings gathered in one place.',
                'query' => 'art gallery paintings',
                'env_image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=4000&q=80',
                'theme_color' => 'pink',
                'classes' => ['bg' => 'bg-pink-600', 'text' => 'text-pink-500', 'border' => 'border-pink-500', 'hover_border' => 'hover:border-pink-500', 'shadow' => 'shadow-[0_0_15px_rgba(219,39,119,0.4)]', 'hover_shadow' => 'hover:shadow-[0_0_30px_rgba(236,72,153,0.15)]']
            ],
            '7' => [
                'id' => '7',
                'title' => 'Automobile Showcase',
                'desc' => 'Next-generation concept cars and automotive engineering.',
                'query' => 'sports car automobile',
                'env_image' => 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=4000&q=80',
                'theme_color' => 'red',
                'classes' => ['bg' => 'bg-red-600', 'text' => 'text-red-500', 'border' => 'border-red-500', 'hover_border' => 'hover:border-red-500', 'shadow' => 'shadow-[0_0_15px_rgba(220,38,38,0.4)]', 'hover_shadow' => 'hover:shadow-[0_0_30px_rgba(239,68,68,0.15)]']
            ],
        ];

        $currentHall = $halls[$id] ?? $halls['1'];
        $images = $this->fetchImagesOnly($currentHall['query']);
        $optimizedImages = array_map(function($img) {
            return [
                'thumb' => $img['urls']['small'] ?? $img['urls']['regular'],
                'full' => $img['urls']['regular']
            ];
        }, $images);

        // Fetch items specifically placed in this hall
        $placedItems = ExhibitItem::where('hall_id', $currentHall['id'])->get();

        // Fetch Exhibitions hosted in this hall
        $hostedExhibitions = Exhibition::where('hall', $currentHall['id'])->get();

        return view('hall', [
            'halls' => $halls,
            'currentHall' => $currentHall,
            'images' => $optimizedImages,
            'placedItems' => $placedItems,
            'hostedExhibitions' => $hostedExhibitions
        ]);
    }

    public function auditorium() {
        $dbSessions = Session::all();
        $apiImages = $this->fetchImagesOnly("conference auditorium");
        $optimizedImages = array_map(function($img) {
            return [
                'thumb' => $img['urls']['small'] ?? $img['urls']['regular'],
                'full'  => $img['urls']['regular']
            ];
        }, $apiImages);
        return view('auditorium', ['sessions' => $dbSessions, 'images' => $optimizedImages]);
    }

    public function booths() {
        $dbBooths = Booth::all();
        $apiImages = $this->fetchImagesOnly("trade show booth");
        $optimizedImages = array_map(function($img) {
            return [
                'thumb' => $img['urls']['small'] ?? $img['urls']['regular'],
                'full'  => $img['urls']['regular']
            ];
        }, $apiImages);
        return view('booths', ['dbBooths' => $dbBooths, 'images' => $optimizedImages]);
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
        // Transform images to favor small thumbnails for speed
        $optimizedImages = array_map(function($img) {
            return [
                'thumb' => $img['urls']['small'] ?? $img['urls']['regular'],
                'full' => $img['urls']['regular']
            ];
        }, $images);
        return view($view, ['images' => $optimizedImages]);
    }

    public function create() {
        return view('creator.exhibitions.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'hall' => 'nullable|string',
            'image_url' => 'required|url'
        ]);

        Exhibition::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'creator_id' => auth()->id(),
            'hall' => $request->hall ?? '1',
        ]);

        return redirect()->route('hall', ['id' => $request->hall ?? '1'])->with('status', 'Exhibition created successfully! It is now live in this hall.');
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
            'video_url' => 'nullable|url',
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
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'rating'  => 'required|integer|min:1|max:5',
            'message' => 'required|string|min:10',
        ]);

        Feedback::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'rating'  => $request->rating,
            'message' => $request->message,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('feedback')->with('status', 'Thank you for your feedback! We truly appreciate it. ⭐');
    }

    public function about() {
        return view('about');
    }

    public function contact() {
        return view('contact');
    }

    public function storeContact(Request $request) {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        Contact::create([
            'subject' => $request->subject,
            'message' => $request->message,
            'user_id' => auth()->id(),
            'status'  => 'open',
        ]);

        return redirect()->route('contact')->with('status', 'Your support request has been submitted successfully.');
    }

    public function storeExhibitItem(Request $request) {
        $request->validate([
            'hall_id' => 'required|string',
            'type' => 'required|string',
            'url' => 'required|url',
            'title' => 'nullable|string',
            'x' => 'required|numeric',
            'y' => 'required|numeric',
            'z' => 'required|numeric',
            'rotation_x' => 'required|numeric',
            'rotation_y' => 'required|numeric',
            'rotation_z' => 'required|numeric',
        ]);

        $item = ExhibitItem::create([
            'hall_id' => $request->hall_id,
            'creator_id' => auth()->id(),
            'type' => $request->type,
            'url' => $request->url,
            'title' => $request->title,
            'x' => $request->x,
            'y' => $request->y,
            'z' => $request->z,
            'rotation_x' => $request->rotation_x,
            'rotation_y' => $request->rotation_y,
            'rotation_z' => $request->rotation_z,
            'scale' => $request->scale ?? 1,
        ]);

        return response()->json(['success' => true, 'item' => $item]);
    }
}
