<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class Customer extends Model

{

    use HasFactory;

    protected $fillable = [

        'c_first_name', 'c_last_name', 'email', 'password', 'contact', 'street_address', 'postal_code', 'country', 'state', 'is_active', 'is_deleted', 'acn', 'abn', 'crn', 'contact_person', 'entity_type', 'added_by'

    ];

    protected $primaryKey = 'customer_id';

    protected $table = 'customer';

    public function contactPerson()
    {
        return $this->belongsTo(Customer::class, 'contact_person', 'customer_id');
    }

    public function getCompany()
    {
        return $this->belongsTo(Customer::class, 'company', 'customer_id');
    }
}
