<?php namespace Bdgt\Resources;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date_opened', 'name', 'balance'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id'];

    protected $transactions;

    public function addTransaction($transaction)
    {
        $this->transactions[] = $transaction;
        if ($transaction->inflow) {
            $this->total += $transaction->amount;
        } else {
            $this->total -= $transaction->amount;
        }
    }

    public function transactions()
    {
        return $this->hasMany('Bdgt\Resources\Transaction');
    }
}