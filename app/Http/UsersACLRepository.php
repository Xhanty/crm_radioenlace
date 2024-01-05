<?php

namespace App\Http;

use Alexusmai\LaravelFileManager\Services\ACLService\ACLRepository;
use Illuminate\Support\Facades\Auth;

class UsersACLRepository implements ACLRepository
{
    /**
     * Get user ID
     *
     * @return mixed
     */

    public function getUserID()
    {
        return Auth::id();
    }

    /**
     * Get ACL rules list for user
     *
     * @return array
     */
    public function getRules(): array
    {
        if(auth()->user()->hasPermissionTo('gestion_documentos_gerencia')) {
            return [
                ['disk' => 'public', 'path' => '/', 'access' => 1], // main folder - read
                ['disk' => 'public', 'path' => '', 'access' => 1], // only read
                ['disk' => 'public', 'path' => 'Dcto Gerencia', 'access' => 1], // main folder - read
                ['disk' => 'public', 'path' => 'Dcto Gerencia/*', 'access' => 2], // read and write
                ['disk' => 'public', 'path' => 'Documentos', 'access' => 1], // main folder - read
                ['disk' => 'public', 'path' => 'Documentos/*', 'access' => 2], // read and write
            ];
        } else {
            if (Auth::id() === 6 || Auth::id() === 43 || Auth::id() === 8) {
                return [
                    ['disk' => 'public', 'path' => '/', 'access' => 1], // main folder - read
                    ['disk' => 'public', 'path' => '', 'access' => 1], // only read
                    ['disk' => 'public', 'path' => 'Documentos', 'access' => 1], // main folder - read
                    ['disk' => 'public', 'path' => 'Documentos/*', 'access' => 2], // read and write
                ];
            }
    
            if (Auth::id() === 9) {
                return [
                    ['disk' => 'public', 'path' => '/', 'access' => 1], // main folder - read
                    ['disk' => 'public', 'path' => '', 'access' => 1], // only read
                    ['disk' => 'public', 'path' => 'Documentos/' . Auth::user()->nombre, 'access' => 1], // only read
                    ['disk' => 'public', 'path' => 'Documentos/' . Auth::user()->nombre . '/*', 'access' => 2], // read and write
                    ['disk' => 'public', 'path' => 'Documentos/Vehículos', 'access' => 1], // main folder - read
                    ['disk' => 'public', 'path' => 'Documentos/Vehículos/*', 'access' => 2], // read and write
                    ['disk' => 'public', 'path' => 'Documentos/Documentos RH', 'access' => 1], // main folder - read
                    ['disk' => 'public', 'path' => 'Documentos/Documentos RH/*', 'access' => 2], // read and write
                ];
            }
    
            return [
                ['disk' => 'public', 'path' => '/', 'access' => 1], // main folder - read
                ['disk' => 'public', 'path' => '', 'access' => 1], // only read
                ['disk' => 'public', 'path' => 'Documentos/' . Auth::user()->nombre, 'access' => 1], // only read
                ['disk' => 'public', 'path' => 'Documentos/' . Auth::user()->nombre . '/*', 'access' => 2], // read and write
            ];
        }
    }
}
