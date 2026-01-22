<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'local_id'    => 'required|integer|exists:equips,id',
            'visitant_id' => 'required|integer|exists:equips,id',
            'estadi_id'   => 'required|integer|exists:estadis,id',

            'data'        => 'required|date',
            'jornada'     => 'required|integer|min:1',

            // Formato "2-1" o "0-0"
            'gols'        => 'nullable|regex:/^\d+\-\d+$/',
        ];
    }
}
