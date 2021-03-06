<?php declare(strict_types=1);

namespace App\Orchid\Screens\StructuralAttributeValue;

use App\Models\StructuralAttribute;
use App\Models\StructuralAttributeValue;
use App\Models\StructuralFieldValue;
use App\Orchid\Layouts\StructuralAttributeValue\StructuralAttributeValueEditRows;
use App\Orchid\Layouts\StructuralAttributeValue\StructuralFieldValuesEditRows;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class StructuralAttributeValueEditScreen extends Screen
{
    public $name = 'Create value';

    protected bool $exists = false;
    protected StructuralAttribute $attribute;
    /** @var StructuralFieldValue[] */
    protected ?Collection $fieldValues;

    protected function query(StructuralAttribute $attribute, StructuralAttributeValue $value) : array
    {
        $this->attribute = $attribute;

        $this->exists = $value->exists;
        if ($this->exists)
        {
            $this->name = $value->name;
            $this->fieldValues = $value->fieldsValues;
            $fieldValues = $value->fieldsValues->pluck('value', 'attribute_field_id')->toArray();
        }
        else
        {
            $this->fieldValues = new Collection();
            $fieldValues = array_flip($attribute->fields()->pluck('id')->toArray());
        }

        return [
            'attribute' => $attribute,
            'value' => $value,
            'field_values' => $fieldValues
        ];
    }

    public function commandBar() : array
    {
        return [
            Button::make('Create')
                ->icon('plus')
                ->canSee(!$this->exists)
                ->method('createOrUpdate'),
            Button::make('Update')
                ->icon('pencil')
                ->canSee($this->exists)
                ->method('createOrUpdate'),
            Button::make('Delete')
                ->icon('trash')
                ->canSee($this->exists)
                ->method('delete'),
        ];
    }

    public function layout() : array
    {
        $layouts = [
            new StructuralAttributeValueEditRows(!$this->exists, $this->attribute->id),
        ];

        if (count($this->fieldValues) > 0)
            $layouts[] = new StructuralFieldValuesEditRows(!$this->exists, $this->fieldValues);

        return $layouts;
    }

    protected function createOrUpdate(StructuralAttribute $attribute, StructuralAttributeValue $value, Request $request) : RedirectResponse
    {
        $valueData = $request->all()['value'];
        if (!$value->exists)
            $value->attribute_id = $attribute->id;
        $value->name = $valueData['name'];
        $value->description = $valueData['description'] ?? null;
        $value->save();

        if ($value->exists)
        {
            $valueFields = $value->fieldsValues->keyBy('id');
            $fieldValues = $request->all()['field_values'] ?? [];
            /**
             * @var int $fieldId
             * @var string $fieldValue */
            foreach ($fieldValues as $fieldId => $fieldValue)
            {
                /** @var StructuralFieldValue|null $field */
                $field = $valueFields[$fieldId] ?? null;
                if ($field !== null)
                {
                    $field->value = $field->castValue($fieldValue);
                    $field->save();
                }
            }
        }

        Alert::success('Save success');

        return redirect(route('platform.structural_attribute_values.edit', [$attribute->id, $value->id]));
    }

    protected function delete(StructuralAttribute $attribute, StructuralAttributeValue $value) : RedirectResponse
    {
        $value->delete();

        Alert::success('Delete success');

        return redirect(route('platform.structural_attribute_values.list', $attribute->id));
    }
}
