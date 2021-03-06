<?php declare(strict_types=1);

namespace App\Orchid\Layouts\StructuralAttributeValue;

use App\Enums\AttributeTypeEnum;
use App\Models\StructuralFieldValue;
use Illuminate\Database\Eloquent\Collection;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Rows;

class StructuralFieldValuesEditRows extends Rows
{
    protected bool $isCreate;
    /** @var StructuralFieldValue[] */
    protected ?Collection $fieldValues;

    /** @param StructuralFieldValue[] $fieldValues */
    public function __construct(bool $isCreate, ?Collection $fieldValues)
    {
        $this->isCreate = $isCreate;
        $this->fieldValues = $fieldValues;
    }

    protected function fields() : array
    {
        $fields = [];
        if (!$this->isCreate)
        {
            foreach ($this->fieldValues as $fieldValue)
            {
                switch ($fieldValue->field->type)
                {
                    case AttributeTypeEnum::STRING:
                        $fields[] = Input::make('field_values.' . $fieldValue->id)
                            ->title($fieldValue->field->name)
                            ->value($fieldValue->value);
                    break;
                    case AttributeTypeEnum::INT:
                    case AttributeTypeEnum::DOUBLE:
                        $fields[] = Input::make('field_values.' . $fieldValue->id)
                            ->title($fieldValue->field->name)
                            ->value($fieldValue->value)
                            ->type('number');
                    break;
                    case AttributeTypeEnum::BOOL:
                        $fields[] = Switcher::make('field_values.' . $fieldValue->id)
                            ->title($fieldValue->field->name)
                            ->checked($fieldValue->value)
                            ->sendTrueOrFalse();
                    break;
                    default:
                }
            }
        }

        return $fields;
    }
}
