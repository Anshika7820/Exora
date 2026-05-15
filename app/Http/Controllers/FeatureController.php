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
            return response()->json(['reply' => "Hello! 👋 I'm your Exora Virtual Assistant. I'm here to help you navigate our 7 interactive 3D halls, auditorium sessions, and marketplaces. How can I assist you today?"]);
        }

        // How are you
        if (str_contains($message, 'how are you') || str_contains($message, 'how r u') || str_contains($message, 'how do you do')) {
            return response()->json(['reply' => "I am functioning perfectly within the Exora digital realm! 🤖 I'm ready to guide you through our stunning 3D exhibitions. What would you like to explore first?"]);
        }

        // Who are you / What are you
        if (str_contains($message, 'who are you') || str_contains($message, 'what are you') || str_contains($message, 'your name')) {
            return response()->json(['reply' => "I am the Exora AI Assistant! My core directive is to ensure you have an unforgettable, immersive experience across our virtual exhibition platform."]);
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
            return response()->json(['reply' => "I can help you find upcoming 'sessions' in the Auditorium, locate 'booths' in our Marketplaces, explain how to earn 'points' for your Expo Passport, or guide you through our 7 unique 3D 'halls'. What would you like to know?"]);
        }

        // Catch-all
        $catchAllResponses = [
            "I'm deeply integrated into the Exora platform, but I might need a bit more context. Try asking me about our 3D 'halls', live 'sessions', or virtual 'booths'!",
            "That's interesting! While I'm an expert on the Exora Virtual Exhibition Platform, I might not have the answer to that. Are you looking to explore a specific 'hall' or 'booth'?",
            "As an AI dedicated to this virtual expo, my knowledge is focused on our 7 themed halls and auditorium events. Can I help you navigate to any of those?"
        ];
        
        return response()->json(['reply' => $catchAllResponses[array_rand($catchAllResponses)]]);
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
