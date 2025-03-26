<div class="bg-white rounded-lg p-6 w-full max-w-2xl max-h-screen overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Detalle de <span id="modalModel"></span></h3>
            <button onclick="toggleDetail()" class="text-gray-500">
                <i class="fas fa-times text-gray-500 text-2xl"></i>
            </button>
        </div>
        <div class="space-y-4">
            @foreach ($nameAtributes as $na)
                @if ($na != 'panel_model' && $na != 'user_id')
                    <p><strong>{{ ucfirst(str_replace('_', ' ', $na)) }}:</strong>
                        <span id="detail_{{ $na }}"></span>
                    </p>
                @endif
            @endforeach
        </div>
    </div>