<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class SalesReportForm extends Form
{
    
    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('id', 'integer')
        ->addField('item', ['type' => 'integer'])
        ->addField('warehouse', ['type' => 'integer'])
        ->addField('created date', ['type' => 'date'])
        ->addField('delivery date', ['type' => 'date'])
        ->addField('quantity', ['type' => 'integer'])
        ->addField('rate', ['type' => 'integer'])
        ->addField('amount', ['type' => 'integer'])
        ;
    }
    
    protected function _buildValidator(Validator $validator)
    {
//         $validator->add('name', 'length', [
//             'rule' => ['minLength', 10],
//             'message' => 'A name is required'
//         ])->add('email', 'format', [
//             'rule' => 'email',
//             'message' => 'A valid email address is required',
//         ]);
        
//         return $validator;
    }
    
    protected function _execute(array $data)
    {
        // Send an email.
        return true;
    }
    
}