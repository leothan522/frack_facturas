<?php

namespace App\Livewire\Web;

use App\Mail\CodigosMail;
use App\Models\Cliente;
use App\Models\Parametro;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class LoginComponent extends Component
{
    use LivewireAlert;

    public $user = false;
    public $cedula, $codigo, $cliente;

    public function render()
    {
        $this->getSession();
        return view('livewire.web.login-component');
    }

    public function limpiar()
    {
        $this->reset([
            'cedula', 'codigo'
        ]);
        $this->resetErrorBag();
    }

    public function validarCedula()
    {
        $rules = [
            //'cedula' => 'required|integer|digits_between:6,10|exists:clientes,cedula',
            'cedula' => [
                'required', 'integer', 'digits_between:6,10',
                Rule::exists('clientes', 'cedula')->where(function (Builder $query) {
                    return $query->where('deleted_at', null);
                }),
            ]
        ];

        $messages = [
            'cedula.exists' => 'La cedula ingresada no se encuentra registrada.',
        ];

        $this->validate($rules, $messages);

        $cliente = Cliente::where('cedula', $this->cedula)->first();
        if ($cliente) {
            $idCliente = $cliente->id;
            $this->borrarCodigosViejos($idCliente);
            $codigo = generarStringAleatorio(6, true);
            $parametro = new Parametro();
            $parametro->nombre = "codigo_seguridad";
            $parametro->tabla_id = $idCliente;
            $parametro->valor = $codigo;
            do{
                $rowquid = generarStringAleatorio(16);
                $existe = Parametro::where('rowquid', '=', $rowquid)->first();
            }while ($existe);
            $parametro->rowquid = $rowquid;
            $parametro->save();
            //anexamos los datos extras en data para enviar email
            $data['from_email'] = getCorreoSistema();
            $data['from_name'] = config('app.name');
            $data['subject'] = "CÓDIGO DE SEGURIDAD: $codigo";
            $data['nombre'] = strtoupper($cliente->nombre);
            $data['apellido'] = strtoupper($cliente->apellido);
            $data['codigo'] = $codigo;
            $data['telefono'] = getTelefonoSistema();
            $data['email'] = getCorreoSistema();

            //enviamos el correo
            $to = $cliente->email;
            Mail::to($to)->send(new CodigosMail($data));

            //guardamos las variables de sesion
            session()->put('guest', $cliente);
            session()->put('idParametro', $parametro->id);
            $this->user = true;
        }
        $this->limpiar();
    }

    public function validarCodigo()
    {
        $rules = [
            'codigo' => 'required|numeric|digits:6',
        ];
        $this->validate($rules);

        $parametro = Parametro::where('nombre','codigo_seguridad')
            ->where('tabla_id', $this->cliente['id'])
            ->first();
        if ($parametro) {
            $codigo = $parametro->valor;
            if ($codigo == $this->codigo){
                session()->put('cliente', $this->cliente);
                $this->deleteSession();
                $this->alert('success', 'Iniciando sesión...');
                $this->redirect('consultar');
            }else{
                $this->alert('error', '¡Código Invalido!', [
                    'position' => 'center',
                    'timer' => '',
                    'toast' => false,
                    'text' => 'El Código de seguridad es incorrecto, verifique e intente nuevamente.',
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                    'confirmButtonText' => 'OK',
                ]);
            }
        }else{
            $this->alert('warning', '¡Código Vencido!', [
                'position' => 'center',
                'timer' => '',
                'toast' => false,
                'text' => 'El Código de seguridad ha caducado, debes solicitar uno nuevo.',
                'showConfirmButton' => true,
                'onConfirmed' => '',
                'confirmButtonText' => 'OK',
            ]);
            $this->deleteSession();
        }
    }

    protected function getSession(): void
    {
        if (session()->has('guest')) {
            $this->cliente = session('guest');
            $this->user = true;
        }
    }

    public function deleteSession(): void
    {
        $parametro = Parametro::find(session('idParametro'));
        if ($parametro) {
            $parametro->delete();
        }
        session()->forget('idParametro');
        session()->forget('guest');
        $this->limpiar();
        $this->reset(['user', 'cliente']);
    }

    protected function borrarCodigosViejos($id): void
    {
        $parametros =  Parametro::where('nombre', 'codigo_seguridad')
            ->where('tabla_id', $id)
            ->get();
        foreach ($parametros as $parametro){
            $borrar = Parametro::find($parametro->id);
            $borrar->delete();
        }
    }

}
