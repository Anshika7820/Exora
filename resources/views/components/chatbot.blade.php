<div id="chatbot-wrapper" class="fixed bottom-6 right-6 z-[200] flex flex-col items-end">
    <!-- Chat Window -->
    <div id="chat-window" class="hidden w-80 sm:w-96 bg-white/80 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden border border-white/20 mb-4 transform transition-all duration-300 origin-bottom-right scale-95 opacity-0">
        <!-- Header -->
        <div class="bg-indigo-600 p-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <span class="text-xl">👋</span>
                </div>
                <div>
                    <h3 class="text-white font-semibold leading-tight">Exora Guide</h3>
                    <span class="text-indigo-200 text-xs flex items-center">
                        <span class="w-2 h-2 bg-green-400 rounded-full mr-1.5 animate-pulse"></span>
                        Online & Ready
                    </span>
                </div>
            </div>
            <button onclick="toggleChat()" class="text-white/80 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Messages Area -->
        <div id="chat-messages" class="h-96 overflow-y-auto p-4 space-y-4 bg-gray-50/50">
            <div class="flex items-start">
                <div class="bg-indigo-100 text-indigo-800 rounded-2xl rounded-tl-none p-3 max-w-[85%] text-sm shadow-sm">
                    Hi! I'm your Exora Guide. How can I help you today?
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-4 bg-white border-t border-gray-100">
            <form id="chat-form" class="flex space-x-2">
                <input type="text" id="chat-input" placeholder="Type a message..." 
                    class="flex-1 bg-gray-100 border-none rounded-xl px-4 py-2 text-sm text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all outline-none">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white p-2 rounded-xl transition-colors shadow-lg shadow-indigo-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Toggle Button (FAB) -->
    <button onclick="toggleChat()" id="chat-toggle" class="bg-indigo-600 hover:bg-indigo-700 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-xl hover:shadow-indigo-300 transition-all duration-300 transform hover:scale-110 active:scale-95 group">
        <svg id="chat-icon-open" class="w-7 h-7 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
        </svg>
    </button>
</div>

<script>
    const chatWindow = document.getElementById('chat-window');
    const chatMessages = document.getElementById('chat-messages');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    let isOpen = false;

    function toggleChat() {
        isOpen = !isOpen;
        if (isOpen) {
            chatWindow.classList.remove('hidden');
            setTimeout(() => {
                chatWindow.classList.remove('scale-95', 'opacity-0');
                chatWindow.classList.add('scale-100', 'opacity-100');
            }, 10);
        } else {
            chatWindow.classList.remove('scale-100', 'opacity-100');
            chatWindow.classList.add('scale-95', 'opacity-0');
            setTimeout(() => chatWindow.classList.add('hidden'), 300);
        }
    }

    function addMessage(message, isUser = false) {
        const div = document.createElement('div');
        div.className = `flex ${isUser ? 'justify-end' : 'justify-start'}`;
        div.innerHTML = `
            <div class="${isUser ? 'bg-indigo-600 text-white rounded-tr-none' : 'bg-indigo-100 text-indigo-800 rounded-tl-none'} rounded-2xl p-3 max-w-[85%] text-sm shadow-sm animate-fade-in-up">
                ${message.replace(/\n/g, '<br>')}
            </div>
        `;
        chatMessages.appendChild(div);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    chatForm.onsubmit = async (e) => {
        e.preventDefault();
        const msg = chatInput.value.trim();
        if (!msg) return;

        addMessage(msg, true);
        chatInput.value = '';

        try {
            const response = await fetch('/api/chatbot', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ message: msg })
            });
            const data = await response.json();
            
            // Add a small delay for "thinking" feel
            setTimeout(() => addMessage(data.reply), 500);
        } catch (error) {
            addMessage("Sorry, I'm having trouble connecting right now. Please try again later.");
        }
    };
</script>

<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.3s ease-out forwards;
    }
</style>
