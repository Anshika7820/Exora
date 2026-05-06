<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-8 py-3 bg-cyan-600 hover:bg-cyan-500 border border-transparent rounded-full font-black text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-[0_0_20px_rgba(8,145,178,0.3)]']) }}>
    {{ $slot }}
</button>
