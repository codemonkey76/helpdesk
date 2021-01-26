<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => "required|email|unique:users,email," . Auth::id(),
            'mobile' => 'sometimes',
            'notification_email_unassigned_tickets' => 'required|boolean',
            'notification_email_assigned_tickets' => 'required|boolean',
            'notification_email_replies' => 'required|boolean',
            'notification_email_messages' => 'required|boolean',
            'push_notifications' => 'required|in:push_everything,push_email,push_nothing',
            'avatar' => 'required|string',
            'company_id' => 'required|exists:companies,id'
        ];
    }
}
