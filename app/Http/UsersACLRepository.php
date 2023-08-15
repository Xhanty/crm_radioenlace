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
        if (Auth::id() === 6 || Auth::id() === 43 || Auth::id() === 32) {
            return [
                ['disk' => 'public', 'path' => '*', 'access' => 2],
            ];
        }

        if(Auth::id() === 9) {
            return [
                ['disk' => 'public', 'path' => '/', 'access' => 1], // main folder - read
                ['disk' => 'public', 'path' => '', 'access' => 1], // only read
                ['disk' => 'public', 'path' => Auth::user()->nombre, 'access' => 1], // only read
                ['disk' => 'public', 'path' => Auth::user()->nombre . '/*', 'access' => 2], // read and write
                ['disk' => 'public', 'path' => 'Vehículos', 'access' => 1], // main folder - read
                ['disk' => 'public', 'path' => 'Vehículos/*', 'access' => 2], // read and write
                ['disk' => 'public', 'path' => 'Documentos RH', 'access' => 1], // main folder - read
                ['disk' => 'public', 'path' => 'Documentos RH/*', 'access' => 2], // read and write
            ];
        }

        if (Auth::id() === 39) {
            return [
                ['disk' => 'public', 'path' => '/', 'access' => 1], // main folder - read
                ['disk' => 'public', 'path' => '', 'access' => 1], // only read
                //['disk' => 'public', 'path' => Auth::user()->nombre, 'access' => 1], // only read
                //['disk' => 'public', 'path' => Auth::user()->nombre . '/*', 'access' => 2], // read and write
                ['disk' => 'public', 'path' => 'Mintic', 'access' => 1], // main folder - read
                ['disk' => 'public', 'path' => 'Mintic/*', 'access' => 2], // read and write
            ];
        }

        if (Auth::id() === 38) {
            return [
                ['disk' => 'public', 'path' => '/', 'access' => 1], // main folder - read
                ['disk' => 'public', 'path' => '', 'access' => 1], // only read
                ['disk' => 'public', 'path' => 'Sirley Tatiana Murillo Gómez', 'access' => 1], // only read
                ['disk' => 'public', 'path' => 'Sirley Tatiana Murillo Gómez/SG-SST', 'access' => 1], // only read
                ['disk' => 'public', 'path' => 'Sirley Tatiana Murillo Gómez/SG-SST/*', 'access' => 2], // only read
            ];
        }

        return [
            ['disk' => 'public', 'path' => '/', 'access' => 1], // main folder - read
            ['disk' => 'public', 'path' => '', 'access' => 1], // only read
            ['disk' => 'public', 'path' => Auth::user()->nombre, 'access' => 1], // only read
            ['disk' => 'public', 'path' => Auth::user()->nombre . '/*', 'access' => 2], // read and write
        ];
    }
}