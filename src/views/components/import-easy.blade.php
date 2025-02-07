@php([
    'label' => 'Importar',
    'icon' => null
])
<div>
    <form
        wire:submit.prevent="import"
        enctype="multipart/form-data"
        {{ $attributes->merge(['class' => 'align-items-center d-flex gap-2']) }}
    >
        @csrf

        {{ $slot ?? '' }}

        <div
            x-data="{ isUploading: false, progress: 0 }"
            x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false"
            x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress"
            class="w-full"
        >
            <input type="file"
               wire:model="importFile"
               class="form-control
               @error('import_file')
                   is-invalid
               @enderror"
               @if(!is_null($accept))
                   accept="{{ $accept }}"
               @endif
            />
            @error('import_file')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
            <!-- Progress Bar -->
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress" class="w-full"></progress>
            </div>
        </div>

        {{ $slotBefore ?? '' }}

        <div>
            <button type="submit" class="align-items-baseline btn btn-primary d-flex gap-1">
                @if(!is_null($icon))
                    <i class="{{ $icon }}"></i>
                @endif
                {{ $label }}
            </button>
        </div>
    </form>

    {{-- progress --}}
    @if($importFinishedMessageShow && $importFinished)
        {{ $importFinishedMessage }}
    @endif
    
    {{-- finish --}}
    @if($importingMessageShow && ($importing && !$importFinished))
        <div wire:poll="updateImportProgress">
            {{ $importingMessage }}
        </div>
    @endif
</div>
