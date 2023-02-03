<?php

namespace App\Http\Requests\Subscriber;

use App\Models\Subscriber;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Http\FormRequest;

class EmailVerificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!hash_equals((string) $this->user()->getKey(), (string) $this->route('id'))) {
            return false;
        }

        if (!hash_equals(sha1($this->user()->getEmailForVerification()), (string) $this->route('hash'))) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }

    /**
     * Fulfill the email verification request.
     *
     * @return void
     */
    public function verify()
    {
        if ($this->user()->hasVerifiedEmail()) {
            return redirect()->intended(Subscriber::HOME . '?verified=1');
        }

        if ($this->user()->markEmailAsVerified()) {
            event(new Verified($this->user()));
        }

        return redirect()->intended(Subscriber::HOME . '?verified=1');
    }
}
