<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booth;
use App\Models\Session;
use App\Models\User;
use App\Models\Exhibition;
use App\Models\ChatMessage;

class FeatureController extends Controller
{
    // 1. Database-Aware Chatbot
    public function chatbot(Request $request) {
        $message = strtolower($request->input('message', ''));
        
        // Greetings
        if (preg_match('/\b(hi|hello|hey|greetings|hola)\b/', $message)) {
            return response()->json(['reply' => "Hello! 👋 I'm your Virtual Expo Assistant. How can I help you navigate the exhibition today?"]);
        }

        if (str_contains($message, 'session') || str_contains($message, 'schedule')) {
            $sessions = Session::take(3)->get();
            if ($sessions->isEmpty()) return response()->json(['reply' => 'There are no live sessions scheduled yet. Check back soon!']);
            
            $reply = "Here are some exciting sessions coming up:\n";
            foreach($sessions as $s) {
                $reply .= "• " . $s->title . " (" . $s->time . ")\n";
            }
            $reply .= "\nYou can join them in the Auditorium!";
            return response()->json(['reply' => $reply]);
        }
        
        if (str_contains($message, 'booth') || str_contains($message, 'stall') || str_contains($message, 'hall')) {
            $booths = Booth::take(3)->get();
            if ($booths->isEmpty()) return response()->json(['reply' => "The Exhibition Hall is currently being set up. We'll have booths ready for you shortly!"]);
            
            $reply = "We have some amazing booths for you to explore:\n";
            foreach($booths as $b) {
                $reply .= "• " . $b->title . "\n";
            }
            $reply .= "\nHead over to the Exhibition Hall to see them all!";
            return response()->json(['reply' => $reply]);
        }

        if (str_contains($message, 'point') || str_contains($message, 'score') || str_contains($message, 'passport')) {
            return response()->json(['reply' => "You can earn Expo Points by visiting different booths and attending sessions! Check your 'Expo Passport' on the dashboard to see your progress. 🏆"]);
        }

        if (str_contains($message, 'help') || str_contains($message, 'what can you do')) {
            return response()->json(['reply' => "I can help you find 'sessions', locate 'booths', explain how to earn 'points', or guide you to the 'auditorium'. What would you like to know?"]);
        }

        return response()->json(['reply' => "I'm not sure I understand that yet. Try asking about 'sessions', 'booths', or how to earn 'points'!"]);
    }

    // 2 & 3. Gamification (Earn Points) and Analytics (Views)
    public function earnPoints(Request $request) {
        $user = auth()->user();
        if ($user) {
            $user->expo_score = ($user->expo_score ?? 0) + 10;
            $user->save();
        }
        return response()->json(['score' => $user->expo_score ?? 0]);
    }

    public function recordView(Request $request) {
        $exhibition = Exhibition::first(); // for simplicity, track on the first one
        if ($exhibition) {
            $exhibition->views = ($exhibition->views ?? 0) + 1;
            $exhibition->save();
        }
        return response()->json(['success' => true]);
    }

    // 4. Live Auditorium Chat
    public function getChatMessages() {
        $messages = ChatMessage::latest()->take(50)->get()->reverse()->values();
        return response()->json($messages);
    }

    public function storeChatMessage(Request $request) {
        $request->validate(['message' => 'required|string|max:500']);
        
        $message = ChatMessage::create([
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name,
            'message' => $request->message,
        ]);

        return response()->json($message);
    }
}
