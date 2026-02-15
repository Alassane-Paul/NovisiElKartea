<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'type', // contact, join, newsletter
        'status',
        'data', // Données supplémentaires JSON
    ];

    protected $casts = [
        'data' => 'array',
    ];

    const TYPES = [
        'contact' => 'Contacto',
        'join' => 'Asociación',
        'newsletter' => 'Newsletter',
    ];

    const STATUSES = [
        'pending' => 'Pendiente',
        'read' => 'Leído',
        'replied' => 'Respondido',
        'archived' => 'Archivado',
    ];
}