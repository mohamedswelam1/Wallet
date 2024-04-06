<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sender'=>$this->sender,
            'recevier'=>$this->recevier,
            'amount' => $this->amount,
            'transaction_fee' => $this->transaction_fee,
            'type' => $this->type,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
