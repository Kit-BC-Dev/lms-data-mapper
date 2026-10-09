<?php

namespace App\Mapper;

use App\DTO\LoanPaymentDTO;

class LoanPaymentMapper
{
    public function map(array $data, int $loanID, string $status): LoanPaymentDTO
    {
        return new LoanPaymentDTO(
            LoanID: $loanID,
            Date: $data['DateOfPayment'],
            DateSuccessful: $data['DateOfPayment'],
            PaymentType: $data['type']['Description'],
            PaymentStatus: $status,
            Amount: $data['AmountOfPayment'],
            Comment: $data['Notes'],
            ExternalAPIRef: 'Payment_' . $data['PaymentID'],
            DateCreated: $data['Created'] ?? '',
            DateModified: $data['Modified'] ?? '',
        );
    }
}