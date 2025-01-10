<?php

namespace App\Livewire\Dashboard;

use App\Models\Factura;
use App\Models\Organizacion;
use App\Models\Plan;
use App\Models\Servicio;
use App\Traits\CardView;
use App\Traits\Imagenes;
use App\Traits\LimitRows;
use App\Traits\ToastBootstrap;
use Illuminate\Support\Sleep;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use function Laravel\Prompts\text;

class OrganizacionesComponent extends Component
{
    use ToastBootstrap;
    use LimitRows;
    use CardView;
    use WithFileUploads;
    use Imagenes;

    public $texto = "Organización";
    public $mini, $imagen, $photo, $btnImgBorrar = false;
    public $nombre, $email, $telefono, $web, $moneda, $dias, $formato, $proxima, $direccion, $representante;

    public function mount()
    {
        $this->setLimit();
        $this->setSize(245);
        $this->setTitle();
        $this->confirmed = 'deleteOrganizaciones';
        $this->modulo = 'organizaciones';
        $this->rowquid = 'jhfghgfhghg';
    }

    public function render()
    {
        $listar = Organizacion::buscar($this->keyword)
            ->orderBy('created_at', 'DESC')
            ->limit($this->limit)
            ->get();
        $limit = $listar->count();
        $rows = Organizacion::buscar($this->keyword)->count();
        $this->btnVerMas($limit, $rows);

        return view('livewire.dashboard.organizaciones-component')
            ->with('listar', $listar)
            ->with('rows', $rows);
    }

    public function limpiar()
    {
        $this->limpiarCardView();
        $this->reset([
            'btnImgBorrar',
            'nombre', 'email', 'telefono', 'web', 'moneda', 'dias', 'formato', 'proxima',
            'direccion', 'representante',
        ]);
        $this->resetErrorBag();
        $this->setSaveImagen(false);
    }

    public function show($rowquid)
    {
        $this->setSizeFooter();
        $this->limpiar();
    }

    public function save()
    {
        $rules = [
            'nombre' => ['required', 'min:4', Rule::unique('organizaciones', 'nombre')->ignore($this->table_id)],
            'email' => 'required|email',
            'telefono' => 'required',
            'web' => 'required',
            'moneda' => 'required',
            'dias' => 'required|integer|gt:0|max:28',
            //'formato' => 'required',
            'proxima' => 'nullable|integer|gt:0',
            'direccion' => 'required',
            'representante' => 'required'
        ];
        $this->validate($rules);
    }

}
