<x-app-layout>
    <form action="{{ route('veureImport') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv_file">
        <button type="submit" class="bg-[#49DBA3] hover:bg-[#193849] text-white py-2 px-4 rounded-lg">Upload CSV</button>
    </form>
    <script src="{{ asset('build/js/panels/newPanel.js') }}"></script>
</x-app-layout>
            