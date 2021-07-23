<?php

namespace App\Http\Requests;

use App\Enumerators\UserStatusEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
{

    private const ACTION_UPDATE = 'update';
    private const ACTION_INDEX = 'index';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $action = $this->route()->getActionMethod();

        switch ($action) {
            case self::ACTION_UPDATE:
                return $this->onUpdateMethod();
            case self::ACTION_INDEX:
                return $this->onIndexMethod();
            default:
                return [];
        }
    }

    private function onUpdateMethod(): array
    {
        return [
            'title_name' => 'sometimes|string|min:2',
            'gender' => ['sometimes', Rule::in([User::FEMALE_GENDER, User::MALE_GENDER])],
            'status' => ['sometimes', Rule::in([
                UserStatusEnum::PUBLISHED,
                UserStatusEnum::TRASH,
                UserStatusEnum::DRAFT
            ])]
        ];
    }

    private function onIndexMethod(): array
    {
        return [
            'nat' => 'sometimes|string|min:2|max:3'
        ];
    }
}
