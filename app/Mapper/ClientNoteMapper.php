<?php

namespace App\Mapper;

use App\DTO\ClientNoteDTO;

class ClientNoteMapper
{
    public function map(array $data, int $clientID): ClientNoteDTO
    {
        return new ClientNoteDTO(
            ClientID: $clientID,
            ExternalReference: $data['ContactID'],
            NoteType: $data['Method'],
            NoteSubject: $data['Subject'],
            NoteText: $data['ContactDetails'],
            DateCreated: $data['Created'],
            DateModified: $data['Modified']
        );
    }
}