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

class OrganizacionesComponent extends Component
{
    use ToastBootstrap;
    use LimitRows;
    use WithFileUploads;
    use Imagenes;
    use CardView;

    public $title = "Ver Organización";
    public $mini, $imagen, $photo, $btnImgBorrar = false;
    public $nombre, $email, $telefono, $web, $moneda, $dias, $formato, $proxima, $direccion, $representante;

    #[Locked]
    public $table_id, $rowquid;

    public function mount()
    {
        $this->setLimit();
        $this->setSize(245);
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
            'title', 'btnImgBorrar',
            'nombre', 'email', 'telefono', 'web', 'moneda', 'dias', 'formato', 'proxima',
            'direccion', 'representante',
            'table_id'
        ]);
        $this->resetErrorBag();
        $this->setSaveImagen(false);
    }

    protected function setTitle($option = null)
    {
        $this->title = match ($option) {
            'edit' => "Editar Organización",
            default => "Crear Organización",
        };

    }

    public function create()
    {
        $this->limpiar();
        $this->setTitle();
        $this->btnNuevo = false;
        $this->btnCancelar = true;
        $this->form = true;
        $this->sizeFooter = 0;
    }

    public function show($rowquid)
    {
        $this->setSizeFooter();
        $this->limpiar();
    }
    public function edit()
    {
        $this->setTitle('edit');
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

    public function cancel()
    {
        if ($this->rowquid){
            $this->show($this->rowquid);
        }else{
            $this->create();
        }
    }


}
