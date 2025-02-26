<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center px-4 py-2 bg-white bg-opacity-90 border-2 border-[#49DBA3] text-black rounded-md font-semibold text-xs uppercase tracking-widest cursor-pointer transition-all duration-300 ease-in-out hover:bg-[#49DBA3] hover:text-white focus:bg-[#49DBA3] focus:text-white active:bg-[#49DBA3] active:text-white focus:outline-none focus:ring-2 focus:ring-[#49DBA3] focus:ring-offset-2 dark:focus:ring-offset-green-800'
]) }}>
    {{ $slot }}
</button>
