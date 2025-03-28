<x-app-layout>
    <button onclick="showImport({{ json_encode($import) }})" class="bg-[#49DBA3] hover:bg-[#193849] text-white py-2 px-4 rounded-lg">show import</button> 
    <script src="{{asset('build/js/panels/newPanel.js')}}"></script>
</x-app-layout>