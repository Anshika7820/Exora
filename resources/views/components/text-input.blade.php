@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-gray-800/50 border-gray-700 text-white focus:border-cyan-500 focus:ring-cyan-500 rounded-xl shadow-sm']) }}>
