<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetricStoreRequest extends FormRequest
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
            'url' => 'required|string|min:2',
            'accessibility_metric' => 'nullable|decimal:2',
            'best_practices_metric' => 'nullable|decimal:2',
            'performance_metric' => 'nullable|decimal:2',
            'pwa_metric' => 'nullable|decimal:2',
            'seo_metric' => 'nullable|decimal:2',
            'strategy_id' => 'required|numeric',
        ];
    }
}
