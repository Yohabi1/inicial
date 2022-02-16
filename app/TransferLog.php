<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransferLog extends Model
{
    protected $guarded = ['id'];

    public function form_user()
    {
        return $this->belongsTo(User::class, 'form_user_id')->withDefault();
    }

    public function form_user_wallet()
    {
        return $this->belongsTo(Wallet::class, 'from_wallet_id')->withDefault();
    }

    public function to_user()
    {
        return $this->belongsTo(User::class, 'to_user_id')->withDefault();
    }

    public function to_user_wallet()
    {
        return $this->belongsTo(Wallet::class, 'to_wallet_id')->withDefault();
    }
}
