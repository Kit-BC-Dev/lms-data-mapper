<?php

namespace App\DTO;

use App\Traits\ArrayableDTO;

class ClientNoteDTO
{
    use ArrayableDTO;

    public function __construct(
        public ?int $ClientID,
        public ?string $ExternalReference,
        public ?string $NoteType,
        public ?string $NoteSubject,
        public ?string $NoteText,
        public ?string $DateCreated,
        public ?string $DateModified,
        public ?string $CreatedBy = 'migration',
        public ?string $ModifiedBy = 'migration'
    ){}
}