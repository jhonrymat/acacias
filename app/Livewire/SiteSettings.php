<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteSetting;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;

class SiteSettings extends Component
{
    use WithFileUploads;

    public $site_name;
    public $logo;
    public $favicon;
    public $existing_logo;
    public $existing_favicon;

    public function mount()
    {
        $settings = SiteSetting::first();
        $this->site_name = $settings->site_name;
        $this->existing_logo = $settings->logo_path;
        $this->existing_favicon = $settings->favicon_path;
    }

    public function save()
    {
        $this->validate([
            'site_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048|dimensions:max_width=300,max_height=100',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024|dimensions:width=64,max_height=82',
        ], [
            'logo.dimensions' => 'El logo debe tener al menos 300x100 píxeles.',
            'favicon.dimensions' => 'El favicon debe tener exactamente 64x64 píxeles.',
        ]);

        $settings = SiteSetting::first();

        if ($this->logo) {
            $logoPath = $this->logo->store('logos', 'public');
            $settings->logo_path = $logoPath;
        }

        if ($this->favicon) {
            $faviconPath = $this->favicon->store('favicons', 'public');
            $settings->favicon_path = $faviconPath;
        }

        $settings->site_name = $this->site_name;
        $settings->save();

        session()->flash('message', 'Configuración actualizada correctamente.');

        $this->mount(); // Actualiza los datos existentes para reflejar cambios
    }

    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        session()->flash('message', 'Caché limpiada correctamente.');
    }


    public function render()
    {
        return view('livewire.site-settings');
    }
}
